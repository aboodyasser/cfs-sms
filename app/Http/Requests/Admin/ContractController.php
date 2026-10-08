<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreContractRequest;
use App\Http\Requests\Admin\UpdateContractRequest;
use App\Models\Contract;
use App\Models\Project;
use App\Services\AuditLogService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContractController extends Controller
{
    public function __construct(
        private AuditLogService $auditLog
    ) {}

    public function index(Request $request)
    {
        $this->authorize('viewAny', Contract::class);

        $contracts = Contract::query()
            ->with(['project', 'creator'])
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
            'admin.contracts.index',
            compact('contracts')
        );
    }

    public function create()
    {
        $this->authorize('create', Contract::class);

        $projects = Project::query()
            ->orderBy('name')
            ->get();

        return view(
            'admin.contracts.create',
            compact('projects')
        );
    }

    public function store(StoreContractRequest $request)
    {
        $validated = $request->validated();

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

        $this->auditLog->log(
            'contract.created',
            "Created contract {$contract->contract_number} ({$contract->title})",
            $contract,
            null,
            $contract->only(['party_type', 'party_name', 'contract_value', 'status'])
        );

        return redirect()
            ->route('admin.contracts.show', $contract)
            ->with('success', 'Contract created successfully.');
    }

    public function show(Contract $contract)
    {
        $this->authorize('view', $contract);

        $contract->load([
            'project',
            'creator',
            'reviewer',
            'documents',
        ]);

        return view(
            'admin.contracts.show',
            compact('contract')
        );
    }

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

    public function update(
        UpdateContractRequest $request,
        Contract $contract
    ) {
        $before = $contract->only(['party_name', 'title', 'contract_value', 'end_date']);

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
        ]);

        $this->auditLog->log(
            'contract.updated',
            "Updated contract {$contract->contract_number}",
            $contract,
            $before,
            $contract->only(['party_name', 'title', 'contract_value', 'end_date'])
        );

        return redirect()
            ->route('admin.contracts.show', $contract)
            ->with('success', 'Contract updated successfully.');
    }

    public function destroy(Contract $contract)
    {
        $this->authorize('delete', $contract);

        $number = $contract->contract_number;
        $snapshot = $contract->only(['party_name', 'title', 'status']);

        $contract->delete();

        $this->auditLog->log(
            'contract.deleted',
            "Deleted contract {$number}",
            null,
            $snapshot,
            null
        );

        return redirect()
            ->route('admin.contracts.index')
            ->with('success', 'Contract deleted successfully.');
    }

    public function submit(Contract $contract)
    {
        $this->authorize('submit', $contract);

        $contract->update([
            'status' => 'submitted',
        ]);

        $this->auditLog->log(
            'contract.submitted',
            "Submitted contract {$contract->contract_number} for approval",
            $contract
        );

        return back()->with(
            'success',
            'Contract submitted successfully.'
        );
    }

    public function approve(Contract $contract)
    {
        $this->authorize('approve', $contract);

        $contract->update([
            'status' => 'approved',
            'reviewed_by' => Auth::id(),
            'reviewed_at' => now(),
            'rejection_reason' => null,
        ]);

        $this->auditLog->log(
            'contract.approved',
            "Approved contract {$contract->contract_number}",
            $contract
        );

        return back()->with(
            'success',
            'Contract approved successfully.'
        );
    }

    public function reject(Request $request, Contract $contract)
    {
        $this->authorize('reject', $contract);

        $validated = $request->validate([
            'rejection_reason' => [
                'required',
                'string',
                'max:2000',
            ],
        ]);

        $contract->update([
            'status' => 'draft',
            'rejection_reason' => $validated['rejection_reason'],
            'reviewed_by' => Auth::id(),
            'reviewed_at' => now(),
        ]);

        $this->auditLog->log(
            'contract.rejected',
            "Rejected contract {$contract->contract_number}: {$validated['rejection_reason']}",
            $contract
        );

        return back()->with(
            'success',
            'Contract rejected successfully.'
        );
    }

    /**
     * Mark an approved contract as signed and in effect.
     */
    public function activate(Contract $contract)
    {
        $this->authorize('activate', $contract);

        $contract->update([
            'status' => 'active',
        ]);

        $this->auditLog->log(
            'contract.activated',
            "Activated contract {$contract->contract_number}",
            $contract
        );

        return back()->with(
            'success',
            'Contract activated successfully.'
        );
    }

    public function complete(Contract $contract)
    {
        $this->authorize('complete', $contract);

        $contract->update([
            'status' => 'completed',
        ]);

        $this->auditLog->log(
            'contract.completed',
            "Completed contract {$contract->contract_number}",
            $contract
        );

        return back()->with(
            'success',
            'Contract marked as completed.'
        );
    }

    public function terminate(Request $request, Contract $contract)
    {
        $this->authorize('terminate', $contract);

        $validated = $request->validate([
            'rejection_reason' => [
                'nullable',
                'string',
                'max:2000',
            ],
        ]);

        $contract->update([
            'status' => 'terminated',
            'rejection_reason' => $validated['rejection_reason'] ?? null,
        ]);

        $this->auditLog->log(
            'contract.terminated',
            "Terminated contract {$contract->contract_number}",
            $contract
        );

        return back()->with(
            'success',
            'Contract terminated successfully.'
        );
    }

    public function cancel(Contract $contract)
    {
        $this->authorize('cancel', $contract);

        $contract->update([
            'status' => 'cancelled',
        ]);

        $this->auditLog->log(
            'contract.cancelled',
            "Cancelled contract {$contract->contract_number}",
            $contract
        );

        return back()->with(
            'success',
            'Contract cancelled successfully.'
        );
    }

    private function generateContractNumber(): string
    {
        $prefix = 'CON-' . now()->format('Ym') . '-';

        $last = Contract::withTrashed()
            ->where('contract_number', 'like', $prefix . '%')
            ->latest('id')
            ->first();

        $next = $last
            ? ((int) substr($last->contract_number, -5)) + 1
            : 1;

        return $prefix . str_pad(
            $next,
            5,
            '0',
            STR_PAD_LEFT
        );
    }
}
