<?php

namespace App\Providers;

use App\Models\Budget;
use App\Models\Department;
use App\Models\Document;
use App\Models\Expense;
use App\Models\Income;
use App\Models\Invoice;
use App\Models\Payment;
use App\Models\Position;
use App\Models\Project;
use App\Models\Receipt;
use App\Observers\AuditLogObserver;
use App\Observers\ExpenseObserver;
use App\Policies\BudgetPolicy;
use App\Policies\ExpensePolicy;
use App\Policies\IncomePolicy;
use App\Policies\InvoicePolicy;
use App\Observers\InvoiceObserver;
use App\Policies\PaymentPolicy;
use App\Observers\PaymentObserver;
use App\Policies\ProjectPolicy;
use App\Policies\ReceiptPolicy;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        App::setLocale(
            session('locale', config('app.locale'))
        );

        // تسجيل الـ Policies دفعة واحدة باستخدام مصفوفة
        $policies = [
            Project::class => ProjectPolicy::class,
            Expense::class => ExpensePolicy::class,
            Income::class => IncomePolicy::class,
            Budget::class => BudgetPolicy::class,
            Invoice::class => InvoicePolicy::class,
            Payment::class => PaymentPolicy::class,
            Receipt::class => ReceiptPolicy::class,
        ];

        foreach ($policies as $model => $policy) {
            Gate::policy($model, $policy);
        }
        Gate::before(function ($user, $ability) {
            return $user->hasRole('Super Admin') ? true : null;
        });

        // تسجيل الـ AuditLogObserver للنماذج التي تحتاج إليه
        $auditedModels = [
            Project::class,
            Expense::class,
            Document::class,
            Income::class,
            Budget::class,
            Invoice::class,
            Payment::class,
            Receipt::class,
            Department::class,
            Position::class,
        ];

        foreach ($auditedModels as $model) {
            $model::observe(AuditLogObserver::class);
        }

        // تسجيل الـ Observers الخاصة بكل نموذج منفردة (مثل ExpenseObserver)
        Expense::observe(ExpenseObserver::class);
        Invoice::observe(InvoiceObserver::class);
        Payment::observe(PaymentObserver::class);
    }
}
