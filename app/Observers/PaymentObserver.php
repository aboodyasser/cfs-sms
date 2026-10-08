<?php

namespace App\Observers;

use App\Models\Payment;
use App\Services\InvoiceFinancialService;

class PaymentObserver
{
    public function __construct(
        private InvoiceFinancialService $financialService
    ) {}

    /**
     * Handle the Payment "saved" event (covers both create and update).
     *
     * Only expense-type payments affect an invoice's paid/balance
     * figures; income-type payments have nothing stored to sync
     * (Income's remaining balance is always computed live).
     */
    public function saved(Payment $payment): void
    {
        $relevantChange = $payment->wasRecentlyCreated
            || $payment->wasChanged(['status', 'amount', 'invoice_id', 'payment_type']);

        if (!$relevantChange) {
            return;
        }

        if ($payment->payment_type === 'expense' && $payment->invoice_id) {
            $this->financialService->recalculateById($payment->invoice_id);
        }

        $originalInvoiceId = $payment->getOriginal('invoice_id');

        if ($originalInvoiceId && $originalInvoiceId !== $payment->invoice_id) {
            $this->financialService->recalculateById($originalInvoiceId);
        }
    }

    /**
     * Handle the Payment "deleted" event (also fires on soft delete).
     */
    public function deleted(Payment $payment): void
    {
        if ($payment->payment_type === 'expense' && $payment->invoice_id) {
            $this->financialService->recalculateById($payment->invoice_id);
        }
    }

    /**
     * Handle the Payment "restored" event.
     */
    public function restored(Payment $payment): void
    {
        if ($payment->payment_type === 'expense' && $payment->invoice_id) {
            $this->financialService->recalculateById($payment->invoice_id);
        }
    }
}
