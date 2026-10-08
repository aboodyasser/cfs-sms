<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreBudgetRequest;
use App\Http\Requests\Admin\UpdateBudgetRequest;
use App\Models\Budget;
use App\Models\Project;
use App\Services\AuditLogService;
use App\Services\BudgetFinancialService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Traits\HandlesAttachments;
use Illuminate\Http\Request;

class BudgetController extends Controller
{
    use HandlesAttachments;

    use AuthorizesRequests;

    public function __construct(
        private BudgetFinancialService $financialService,
        private AuditLogService $auditLog
    ) {}

    /**
     * Display a listing of budgets.
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', Budget::class);

        $budgets = Budget::query()
            ->with('project')
            ->when($request->filled('q'), function ($query) use ($request) {
                $search = $request->string('q')->toString();

                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('category', 'like', "%{$search}%");
                });
            })
            ->when($request->filled('project_id'), function ($query) use ($request) {
                $query->where(
                    'project_id',
                    $request->integer('project_id')
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
            'admin.budgets.index',
            compact('budgets')
        );
    }

    /**
     * Show the form for creating a new budget.
     */
    public function create()
    {
        $this->authorize('create', Budget::class);

        $projects = Project::query()
            ->orderBy('name')
            ->get();

        return view(
            'admin.budgets.create',
            compact('projects')
        );
    }

    /**
     * Store a newly created budget.
     */
    public function store(StoreBudgetRequest $request)
    {
        $this->authorize('create', Budget::class);

        $validated = $request->validated();

        $budget = Budget::create([
            'project_id' => $validated['project_id'],
            'name' => $validated['name'],
            'category' => $validated['category'],
            'allocated_amount' => (float) $validated['allocated_amount'],
            'description' => $validated['description'] ?? null,
            'status' => $validated['status'],
        ]);

        $this->handleAttachments($request, $budget);

        $this->financialService->recalculate($budget);

        $this->auditLog->log(
            'budget.created',
            "Created budget {$budget->name} for project #{$budget->project_id}",
            $budget,
            null,
            $budget->only(['name', 'category', 'allocated_amount', 'status'])
        );

        return redirect()
            ->route('admin.budgets.index')
            ->with('success', 'Budget created successfully.');
    }

    /**
     * Display the specified budget.
     */
    public function show(Budget $budget)
    {
        $this->authorize('view', $budget);

        $budget->load('project');

        return view(
            'admin.budgets.show',
            compact('budget')
        );
    }

    /**
     * Show the form for editing the specified budget.
     */
    public function edit(Budget $budget)
    {
        $this->authorize('update', $budget);

        $projects = Project::query()
            ->orderBy('name')
            ->get();

        return view(
            'admin.budgets.edit',
            compact('budget', 'projects')
        );
    }

    /**
     * Update the specified budget.
     */
    public function update(
        UpdateBudgetRequest $request,
        Budget $budget
    ) {
        $this->authorize('update', $budget);

        $before = $budget->only(['name', 'category', 'allocated_amount', 'status']);

        $validated = $request->validated();

        $budget->update([
            'project_id' => $validated['project_id'],
            'name' => $validated['name'],
            'category' => $validated['category'],
            'allocated_amount' => (float) $validated['allocated_amount'],
            'description' => $validated['description'] ?? null,
            'status' => $validated['status'],
        ]);

        $this->financialService->recalculate($budget);

        $this->auditLog->log(
            'budget.updated',
            "Updated budget {$budget->name}",
            $budget,
            $before,
            $budget->only(['name', 'category', 'allocated_amount', 'status'])
        );

        return redirect()
            ->route('admin.budgets.show', $budget)
            ->with('success', 'Budget updated successfully.');
    }

    /**
     * Remove the specified budget.
     */
    public function destroy(Budget $budget)
    {
        $this->authorize('delete', $budget);

        $name = $budget->name;
        $snapshot = $budget->only(['name', 'category', 'allocated_amount', 'status']);

        $budget->delete();

        $this->auditLog->log(
            'budget.deleted',
            "Deleted budget {$name}",
            null,
            $snapshot,
            null
        );

        return redirect()
            ->route('admin.budgets.index')
            ->with('success', 'Budget deleted successfully.');
    }
}
