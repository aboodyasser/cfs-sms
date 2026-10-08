<?php

namespace App\Models;

use App\Models\Budget;
use App\Services\ProjectFinancialService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'code',
        'name',
        'description',
        'manager_id',
        'department_id',
        'donor',
        'location',
        'start_date',
        'end_date',
        'status',
        'completion_percentage',
        'total_budget',
        'spent_amount',
        'remaining_budget',
        'spending_percentage',
        'burn_rate',
    ];

    protected function casts(): array
    {
        return [
            'start_date' => 'date',
            'end_date' => 'date',
            'completion_percentage' => 'integer',
            'total_budget' => 'decimal:2',
            'spent_amount' => 'decimal:2',
            'remaining_budget' => 'decimal:2',
            'spending_percentage' => 'decimal:2',
            'burn_rate' => 'decimal:2',
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    /**
     * Project manager.
     */
    public function manager(): BelongsTo
    {
        return $this->belongsTo(User::class, 'manager_id');
    }

    /**
     * Department responsible for the project.
     */
    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    /**
     * Expenses associated with the project.
     */
    public function expenses(): HasMany
    {
        return $this->hasMany(Expense::class);
    }

    /**
     * Documents associated with the project.
     */
    public function documents(): HasMany
    {
        return $this->hasMany(Document::class);
    }

    public function incomes(): HasMany
    {
        return $this->hasMany(Income::class);
    }

    public function budgets(): HasMany
    {
        return $this->hasMany(Budget::class);
    }

    public function invoices(): HasMany
    {
        return $this->hasMany(Invoice::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Financial Methods
    |--------------------------------------------------------------------------
    */

    /**
     * Recalculate the project's financial figures based on approved expenses.
     *
     * Delegates to ProjectFinancialService, which is now the single
     * source of truth for this calculation. Kept here so any existing
     * code calling $project->recalculateFinancials() directly is
     * unaffected.
     */
    public function recalculateFinancials(): Project
    {
        return app(ProjectFinancialService::class)->recalculate($this);
    }

    /**
     * Polymorphic attachments for the project.
     */
    public function attachments(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany(Attachment::class, 'attachable');
    }
}
