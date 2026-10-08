<?php

namespace App\Policies;

use App\Models\Contract;
use App\Models\User;

class ContractPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can('view_contracts');
    }

    public function view(User $user, Contract $contract): bool
    {
        return $user->can('view_contracts');
    }

    public function create(User $user): bool
    {
        return $user->can('create_contract');
    }

    /**
     * Only a draft contract can still be freely edited — once
     * submitted, changes must go through reject (back to draft)
     * rather than a silent edit.
     */
    public function update(User $user, Contract $contract): bool
    {
        return $contract->status === 'draft'
            && $user->can('edit_contract');
    }

    public function delete(User $user, Contract $contract): bool
    {
        return $contract->status === 'draft'
            && $user->can('delete_contract');
    }

    public function submit(User $user, Contract $contract): bool
    {
        return $contract->status === 'draft'
            && $user->can('submit_contract');
    }

    public function approve(User $user, Contract $contract): bool
    {
        return $contract->status === 'submitted'
            && $user->can('approve_contract');
    }

    public function reject(User $user, Contract $contract): bool
    {
        return $contract->status === 'submitted'
            && $user->can('reject_contract');
    }

    /**
     * Mark an approved contract as signed/in effect.
     */
    public function activate(User $user, Contract $contract): bool
    {
        return $contract->status === 'approved'
            && $user->can('activate_contract');
    }

    public function complete(User $user, Contract $contract): bool
    {
        return $contract->status === 'active'
            && $user->can('complete_contract');
    }

    public function terminate(User $user, Contract $contract): bool
    {
        return $contract->status === 'active'
            && $user->can('terminate_contract');
    }

    public function cancel(User $user, Contract $contract): bool
    {
        return in_array($contract->status, ['draft', 'submitted', 'approved'], true)
            && $user->can('cancel_contract');
    }
}
