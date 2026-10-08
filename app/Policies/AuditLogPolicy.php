<?php

namespace App\Policies;

use App\Models\AuditLog;
use App\Models\User;

class AuditLogPolicy
{
    /**
     * Determine whether the user can view any audit logs.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view_audit_logs');
    }

    /**
     * Determine whether the user can view the audit log.
     */
    public function view(User $user, AuditLog $auditLog): bool
    {
        return $user->can('view_audit_logs');
    }

    /**
     * Determine whether the user can export audit logs.
     */
    public function export(User $user): bool
    {
        return $user->can('export_audit_logs');
    }
}
