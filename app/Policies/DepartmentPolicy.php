<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Department;

class DepartmentPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can('view_departments');
    }
    public function view(User $user, Department $model): bool
    {
        return $user->can('view_departments');
    }
    public function create(User $user): bool
    {
        return $user->can('manage_departments');
    }
    public function update(User $user, Department $model): bool
    {
        return $user->can('manage_departments');
    }
    public function delete(User $user, Department $model): bool
    {
        return $user->can('manage_departments');
    }
}
