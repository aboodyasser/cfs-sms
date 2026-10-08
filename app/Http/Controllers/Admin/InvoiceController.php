<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreInvoiceRequest;
use App\Http\Requests\Admin\UpdateInvoiceRequest;
use App\Models\Budget;
use App\Models\Invoice;
use App\Models\Project;
use App\Services\AuditLogService;
use App\Traits\HandlesAttachments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{
    use HandlesAttachments;

    public function __construct(
        private AuditLogService $auditLog
    ) {}

    public function index(Request $request)
    {
        $this->authorize('viewAny', Invoice::class);

        $invoices = Invoice::query()
            ->with(['project', 'budget', 'creator'])
            ->when($request->filled('q'), function ($query) use ($request) {
                $search = $request->string('q')->toString();

                $query->where(function ($q) use ($search) {
                    $q->where('invoice_number', 'like', "%{$search}%")
                        ->orWhere('vendor', 'like', "%{$search}%")
                        ->orWhere('title', 'like', "%{$search}%");
                });
            })
            ->when($request->filled('status'), function ($query) use ($request) {
                $query->where(
                    'status',
                    $request->string('status')->toString()
                );
            })
            ->when($request->filled('project_id'), function ($query) use ($request) {
                $query->where(
                    'project_id',
                    $request->integer('project_id')
                );
            })
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view(
            'admin.invoices.index',
            compact('invoices')
        );
    }

    public function create()
    {
        $this->authorize('create', Invoice::class);

        $projects = Project::query()
            ->orderBy('name')
            ->get();

        $budgets = Budget::query()
            ->where('status', 'active')
            ->with('project')
            ->orderBy('name')
            ->get();

        return view(
            'admin.invoices.create',
            compact('projects', 'budgets')
        );
    }

    public function store(StoreInvoiceRequest $request)
    {
        $validated = $request->validated();

        $subtotal = (float) $validated['subtotal'];
        $tax = (float) ($validated['tax_amount'] ?? 0);
        $total = $subtotal + $tax;

        $invoice = Invoice::create([
            'invoice_number' => $this->generateInvoiceNumber(),
            'project_id' => $validated['project_id'] ?? null,
            'budget_id' => $validated['budget_id'] ?? null,
            'created_by' => Auth::id(),
            'vendor' => $validated['vendor'],
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'invoice_date' => $validated['invoice_date'],
            'due_date' => $validated['due_date'] ?? null,
            'subtotal' => $subtotal,
            'tax_amount' => $tax,
            'total_amount' => $total,
            'paid_amount' => 0,
            'balance_amount' => $total,
            'status' => $validated['status'],
        ]);

        $this->handleAttachments($request, $invoice);

        $this->auditLog->log(
            'invoice.created',
            "Created invoice {$invoice->invoice_number} ({$invoice->vendor})",
            $invoice,
            null,
            $invoice->only(['vendor', 'title', 'total_amount', 'status'])
        );

        return redirect()
            ->route('admin.invoices.show', $invoice)
            ->with('success', 'Invoice created successfully.');
    }

    public function show(Invoice $invoice)
    {
        $this->authorize('view', $invoice);

        $invoice->load([
            'project',
            'budget',
            'creator',
            'payments',
        ]);

        return view(
            'admin.invoices.show',
            compact('invoice')
        );
    }

    public function print(Invoice $invoice)
    {
        $this->authorize('view', $invoice);

        $invoice->load([
            'project',
            'budget',
            'creator',
            'payments',
        ]);

        return view(
            'admin.invoices.print',
            compact('invoice')
        );
    }

    public function edit(Invoice $invoice)
    {
        $this->authorize('update', $invoice);

        $projects = Project::query()
            ->orderBy('name')
            ->get();

        $budgets = Budget::query()
            ->where('status', 'active')
            ->with('project')
            ->orderBy('name')
            ->get();

        return view(
            'admin.invoices.edit',
            compact('invoice', 'projects', 'budgets')
        );
    }

    public function update(
        UpdateInvoiceRequest $request,
        Invoice $invoice
    ) {
        if ($invoice->payments()->exists()) {
            abort(422, 'Paid invoices cannot be edited.');
        }

        $before = $invoice->only(['vendor', 'title', 'total_amount', 'due_date']);

        $validated = $request->validated();

        $subtotal = (float) $validated['subtotal'];
        $tax = (float) ($validated['tax_amount'] ?? 0);
        $total = $subtotal + $tax;

        $invoice->update([
            'project_id' => $validated['project_id'] ?? null,
            'budget_id' => $validated['budget_id'] ?? null,
            'vendor' => $validated['vendor'],
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'invoice_date' => $validated['invoice_date'],
            'due_date' => $validated['due_date'] ?? null,
            'subtotal' => $subtotal,
            'tax_amount' => $tax,
            'total_amount' => $total,
            'balance_amount' => $total,
        ]);

        $this->auditLog->log(
            'invoice.updated',
            "Updated invoice {$invoice->invoice_number}",
            $invoice,
            $before,
            $invoice->only(['vendor', 'title', 'total_amount', 'due_date'])
        );

        return redirect()
            ->route('admin.invoices.show', $invoice)
            ->with('success', 'Invoice updated successfully.');
    }

    public function destroy(Invoice $invoice)
    {
        $this->authorize('delete', $invoice);

        if ($invoice->payments()->exists()) {
            abort(422, 'Paid invoices cannot be deleted.');
        }

        $number = $invoice->invoice_number;
        $snapshot = $invoice->only(['vendor', 'title', 'total_amount', 'status']);

        $invoice->delete();

        $this->auditLog->log(
            'invoice.deleted',
            "Deleted invoice {$number}",
            null,
            $snapshot,
            null
        );

        return redirect()
            ->route('admin.invoices.index')
            ->with('success', 'Invoice deleted successfully.');
    }

    public function submit(Invoice $invoice)
    {
        $this->authorize('submit', $invoice);

        $invoice->update([
            'status' => 'submitted',
        ]);

        $this->auditLog->log(
            'invoice.submitted',
            "Submitted invoice {$invoice->invoice_number} for approval",
            $invoice
        );

        return back()->with(
            'success',
            'Invoice submitted successfully.'
        );
    }

    public function approve(Invoice $invoice)
    {
        $this->authorize('approve', $invoice);

        $invoice->update([
            'status' => 'approved',
            'reviewed_by' => Auth::id(),
            'reviewed_at' => now(),
            'rejection_reason' => null,
        ]);

        $this->auditLog->log(
            'invoice.approved',
            "Approved invoice {$invoice->invoice_number}",
            $invoice
        );

        return back()->with(
            'success',
            'Invoice approved successfully.'
        );
    }

    public function reject(Request $request, Invoice $invoice)
    {
        $this->authorize('reject', $invoice);

        $validated = $request->validate([
            'rejection_reason' => [
                'required',
                'string',
                'max:2000',
            ],
        ]);

        $invoice->update([
            'status' => 'draft',
            'rejection_reason' => $validated['rejection_reason'],
            'reviewed_by' => Auth::id(),
            'reviewed_at' => now(),
        ]);

        $this->auditLog->log(
            'invoice.rejected',
            "Rejected invoice {$invoice->invoice_number}: {$validated['rejection_reason']}",
            $invoice
        );

        return back()->with(
            'success',
            'Invoice rejected successfully.'
        );
    }

    public function cancel(Invoice $invoice)
    {
        $this->authorize('cancel', $invoice);

        $invoice->update([
            'status' => 'cancelled',
        ]);

        $this->auditLog->log(
            'invoice.cancelled',
            "Cancelled invoice {$invoice->invoice_number}",
            $invoice
        );

        return back()->with(
            'success',
            'Invoice cancelled successfully.'
        );
    }

    private function generateInvoiceNumber(): string
    {
        $prefix = 'INV-' . now()->format('Ym') . '-';

        $last = Invoice::withTrashed()
            ->where('invoice_number', 'like', $prefix . '%')
            ->latest('id')
            ->first();

        $next = $last
            ? ((int) substr($last->invoice_number, -5)) + 1
            : 1;

        return $prefix . str_pad(
            $next,
            5,
            '0',
            STR_PAD_LEFT
        );
    }
}
