<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StorePaymentRequest;
use App\Http\Requests\Admin\UpdatePaymentRequest;
use App\Models\Income;
use App\Models\Invoice;
use App\Models\Payment;
use App\Services\AuditLogService;
use App\Traits\HandlesAttachments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    use HandlesAttachments;

    public function __construct(
        private AuditLogService $auditLog
    ) {}

    public function index(Request $request)
    {
        $this->authorize('viewAny', Payment::class);

        $payments = Payment::query()
            ->with([
                'invoice',
                'income',
                'project',
                'processor',
                'receipt',
            ])
            ->when($request->filled('q'), function ($query) use ($request) {
                $search = $request->string('q')->toString();

                $query->where(function ($q) use ($search) {
                    $q->where('payment_number', 'like', "%{$search}%")
                        ->orWhere('reference_number', 'like', "%{$search}%");
                });
            })
            ->when($request->filled('payment_type'), function ($query) use ($request) {
                $query->where(
                    'payment_type',
                    $request->string('payment_type')->toString()
                );
            })
            ->when($request->filled('status'), function ($query) use ($request) {
                $query->where(
                    'status',
                    $request->string('status')->toString()
                );
            })
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view(
            'admin.payments.index',
            compact('payments')
        );
    }

    public function create()
    {
        $this->authorize('create', Payment::class);

        $invoices = Invoice::query()
            ->whereIn('status', [
                'approved',
                'partially_paid',
                'overdue',
            ])
            ->where('balance_amount', '>', 0)
            ->orderBy('due_date')
            ->get();

        $incomes = Income::query()
            ->where('status', 'approved')
            ->orderByDesc('income_date')
            ->get();

        return view(
            'admin.payments.create',
            compact('invoices', 'incomes')
        );
    }

    public function store(StorePaymentRequest $request)
    {
        $validated = $request->validated();

        return DB::transaction(function () use ($validated, $request) {

            $paymentType = $validated['payment_type'];

            if ($paymentType === 'expense') {
                $invoice = Invoice::lockForUpdate()
                    ->findOrFail($validated['invoice_id']);

                $amount = (float) $validated['amount'];
                $balance = (float) $invoice->balance_amount;

                if ($amount > $balance) {
                    abort(422, 'Payment amount exceeds invoice balance.');
                }

                $payment = Payment::create([
                    'payment_number' => $this->generatePaymentNumber(),
                    'invoice_id' => $invoice->id,
                    'income_id' => null,
                    'project_id' => $invoice->project_id,
                    'processed_by' => $request->user()->id,
                    'payment_type' => 'expense',
                    'amount' => $amount,
                    'payment_date' => $validated['payment_date'],
                    'payment_method' => $validated['payment_method'],
                    'reference_number' => $validated['reference_number'] ?? null,
                    'description' => $validated['description'] ?? null,
                    'status' => 'completed',
                ]);
            } else {
                $income = Income::lockForUpdate()
                    ->findOrFail($validated['income_id']);

                if ($income->status !== 'approved') {
                    abort(422, 'Only approved income can receive payment.');
                }

                $alreadyPaid = (float) $income->payments()
                    ->where('status', 'completed')
                    ->sum('amount');

                $amount = (float) $validated['amount'];

                if ($alreadyPaid + $amount > (float) $income->amount) {
                    abort(422, 'Payment amount exceeds income balance.');
                }

                $payment = Payment::create([
                    'payment_number' => $this->generatePaymentNumber(),
                    'invoice_id' => null,
                    'income_id' => $income->id,
                    'project_id' => $income->project_id,
                    'processed_by' => $request->user()->id,
                    'payment_type' => 'income',
                    'amount' => $amount,
                    'payment_date' => $validated['payment_date'],
                    'payment_method' => $validated['payment_method'],
                    'reference_number' => $validated['reference_number'] ?? null,
                    'description' => $validated['description'] ?? null,
                    'status' => 'completed',
                ]);
            }

            $this->handleAttachments($request, $payment);

            $this->auditLog->log(
                'payment.created',
                "Recorded {$payment->payment_type} payment {$payment->payment_number}",
                $payment,
                null,
                $payment->only(['payment_type', 'amount', 'payment_method', 'status'])
            );

            return redirect()
                ->route('admin.payments.show', $payment)
                ->with('success', 'Payment recorded successfully.');
        });
    }

    public function show(Payment $payment)
    {
        $this->authorize('view', $payment);

        $payment->load([
            'invoice',
            'income',
            'project',
            'processor',
            'receipt',
        ]);

        return view(
            'admin.payments.show',
            compact('payment')
        );
    }

    public function edit(Payment $payment)
    {
        $this->authorize('update', $payment);

        if ($payment->receipt()->exists()) {
            abort(422, 'This payment has an issued receipt and can no longer be edited.');
        }

        $invoices = \App\Models\Invoice::query()
            ->whereIn('status', ['approved', 'partially_paid', 'overdue'])
            ->orWhere('id', $payment->invoice_id)
            ->orderBy('due_date')
            ->get();
            
        $incomes = \App\Models\Income::query()
            ->where('status', 'approved')
            ->orWhere('id', $payment->income_id)
            ->get();

        return view(
            'admin.payments.edit',
            compact('payment', 'invoices', 'incomes')
        );
    }

    public function update(
        UpdatePaymentRequest $request,
        Payment $payment
    ) {
        if ($payment->receipt()->exists()) {
            abort(422, 'This payment has an issued receipt and can no longer be edited. Cancel the receipt first, or record a correcting payment instead.');
        }

        $validated = $request->validated();

        return DB::transaction(function () use ($validated, $payment) {

            $newAmount = (float) ($validated['amount'] ?? $payment->amount);
            $newStatus = $validated['status'] ?? $payment->status;
            $willBeCounted = $newStatus === 'completed';

            if ($payment->payment_type === 'expense' && $payment->invoice_id) {
                $invoice = Invoice::lockForUpdate()
                    ->findOrFail($payment->invoice_id);

                $wasCounted = $payment->status === 'completed';

                $availableBalance = (float) $invoice->balance_amount
                    + ($wasCounted ? (float) $payment->amount : 0);

                if ($willBeCounted && $newAmount > $availableBalance) {
                    abort(422, 'Payment amount exceeds invoice balance.');
                }
            }

            if ($payment->payment_type === 'income' && $payment->income_id && $willBeCounted) {
                $income = Income::lockForUpdate()
                    ->findOrFail($payment->income_id);

                $alreadyPaid = (float) $income->payments()
                    ->where('status', 'completed')
                    ->where('id', '!=', $payment->id)
                    ->sum('amount');

                if ($alreadyPaid + $newAmount > (float) $income->amount) {
                    abort(422, 'Payment amount exceeds income balance.');
                }
            }

            $before = $payment->only(['amount', 'status', 'payment_method']);

            $payment->update($validated);

            $this->auditLog->log(
                'payment.updated',
                "Updated payment {$payment->payment_number}",
                $payment,
                $before,
                $payment->only(['amount', 'status', 'payment_method'])
            );

            return redirect()
                ->route('admin.payments.show', $payment)
                ->with('success', 'Payment updated successfully.');
        });
    }

    public function destroy(Payment $payment)
    {
        $this->authorize('delete', $payment);

        if ($payment->receipt()->exists()) {
            abort(422, 'This payment has an issued receipt and cannot be deleted. Cancel the receipt first.');
        }

        $number = $payment->payment_number;
        $snapshot = $payment->only(['payment_type', 'amount', 'status']);

        $payment->delete();

        $this->auditLog->log(
            'payment.deleted',
            "Deleted payment {$number}",
            null,
            $snapshot,
            null
        );

        return redirect()
            ->route('admin.payments.index')
            ->with('success', 'Payment deleted successfully.');
    }

    private function generatePaymentNumber(): string
    {
        $prefix = 'PAY-' . now()->format('Ym') . '-';

        $last = Payment::withTrashed()
            ->where('payment_number', 'like', $prefix . '%')
            ->latest('id')
            ->first();

        $next = $last
            ? ((int) substr($last->payment_number, -5)) + 1
            : 1;

        return $prefix . str_pad(
            $next,
            5,
            '0',
            STR_PAD_LEFT
        );
    }
}
