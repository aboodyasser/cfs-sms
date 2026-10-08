<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Receipt;
use App\Services\AuditLogService;
use App\Traits\HandlesAttachments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReceiptController extends Controller
{
    use HandlesAttachments;

    public function __construct(
        private AuditLogService $auditLog
    ) {}

    public function index(Request $request)
    {
        $this->authorize('viewAny', Receipt::class);

        $receipts = Receipt::query()
            ->with([
                'payment.invoice',
                'payment.income',
                'issuer',
            ])
            ->when($request->filled('q'), function ($query) use ($request) {
                $search = $request->string('q')->toString();

                $query->where(
                    'receipt_number',
                    'like',
                    "%{$search}%"
                );
            })
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view(
            'admin.receipts.index',
            compact('receipts')
        );
    }

    public function show(Receipt $receipt)
    {
        $this->authorize('view', $receipt);

        $receipt->load([
            'payment.invoice',
            'payment.income',
            'payment.project',
            'issuer',
        ]);

        return view(
            'admin.receipts.show',
            compact('receipt')
        );
    }

    public function print(Receipt $receipt)
    {
        $this->authorize('view', $receipt);

        $receipt->load([
            'payment.invoice',
            'payment.income',
            'payment.project',
            'issuer',
        ]);

        return view(
            'admin.receipts.print',
            compact('receipt')
        );
    }

    public function store(Request $request, Payment $payment)
    {
        $this->authorize('create', Receipt::class);

        if ($payment->status !== 'completed') {
            abort(422, 'Only completed payments can generate receipts.');
        }

        if ($payment->receipt()->exists()) {
            return redirect()
                ->route(
                    'admin.receipts.show',
                    $payment->receipt
                );
        }

        $receipt = DB::transaction(function () use ($payment, $request) {

            $receipt = Receipt::create([
                'receipt_number' => $this->generateReceiptNumber(),
                'payment_id' => $payment->id,
                'issued_by' => $request->user()->id,
                'receipt_date' => now()->toDateString(),
                'amount' => $payment->amount,
                'description' => $payment->description,
                'status' => 'active',
            ]);

        $this->handleAttachments($request, $receipt);
        return $receipt;
        });

        $this->auditLog->log(
            'receipt.created',
            "Generated receipt {$receipt->receipt_number} for payment {$payment->payment_number}",
            $receipt,
            null,
            $receipt->only(['amount', 'status'])
        );

        return redirect()
            ->route('admin.receipts.show', $receipt)
            ->with('success', 'Receipt generated successfully.');
    }

    public function cancel(Receipt $receipt)
    {
        $this->authorize('cancel', $receipt);

        $receipt->update([
            'status' => 'cancelled',
        ]);

        $this->auditLog->log(
            'receipt.cancelled',
            "Cancelled receipt {$receipt->receipt_number}",
            $receipt
        );

        return back()->with(
            'success',
            'Receipt cancelled successfully.'
        );
    }

    private function generateReceiptNumber(): string
    {
        $prefix = 'RCT-' . now()->format('Ym') . '-';

        $last = Receipt::withTrashed()
            ->where('receipt_number', 'like', $prefix . '%')
            ->latest('id')
            ->first();

        $next = $last
            ? ((int) substr($last->receipt_number, -5)) + 1
            : 1;

        return $prefix . str_pad(
            $next,
            5,
            '0',
            STR_PAD_LEFT
        );
    }
}
