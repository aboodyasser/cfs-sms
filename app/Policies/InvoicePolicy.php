<?php

namespace App\Policies;

use App\Models\Invoice;
use App\Models\User;

class InvoicePolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can('view_invoices');
    }

    public function view(User $user, Invoice $invoice): bool
    {
        return $user->can('view_invoices');
    }

    public function create(User $user): bool
    {
        return $user->can('create_invoice');
    }

    public function update(User $user, Invoice $invoice): bool
    {
        return $invoice->paid_amount <= 0
            && $user->can('edit_invoice');
    }

    public function delete(User $user, Invoice $invoice): bool
    {
        return $invoice->paid_amount <= 0
            && $user->can('delete_invoice');
    }

    /**
     * Move a draft invoice into the approval queue.
     */
    public function submit(User $user, Invoice $invoice): bool
    {
        return $invoice->status === 'draft'
            && $user->can('submit_invoice');
    }

    /**
     * Approve a submitted invoice. Requires a dedicated permission,
     * separate from create_invoice/edit_invoice, so approval authority
     * can be granted independently of data-entry authority.
     */
    public function approve(User $user, Invoice $invoice): bool
    {
        return $invoice->status === 'submitted'
            && $user->can('approve_invoice');
    }

    /**
     * Reject a submitted invoice back to draft.
     */
    public function reject(User $user, Invoice $invoice): bool
    {
        return $invoice->status === 'submitted'
            && $user->can('reject_invoice');
    }

    /**
     * Cancel a draft or submitted invoice that hasn't been approved
     * or paid yet.
     */
    public function cancel(User $user, Invoice $invoice): bool
    {
        return in_array($invoice->status, ['draft', 'submitted'], true)
            && $invoice->paid_amount <= 0
            && $user->can('cancel_invoice');
    }
}
