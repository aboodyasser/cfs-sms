<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreIncomeRequest;
use App\Http\Requests\Admin\UpdateIncomeRequest;
use App\Models\Income;
use App\Models\Project;
use App\Services\AuditLogService;
use App\Traits\HandlesAttachments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IncomeController extends Controller
{
    use HandlesAttachments;

    public function __construct(
        private AuditLogService $auditLog
    ) {}

    public function index(Request $request)
    {
        $this->authorize('viewAny', Income::class);

        $incomes = Income::query()
            ->with(['project', 'receiver', 'reviewer'])
            ->when($request->filled('q'), function ($query) use ($request) {
                $search = $request->string('q')->toString();

                $query->where(function ($q) use ($search) {
                    $q->where('income_number', 'like', "%{$search}%")
                        ->orWhere('title', 'like', "%{$search}%")
                        ->orWhere('source', 'like', "%{$search}%")
                        ->orWhere('reference_number', 'like', "%{$search}%");
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

        $statistics = [
            'total' => Income::count(),

            'draft' => Income::where('status', 'draft')->count(),

            'submitted' => Income::where('status', 'submitted')->count(),

            'approved' => Income::where('status', 'approved')->count(),

            'rejected' => Income::where('status', 'rejected')->count(),

            'approved_amount' => Income::where('status', 'approved')
                ->sum('amount'),
        ];

        return view(
            'admin.incomes.index',
            compact('incomes', 'statistics')
        );
    }

    public function create()
    {
        $this->authorize('create', Income::class);

        $projects = Project::query()
            ->orderBy('name')
            ->get();

        return view(
            'admin.incomes.create',
            compact('projects')
        );
    }

    public function store(StoreIncomeRequest $request)
    {
        $validated = $request->validated();

        $income = Income::create([
            'income_number' => $this->generateIncomeNumber(),
            'project_id' => $validated['project_id'] ?? null,
            'received_by' => Auth::id(),
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'source' => $validated['source'],
            'amount' => $validated['amount'],
            'income_date' => $validated['income_date'],
            'reference_number' => $validated['reference_number'] ?? null,
            'status' => $validated['status'],
        ]);

        $this->handleAttachments($request, $income);

        $this->auditLog->log(
            'income.created',
            "Created income {$income->income_number} ({$income->title})",
            $income,
            null,
            $income->only(['title', 'source', 'amount', 'status'])
        );

        return redirect()
            ->route('admin.incomes.show', $income)
            ->with('success', 'Income created successfully.');
    }

    public function show(Income $income)
    {
        $this->authorize('view', $income);

        $income->load([
            'project',
            'receiver',
            'reviewer',
            'payments',
        ]);

        return view(
            'admin.incomes.show',
            compact('income')
        );
    }

    public function edit(Income $income)
    {
        $this->authorize('update', $income);

        $projects = Project::query()
            ->orderBy('name')
            ->get();

        return view(
            'admin.incomes.edit',
            compact('income', 'projects')
        );
    }

    public function update(
        UpdateIncomeRequest $request,
        Income $income
    ) {
        $before = $income->only(['title', 'source', 'amount', 'reference_number']);

        $income->update($request->validated());

        $this->auditLog->log(
            'income.updated',
            "Updated income {$income->income_number}",
            $income,
            $before,
            $income->only(['title', 'source', 'amount', 'reference_number'])
        );

        return redirect()
            ->route('admin.incomes.show', $income)
            ->with('success', 'Income updated successfully.');
    }

    public function destroy(Income $income)
    {
        $this->authorize('delete', $income);

        $number = $income->income_number;
        $snapshot = $income->only(['title', 'source', 'amount', 'status']);

        $income->delete();

        $this->auditLog->log(
            'income.deleted',
            "Deleted income {$number}",
            null,
            $snapshot,
            null
        );

        return redirect()
            ->route('admin.incomes.index')
            ->with('success', 'Income deleted successfully.');
    }

    public function submit(Income $income)
    {
        $this->authorize('submit', $income);

        $income->update([
            'status' => 'submitted',
        ]);

        $this->auditLog->log(
            'income.submitted',
            "Submitted income {$income->income_number} for approval",
            $income
        );

        return back()->with(
            'success',
            'Income submitted successfully.'
        );
    }

    public function approve(Income $income)
    {
        $this->authorize('approve', $income);

        $income->update([
            'status' => 'approved',
            'reviewed_by' => Auth::id(),
            'reviewed_at' => now(),
            'rejection_reason' => null,
        ]);

        $this->auditLog->log(
            'income.approved',
            "Approved income {$income->income_number}",
            $income
        );

        return back()->with(
            'success',
            'Income approved successfully.'
        );
    }

    public function reject(Request $request, Income $income)
    {
        $this->authorize('reject', $income);

        $validated = $request->validate([
            'rejection_reason' => [
                'required',
                'string',
                'max:2000',
            ],
        ]);

        $income->update([
            'status' => 'rejected',
            'rejection_reason' => $validated['rejection_reason'],
            'reviewed_by' => Auth::id(),
            'reviewed_at' => now(),
        ]);

        $this->auditLog->log(
            'income.rejected',
            "Rejected income {$income->income_number}: {$validated['rejection_reason']}",
            $income
        );

        return back()->with(
            'success',
            'Income rejected successfully.'
        );
    }

    private function generateIncomeNumber(): string
    {
        $prefix = 'INC-' . now()->format('Ym') . '-';

        $lastIncome = Income::withTrashed()
            ->where('income_number', 'like', $prefix . '%')
            ->latest('id')
            ->first();

        $nextNumber = $lastIncome
            ? ((int) substr($lastIncome->income_number, -5)) + 1
            : 1;

        return $prefix . str_pad(
            $nextNumber,
            5,
            '0',
            STR_PAD_LEFT
        );
    }
}
