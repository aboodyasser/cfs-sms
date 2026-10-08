<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreContractRequest;
use App\Http\Requests\Admin\UpdateContractRequest;
use App\Models\Contract;
use App\Models\Project;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Traits\HandlesAttachments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ContractController extends Controller
{
    use HandlesAttachments;

    use AuthorizesRequests;

    /**
     * Display a listing of contracts.
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', Contract::class);

        $contracts = Contract::query()
            ->with([
                'project',
                'creator',
                'reviewer',
            ])
            ->when($request->filled('q'), function ($query) use ($request) {
                $search = $request->string('q')->toString();

                $query->where(function ($q) use ($search) {
                    $q->where('contract_number', 'like', "%{$search}%")
                        ->orWhere('party_name', 'like', "%{$search}%")
                        ->orWhere('title', 'like', "%{$search}%");
                });
            })
            ->when($request->filled('status'), function ($query) use ($request) {
                $query->where(
                    'status',
                    $request->string('status')->toString()
                );
            })
            ->when($request->filled('party_type'), function ($query) use ($request) {
                $query->where(
                    'party_type',
                    $request->string('party_type')->toString()
                );
            })
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('admin.contracts.index', compact('contracts'));
    }

    /**
     * Show the form for creating a new contract.
     */
    public function create()
    {
        $this->authorize('create', Contract::class);

        $projects = Project::query()
            ->orderBy('name')
            ->get();

        return view('admin.contracts.create', compact('projects'));
    }

    /**
     * Store a newly created contract.
     */
    public function store(StoreContractRequest $request)
    {
        $this->authorize('create', Contract::class);

        $validated = $request->validated();

        DB::transaction(function () use ($validated, $request) {
            $contract = Contract::create([
                'contract_number' => $this->generateContractNumber(),
                'project_id' => $validated['project_id'],
                'party_type' => $validated['party_type'],
                'party_name' => $validated['party_name'],
                'title' => $validated['title'],
                'description' => $validated['description'] ?? null,
                'contract_value' => $validated['contract_value'] ?? null,
                'start_date' => $validated['start_date'],
                'end_date' => $validated['end_date'] ?? null,
                'created_by' => Auth::id(),
                'status' => $validated['status'],
            ]);

        $this->handleAttachments($request, $contract);
        });

        return redirect()
            ->route('admin.contracts.index')
            ->with('success', 'Contract created successfully.');
    }

    /**
     * Display the specified contract.
     */
    public function show(Contract $contract)
    {
        $this->authorize('view', $contract);

        $contract->load([
            'project',
            'creator',
            'reviewer',
            'documents',
        ]);

        return view('admin.contracts.show', compact('contract'));
    }

    /**
     * Display printable view of the specified contract.
     */
    public function print(Contract $contract)
    {
        $this->authorize('view', $contract);

        $contract->load([
            'project',
            'creator',
            'reviewer',
            'documents',
        ]);

        return view('admin.contracts.print', compact('contract'));
    }

    /**
     * Show the form for editing the specified contract.
     */
    public function edit(Contract $contract)
    {
        $this->authorize('update', $contract);

        $projects = Project::query()
            ->orderBy('name')
            ->get();

        return view(
            'admin.contracts.edit',
            compact('contract', 'projects')
        );
    }

    /**
     * Update the specified contract.
     */
    public function update(UpdateContractRequest $request, Contract $contract)
    {
        $this->authorize('update', $contract);

        $validated = $request->validated();

        $contract->update([
            'project_id' => $validated['project_id'],
            'party_type' => $validated['party_type'],
            'party_name' => $validated['party_name'],
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'contract_value' => $validated['contract_value'] ?? null,
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'] ?? null,
            'status' => $validated['status'],
        ]);

        return redirect()
            ->route('admin.contracts.show', $contract)
            ->with('success', 'Contract updated successfully.');
    }

    /**
     * Remove the specified contract.
     */
    public function destroy(Contract $contract)
    {
        $this->authorize('delete', $contract);

        $contract->delete();

        return redirect()
            ->route('admin.contracts.index')
            ->with('success', 'Contract deleted successfully.');
    }

    /**
     * Submit a draft contract for review.
     */
    public function submit(Contract $contract)
    {
        $this->authorize('submit', $contract);

        if ($contract->status !== 'draft') {
            return back()->with(
                'error',
                'Only draft contracts can be submitted.'
            );
        }

        $contract->update([
            'status' => 'submitted',
        ]);

        return back()->with(
            'success',
            'Contract submitted successfully.'
        );
    }

    /**
     * Approve a submitted contract.
     */
    public function approve(Contract $contract)
    {
        $this->authorize('approve', $contract);

        if ($contract->status !== 'submitted') {
            return back()->with(
                'error',
                'Only submitted contracts can be approved.'
            );
        }

        $contract->update([
            'status' => 'approved',
            'reviewed_by' => Auth::id(),
            'reviewed_at' => now(),
            'rejection_reason' => null,
        ]);

        if ($contract->creator) {
            $contract->creator->notify(new \App\Notifications\SystemEventNotification(
                title: 'Contract Approved: ' . $contract->contract_number,
                message: "Contract '{$contract->title}' has been approved.",
                actionUrl: route('admin.contracts.show', $contract),
                type: 'success'
            ));
        }

        return back()->with(
            'success',
            'Contract approved successfully.'
        );
    }

    /**
     * Reject a submitted contract.
     */
    public function reject(Request $request, Contract $contract)
    {
        $this->authorize('reject', $contract);

        if ($contract->status !== 'submitted') {
            return back()->with(
                'error',
                'Only submitted contracts can be rejected.'
            );
        }

        $validated = $request->validate([
            'rejection_reason' => [
                'required',
                'string',
                'max:2000',
            ],
        ]);

        $contract->update([
            'status' => 'rejected',
            'rejection_reason' => $validated['rejection_reason'],
            'reviewed_by' => Auth::id(),
            'reviewed_at' => now(),
        ]);

        return back()->with(
            'success',
            'Contract rejected successfully.'
        );
    }

    /**
     * Activate an approved contract.
     */
    public function activate(Contract $contract)
    {
        $this->authorize('activate', $contract);

        if ($contract->status !== 'approved') {
            return back()->with(
                'error',
                'Only approved contracts can be activated.'
            );
        }

        $contract->update([
            'status' => 'active',
        ]);

        return back()->with(
            'success',
            'Contract activated successfully.'
        );
    }

    /**
     * Complete an active contract.
     */
    public function complete(Contract $contract)
    {
        $this->authorize('complete', $contract);

        if ($contract->status !== 'active') {
            return back()->with(
                'error',
                'Only active contracts can be completed.'
            );
        }

        $contract->update([
            'status' => 'completed',
        ]);

        return back()->with(
            'success',
            'Contract completed successfully.'
        );
    }

    /**
     * Terminate an active contract.
     */
    public function terminate(Contract $contract)
    {
        $this->authorize('terminate', $contract);

        if ($contract->status !== 'active') {
            return back()->with(
                'error',
                'Only active contracts can be terminated.'
            );
        }

        $contract->update([
            'status' => 'terminated',
        ]);

        return back()->with(
            'success',
            'Contract terminated successfully.'
        );
    }

    /**
     * Cancel a contract.
     */
    public function cancel(Contract $contract)
    {
        $this->authorize('cancel', $contract);

        if (in_array($contract->status, [
            'completed',
            'terminated',
            'cancelled',
        ], true)) {
            return back()->with(
                'error',
                'This contract cannot be cancelled.'
            );
        }

        $contract->update([
            'status' => 'cancelled',
        ]);

        return back()->with(
            'success',
            'Contract cancelled successfully.'
        );
    }

    /**
     * Generate a unique contract number.
     */
    protected function generateContractNumber(): string
    {
        $year = now()->format('Y');

        $lastContract = Contract::query()
            ->where('contract_number', 'like', "CNT-{$year}-%")
            ->orderByDesc('id')
            ->first();

        $nextNumber = $lastContract
            ? ((int) substr($lastContract->contract_number, -5)) + 1
            : 1;

        return sprintf(
            'CNT-%s-%05d',
            $year,
            $nextNumber
        );
    }
}
