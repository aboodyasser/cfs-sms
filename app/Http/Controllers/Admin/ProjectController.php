<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreProjectRequest;
use App\Http\Requests\Admin\UpdateProjectRequest;
use App\Models\Department;
use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Traits\HandlesAttachments;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    use HandlesAttachments;

    use AuthorizesRequests;

    /**
     * Display a listing of projects.
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', Project::class);

        $projects = Project::query()
            ->with([
                'manager',
                'department',
            ])
            ->when($request->filled('q'), function ($query) use ($request) {
                $search = $request->string('q')->toString();

                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('code', 'like', "%{$search}%")
                        ->orWhere('donor', 'like', "%{$search}%");
                });
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

        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new project.
     */
    public function create()
    {
        $this->authorize('create', Project::class);

        $managers = User::query()
            ->where('status', 'active')
            ->orderBy('name')
            ->get();

        $departments = Department::query()
            ->where('status', 'active')
            ->orderBy('name')
            ->get();

        return view('admin.projects.create', compact(
            'managers',
            'departments'
        ));
    }

    /**
     * Store a newly created project.
     */
    public function store(StoreProjectRequest $request)
    {
        $validated = $request->validated();

        $totalBudget = (float) $validated['total_budget'];

        $project = Project::create([
            'code' => $validated['code'],
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'manager_id' => $validated['manager_id'] ?? null,
            'department_id' => $validated['department_id'] ?? null,
            'donor' => $validated['donor'] ?? null,
            'location' => $validated['location'] ?? null,
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'] ?? null,
            'status' => $validated['status'],
            'completion_percentage' => $validated['completion_percentage'],
            'total_budget' => $totalBudget,
            'spent_amount' => 0,
            'remaining_budget' => $totalBudget,
            'spending_percentage' => 0,
            'burn_rate' => 0,
        ]);

        $this->handleAttachments($request, $project);

        return redirect()
            ->route('admin.projects.index')
            ->with('success', 'Project created successfully.');
    }

    /**
     * Display the specified project.
     */
    public function show(Project $project)
    {
        $this->authorize('view', $project);

        $project->load([
            'manager',
            'department',
            'attachments',
        ]);

        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified project.
     */
    public function edit(Project $project)
    {
        $this->authorize('update', $project);

        $managers = User::query()
            ->where('status', 'active')
            ->orderBy('name')
            ->get();

        $departments = Department::query()
            ->where('status', 'active')
            ->orderBy('name')
            ->get();

        return view('admin.projects.edit', compact(
            'project',
            'managers',
            'departments'
        ));
    }

    /**
     * Update the specified project.
     */
    public function update(
        UpdateProjectRequest $request,
        Project $project
    ) {
        $validated = $request->validated();

        $totalBudget = (float) $validated['total_budget'];
        $spentAmount = (float) $project->spent_amount;

        $remainingBudget = max(
            $totalBudget - $spentAmount,
            0
        );

        $spendingPercentage = $totalBudget > 0
            ? ($spentAmount / $totalBudget) * 100
            : 0;

        $project->update([
            'code' => $validated['code'],
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'manager_id' => $validated['manager_id'] ?? null,
            'department_id' => $validated['department_id'] ?? null,
            'donor' => $validated['donor'] ?? null,
            'location' => $validated['location'] ?? null,
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'] ?? null,
            'status' => $validated['status'],
            'completion_percentage' => $validated['completion_percentage'],
            'total_budget' => $totalBudget,
            'remaining_budget' => $remainingBudget,
            'spending_percentage' => round(
                $spendingPercentage,
                2
            ),
        ]);

        return redirect()
            ->route('admin.projects.index')
            ->with('success', 'Project updated successfully.');
    }

    /**
     * Remove the specified project.
     */
    public function destroy(Project $project)
    {
        $this->authorize('delete', $project);

        $project->delete();

        return redirect()
            ->route('admin.projects.index')
            ->with('success', 'Project deleted successfully.');
    }
}
