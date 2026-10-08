<?php

namespace App\Services;

use App\Models\Budget;

class BudgetFinancialService
{
    /**
     * Statuses considered a committed draw against the budget.
     * Draft/submitted invoices aren't committed yet; cancelled ones
     * never were.
     */
    private const SPENT_STATUSES = [
        'approved',
        'partially_paid',
        'paid',
        'overdue',
    ];

    /**
     * Recalculate spent/remaining/percentage for a budget based on
     * its linked invoices.
     */
    public function recalculate(Budget $budget): Budget
    {
        $spentAmount = (float) $budget->invoices()
            ->whereIn('status', self::SPENT_STATUSES)
            ->sum('total_amount');

        $allocatedAmount = (float) $budget->allocated_amount;

        $remainingAmount = max(
            $allocatedAmount - $spentAmount,
            0
        );

        $spendingPercentage = $allocatedAmount > 0
            ? ($spentAmount / $allocatedAmount) * 100
            : 0;

        $budget->update([
            'spent_amount' => round($spentAmount, 2),
            'remaining_amount' => round($remainingAmount, 2),
            'spending_percentage' => round($spendingPercentage, 2),
        ]);

        return $budget->refresh();
    }

    /**
     * Recalculate a budget by its ID.
     */
    public function recalculateById(int $budgetId): ?Budget
    {
        $budget = Budget::find($budgetId);

        if (!$budget) {
            return null;
        }

        return $this->recalculate($budget);
    }
}
