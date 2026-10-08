<?php

namespace App\Policies;

use App\Models\Income;
use App\Models\User;

class IncomePolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can('view_incomes')
            || $user->can('create_income')
            || $user->can('approve_income');
    }

    public function view(User $user, Income $income): bool
    {
        return $this->viewAny($user);
    }

    public function create(User $user): bool
    {
        return $user->can('create_income');
    }

    public function update(User $user, Income $income): bool
    {
        return $income->status === 'draft'
            && $user->can('edit_income');
    }

    public function delete(User $user, Income $income): bool
    {
        return $income->status === 'draft'
            && $user->can('delete_income');
    }

    public function submit(User $user, Income $income): bool
    {
        return $income->status === 'draft'
            && $user->can('submit_income');
    }

    public function approve(User $user, Income $income): bool
    {
        return $income->status === 'submitted'
            && $user->can('approve_income');
    }

    public function reject(User $user, Income $income): bool
    {
        return $income->status === 'submitted'
            && $user->can('reject_income');
    }
}
