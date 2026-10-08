<?php

namespace App\Services;

use App\Models\Invoice;

class InvoiceFinancialService
{
    /**
     * Invoice statuses that represent an active payment lifecycle.
     * Recalculation only moves an invoice between these — it never
     * pulls an invoice back to draft/submitted/cancelled.
     */
    private const PAYABLE_STATUSES = [
        'approved',
        'partially_paid',
        'paid',
        'overdue',
    ];

    /**
     * Recalculate an invoice's paid_amount/balance_amount/status from
     * the sum of its actual completed expense payments, rather than
     * incrementing/decrementing on every payment action.
     */
    public function recalculate(Invoice $invoice): Invoice
    {
        $paid = (float) $invoice->payments()
            ->where('payment_type', 'expense')
            ->where('status', 'completed')
            ->sum('amount');

        $total = (float) $invoice->total_amount;
        $balance = max($total - $paid, 0);

        $status = $invoice->status;

        if (in_array($invoice->status, self::PAYABLE_STATUSES, true)) {
            $status = match (true) {
                $balance <= 0 && $paid > 0 => 'paid',
                $paid > 0 => 'partially_paid',
                default => 'approved',
            };
        }

        $invoice->update([
            'paid_amount' => round($paid, 2),
            'balance_amount' => round($balance, 2),
            'status' => $status,
        ]);

        return $invoice->refresh();
    }

    /**
     * Recalculate an invoice by its ID.
     */
    public function recalculateById(int $invoiceId): ?Invoice
    {
        $invoice = Invoice::find($invoiceId);

        if (!$invoice) {
            return null;
        }

        return $this->recalculate($invoice);
    }
}
