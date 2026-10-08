<?php

namespace App\Policies;

use App\Models\Expense;
use App\Models\User;

class ExpensePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('view_expenses');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Expense $expense): bool
    {
        return $user->hasPermissionTo('view_expenses');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create_expense');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Expense $expense): bool
    {
        // Only allow edits if draft or rejected
        if (!in_array($expense->status, ['draft', 'rejected'])) {
            return false;
        }

        return $user->hasPermissionTo('edit_expense');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Expense $expense): bool
    {
        if ($expense->status === 'approved') {
            return false;
        }

        return $user->hasPermissionTo('delete_expense');
    }

    /**
     * Determine whether the user can submit the expense.
     */
    public function submit(User $user, Expense $expense): bool
    {
        return $expense->status === 'draft' && $user->hasPermissionTo('submit_expense');
    }
    
    public function review(User $user, Expense $expense): bool
    {
        return $user->hasPermissionTo('review_expense');
    }

    /**
     * Determine whether the user can review/approve the expense.
     */
    public function approve(User $user, Expense $expense): bool
    {
        return $user->hasPermissionTo('approve_expense') &&
            in_array($expense->status, ['submitted', 'under_review']);
    }

    /**
     * Determine whether the user can reject the expense.
     */
    public function reject(User $user, Expense $expense): bool
    {
        return $user->hasPermissionTo('reject_expense') &&
            in_array($expense->status, ['submitted', 'under_review']);
    }
}
