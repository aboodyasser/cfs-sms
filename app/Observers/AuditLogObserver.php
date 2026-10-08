<?php

namespace App\Observers;

use App\Models\AuditLog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class AuditLogObserver
{
    /**
     * Handle the model "created" event.
     */
    public function created(Model $model): void
    {
        $this->log(
            event: 'created',
            action: 'created',
            model: $model,
            description: $this->buildDescription('created', $model),
            oldValues: null,
            newValues: $model->getAttributes()
        );
    }

    /**
     * Handle the model "updated" event.
     */
    public function updated(Model $model): void
    {
        $changes = $model->getChanges();

        if (empty($changes)) {
            return;
        }

        $oldValues = [];

        foreach (array_keys($changes) as $key) {
            $oldValues[$key] = $model->getOriginal($key);
        }

        $this->log(
            event: 'updated',
            action: 'updated',
            model: $model,
            description: $this->buildDescription('updated', $model),
            oldValues: $oldValues,
            newValues: $changes
        );
    }

    /**
     * Handle the model "deleted" event.
     */
    public function deleted(Model $model): void
    {
        $this->log(
            event: 'deleted',
            action: 'deleted',
            model: $model,
            description: $this->buildDescription('deleted', $model),
            oldValues: $model->getAttributes(),
            newValues: null
        );
    }

    /**
     * Create an audit log entry.
     */
    protected function log(
        string $event,
        string $action,
        Model $model,
        string $description,
        ?array $oldValues,
        ?array $newValues
    ): void {
        // Never audit the AuditLog model itself.
        if ($model instanceof AuditLog) {
            return;
        }

        AuditLog::create([
            'user_id' => Auth::id(),
            'event' => $event,
            'action' => $action,
            'description' => $description,
            'auditable_type' => $model::class,
            'auditable_id' => $model->getKey(),
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'old_values' => $oldValues,
            'new_values' => $newValues,
        ]);
    }

    /**
     * Build a readable audit description.
     */
    protected function buildDescription(
        string $action,
        Model $model
    ): string {
        $modelName = class_basename($model);

        $identifier = $model->getAttribute('name')
            ?? $model->getAttribute('title')
            ?? $model->getAttribute('code')
            ?? $model->getKey();

        return "{$modelName} #{$identifier} was {$action}.";
    }
}
