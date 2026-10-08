<?php

namespace App\Services;

use App\Models\Project;

class ProjectFinancialService
{
    /**
     * Recalculate all financial indicators for a project.
     *
     * Only approved expenses are included in the actual spending.
     */
    public function recalculate(Project $project): Project
    {
        $spentAmount = (float) $project->expenses()
            ->approved()
            ->sum('amount');

        $totalBudget = (float) $project->total_budget;

        $remainingBudget = max(
            $totalBudget - $spentAmount,
            0
        );

        $spendingPercentage = $totalBudget > 0
            ? ($spentAmount / $totalBudget) * 100
            : 0;

        $burnRate = $this->calculateBurnRate($project, $spentAmount);

        $project->update([
            'spent_amount' => round($spentAmount, 2),
            'remaining_budget' => round($remainingBudget, 2),
            'spending_percentage' => round($spendingPercentage, 2),
            'burn_rate' => round($burnRate, 2),
        ]);

        return $project->refresh();
    }

    /**
     * Calculate the average monthly spending rate.
     *
     * Burn rate = approved spending / months elapsed so far,
     * capped at today for projects still in progress.
     *
     * This is the single canonical implementation — it previously
     * existed with slightly different logic on the Project model
     * itself, which has been removed to avoid the two drifting apart.
     */
    private function calculateBurnRate(Project $project, float $spentAmount): float
    {
        if (!$project->start_date) {
            return 0;
        }

        $startDate = $project->start_date->copy()->startOfDay();
        $today = now()->startOfDay();

        if ($today->lt($startDate)) {
            return 0;
        }

        $endDate = $project->end_date
            ? $project->end_date->copy()->startOfDay()
            : $today;

        $calculationEndDate = $today->lt($endDate)
            ? $today
            : $endDate;

        $months = max(
            1,
            $startDate->diffInMonths($calculationEndDate) + 1
        );

        return $spentAmount / $months;
    }

    /**
     * Recalculate a project by its ID.
     */
    public function recalculateById(int $projectId): ?Project
    {
        $project = Project::find($projectId);

        if (!$project) {
            return null;
        }

        return $this->recalculate($project);
    }
}
