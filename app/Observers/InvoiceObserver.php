<?php

namespace App\Observers;

use App\Models\Invoice;
use App\Services\BudgetFinancialService;

class InvoiceObserver
{
    public function __construct(
        private BudgetFinancialService $financialService
    ) {}

    /**
     * Handle the Invoice "saved" event (covers both create and update).
     */
    public function saved(Invoice $invoice): void
    {
        $relevantChange = $invoice->wasRecentlyCreated
            || $invoice->wasChanged(['status', 'total_amount', 'budget_id']);

        if (!$relevantChange) {
            return;
        }

        if ($invoice->budget_id) {
            $this->financialService->recalculateById($invoice->budget_id);
        }

        $originalBudgetId = $invoice->getOriginal('budget_id');

        if ($originalBudgetId && $originalBudgetId !== $invoice->budget_id) {
            $this->financialService->recalculateById($originalBudgetId);
        }
    }

    /**
     * Handle the Invoice "deleted" event (also fires on soft delete).
     */
    public function deleted(Invoice $invoice): void
    {
        if ($invoice->budget_id) {
            $this->financialService->recalculateById($invoice->budget_id);
        }
    }

    /**
     * Handle the Invoice "restored" event.
     */
    public function restored(Invoice $invoice): void
    {
        if ($invoice->budget_id) {
            $this->financialService->recalculateById($invoice->budget_id);
        }
    }
}
