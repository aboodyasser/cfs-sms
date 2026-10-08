<?php

namespace App\Policies;

use App\Models\Budget;
use App\Models\User;

class BudgetPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can('view_budgets');
    }

    public function view(User $user, Budget $budget): bool
    {
        return $user->can('view_budgets');
    }

    public function create(User $user): bool
    {
        return $user->can('create_budget');
    }

    public function update(User $user, Budget $budget): bool
    {
        return $user->can('edit_budget');
    }

    public function delete(User $user, Budget $budget): bool
    {
        return $user->can('delete_budget');
    }
}
