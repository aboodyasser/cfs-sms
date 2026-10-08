<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreExpenseRequest;
use App\Http\Requests\Admin\UpdateExpenseRequest;
use App\Models\Expense;
use App\Models\Project;
use App\Services\AuditLogService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Traits\HandlesAttachments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExpenseController extends Controller
{
    use HandlesAttachments;

    use AuthorizesRequests;

    public function __construct(
        private AuditLogService $auditLog
    ) {}

    public function index(Request $request)
    {
        $this->authorize('viewAny', Expense::class);

        $expenses = Expense::query()
            ->with([
                'project',
                'user',
                'reviewer',
            ])
            ->when($request->filled('q'), function ($query) use ($request) {
                $search = $request->string('q')->toString();

                $query->where(function ($q) use ($search) {
                    $q->where('expense_number', 'like', "%{$search}%")
                        ->orWhere('title', 'like', "%{$search}%")
                        ->orWhere('vendor', 'like', "%{$search}%")
                        ->orWhere('invoice_number', 'like', "%{$search}%");
                });
            })
            ->when($request->filled('status'), function ($query) use ($request) {
                $query->where(
                    'status',
                    $request->string('status')->toString()
                );
            })
            ->when($request->filled('category'), function ($query) use ($request) {
                $query->where(
                    'category',
                    $request->string('category')->toString()
                );
            })
            ->latest()
            ->paginate(15)
            ->withQueryString();

        $statistics = [
            'total' => Expense::count(),
            'draft' => Expense::where('status', 'draft')->count(),
            'submitted' => Expense::where('status', 'submitted')->count(),
            'under_review' => Expense::where('status', 'under_review')->count(),
            'approved' => Expense::where('status', 'approved')->count(),
            'rejected' => Expense::where('status', 'rejected')->count(),
            'approved_amount' => Expense::where('status', 'approved')->sum('amount'),
            'pending_amount' => Expense::whereIn('status', [
                'submitted',
                'under_review',
            ])->sum('amount'),
        ];

        return view(
            'admin.expenses.index',
            compact('expenses', 'statistics')
        );
    }

    public function create()
    {
        $this->authorize('create', Expense::class);

        $projects = Project::query()
            ->orderBy('name')
            ->get();

        return view(
            'admin.expenses.create',
            compact('projects')
        );
    }

    public function store(StoreExpenseRequest $request)
    {
        $this->authorize('create', Expense::class);

        $validated = $request->validated();

        $expense = Expense::create([
            'expense_number' => $this->generateExpenseNumber(),
            'project_id' => $validated['project_id'] ?? null,
            'user_id' => Auth::id(),
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'category' => $validated['category'],
            'amount' => $validated['amount'],
            'expense_date' => $validated['expense_date'],
            'vendor' => $validated['vendor'] ?? null,
            'invoice_number' => $validated['invoice_number'] ?? null,
            'status' => $validated['status'],
        ]);

        $this->handleAttachments($request, $expense);

        $this->auditLog->log(
            'expense.created',
            "Created expense {$expense->expense_number} ({$expense->title})",
            $expense,
            null,
            $expense->only(['title', 'category', 'amount', 'status'])
        );

        return redirect()
            ->route('admin.expenses.show', $expense)
            ->with('success', 'Expense created successfully.');
    }

    public function show(Expense $expense)
    {
        $this->authorize('view', $expense);

        $expense->load([
            'project',
            'user',
            'reviewer',
            'documents',
        ]);

        return view(
            'admin.expenses.show',
            compact('expense')
        );
    }

    public function edit(Expense $expense)
    {
        $this->authorize('update', $expense);

        $projects = Project::query()
            ->orderBy('name')
            ->get();

        return view(
            'admin.expenses.edit',
            compact('expense', 'projects')
        );
    }

    public function update(
        UpdateExpenseRequest $request,
        Expense $expense
    ) {
        $this->authorize('update', $expense);

        $before = $expense->only(['title', 'category', 'amount', 'vendor']);

        $validated = $request->validated();

        $expense->update([
            'project_id' => $validated['project_id'] ?? null,
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'category' => $validated['category'],
            'amount' => $validated['amount'],
            'expense_date' => $validated['expense_date'],
            'vendor' => $validated['vendor'] ?? null,
            'invoice_number' => $validated['invoice_number'] ?? null,
            'status' => $validated['status'],
        ]);

        $this->auditLog->log(
            'expense.updated',
            "Updated expense {$expense->expense_number}",
            $expense,
            $before,
            $expense->only(['title', 'category', 'amount', 'vendor'])
        );

        return redirect()
            ->route('admin.expenses.show', $expense)
            ->with('success', 'Expense updated successfully.');
    }

    public function destroy(Expense $expense)
    {
        $this->authorize('delete', $expense);

        $number = $expense->expense_number;
        $snapshot = $expense->only(['title', 'category', 'amount', 'status']);

        $expense->delete();

        $this->auditLog->log(
            'expense.deleted',
            "Deleted expense {$number}",
            null,
            $snapshot,
            null
        );

        return redirect()
            ->route('admin.expenses.index')
            ->with('success', 'Expense deleted successfully.');
    }

    public function submit(Expense $expense)
    {
        $this->authorize('submit', $expense);

        $expense->update([
            'status' => 'submitted',
        ]);

        $this->auditLog->log(
            'expense.submitted',
            "Submitted expense {$expense->expense_number} for review",
            $expense
        );

        return back()->with('success', 'Expense submitted successfully.');
    }

    public function review(Expense $expense)
    {
        $this->authorize('review', $expense);

        $expense->update([
            'status' => 'under_review',
            'reviewed_by' => Auth::id(),
            'reviewed_at' => now(),
        ]);

        $this->auditLog->log(
            'expense.reviewed',
            "Moved expense {$expense->expense_number} into review",
            $expense
        );

        return back()->with('success', 'Expense moved to review successfully.');
    }

    public function approve(Expense $expense)
    {
        $this->authorize('approve', $expense);

        $expense->update([
            'status' => 'approved',
            'reviewed_by' => Auth::id(),
            'reviewed_at' => now(),
            'rejection_reason' => null,
        ]);

        $this->auditLog->log(
            'expense.approved',
            "Approved expense {$expense->expense_number}",
            $expense
        );

        return back()->with('success', 'Expense approved successfully.');
    }

    public function reject(
        Request $request,
        Expense $expense
    ) {
        $this->authorize('reject', $expense);

        $validated = $request->validate([
            'rejection_reason' => [
                'required',
                'string',
                'max:2000',
            ],
        ]);

        $expense->update([
            'status' => 'rejected',
            'rejection_reason' => $validated['rejection_reason'],
            'reviewed_by' => Auth::id(),
            'reviewed_at' => now(),
        ]);

        $this->auditLog->log(
            'expense.rejected',
            "Rejected expense {$expense->expense_number}: {$validated['rejection_reason']}",
            $expense
        );

        return back()->with('success', 'Expense rejected successfully.');
    }

    private function generateExpenseNumber(): string
    {
        $prefix = 'EXP-' . now()->format('Ym') . '-';

        $lastExpense = Expense::withTrashed()
            ->where(
                'expense_number',
                'like',
                $prefix . '%'
            )
            ->latest('id')
            ->first();

        $nextNumber = $lastExpense
            ? ((int) substr(
                $lastExpense->expense_number,
                -5
            )) + 1
            : 1;

        return $prefix . str_pad(
            $nextNumber,
            5,
            '0',
            STR_PAD_LEFT
        );
    }
}
