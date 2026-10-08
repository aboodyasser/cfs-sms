<?php

namespace App\Policies;

use App\Models\Receipt;
use App\Models\User;

class ReceiptPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can('view_receipts');
    }

    public function view(User $user, Receipt $receipt): bool
    {
        return $user->can('view_receipts');
    }

    public function create(User $user): bool
    {
        return $user->can('create_receipt');
    }

    public function cancel(User $user, Receipt $receipt): bool
    {
        return $user->can('cancel_receipt');
    }
}
