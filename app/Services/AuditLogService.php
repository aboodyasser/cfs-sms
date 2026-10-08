<?php

namespace App\Services;

use App\Models\AuditLog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class AuditLogService
{
    /**
     * Record a single, human-initiated audit event.
     *
     * Only call this from controller actions that represent a
     * deliberate user decision (create/update/delete, and workflow
     * actions like submit/approve/reject/cancel). Never call this
     * from model observers or the *FinancialService classes that
     * perform automatic, derived recalculations — those are
     * system-derived side effects, not user decisions.
     */
    public function log(
        string $action,
        string $description,
        ?Model $auditable = null,
        ?array $oldValues = null,
        ?array $newValues = null
    ): void {
        AuditLog::create([
            'user_id' => Auth::id(),
            'action' => $action,
            'description' => $description,
            'auditable_type' => $auditable?->getMorphClass(),
            'auditable_id' => $auditable?->getKey(),
            'ip_address' => Request::ip(),
            'user_agent' => Request::userAgent(),
            'old_values' => $oldValues,
            'new_values' => $newValues,
        ]);
    }
}
