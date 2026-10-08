<?php

namespace App\Observers;

use App\Models\Expense;
use App\Services\ProjectFinancialService;

class ExpenseObserver
{
    public function __construct(
        private ProjectFinancialService $financialService
    ) {}

    /**
     * Handle the Expense "saved" event (covers both create and update).
     *
     * Only recalculates when something that actually affects project
     * financials changed, to avoid unnecessary work on unrelated edits
     * (title, description, vendor, etc.).
     */
    public function saved(Expense $expense): void
    {
        $relevantChange = $expense->wasRecentlyCreated
            || $expense->wasChanged(['status', 'amount', 'project_id']);

        if (!$relevantChange) {
            return;
        }

        if ($expense->project_id) {
            $this->financialService->recalculateById($expense->project_id);
        }

        $originalProjectId = $expense->getOriginal('project_id');

        if ($originalProjectId && $originalProjectId !== $expense->project_id) {
            $this->financialService->recalculateById($originalProjectId);
        }
    }

    /**
     * Handle the Expense "deleted" event (also fires on soft delete).
     */
    public function deleted(Expense $expense): void
    {
        if ($expense->project_id) {
            $this->financialService->recalculateById($expense->project_id);
        }
    }

    /**
     * Handle the Expense "restored" event.
     */
    public function restored(Expense $expense): void
    {
        if ($expense->project_id) {
            $this->financialService->recalculateById($expense->project_id);
        }
    }
}
