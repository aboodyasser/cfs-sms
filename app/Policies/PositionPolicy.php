<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Position;

class PositionPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can('view_positions');
    }
    public function view(User $user, Position $model): bool
    {
        return $user->can('view_positions');
    }
    public function create(User $user): bool
    {
        return $user->can('manage_positions');
    }
    public function update(User $user, Position $model): bool
    {
        return $user->can('manage_positions');
    }
    public function delete(User $user, Position $model): bool
    {
        return $user->can('manage_positions');
    }
}
