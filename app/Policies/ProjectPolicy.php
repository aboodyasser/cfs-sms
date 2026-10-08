<?php

namespace App\Policies;

use App\Models\Project;
use App\Models\User;

class ProjectPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can('view_projects');
    }

    public function view(User $user, Project $project): bool
    {
        return $user->can('view_projects');
    }

    public function create(User $user): bool
    {
        return $user->can('create_project');
    }

    public function update(User $user, Project $project): bool
    {
        return $user->can('edit_project');
    }

    public function delete(User $user, Project $project): bool
    {
        return $user->can('delete_project');
    }

    public function restore(User $user, Project $project): bool
    {
        return $user->can('edit_project');
    }

    public function forceDelete(User $user, Project $project): bool
    {
        return $user->can('delete_project');
    }
}
