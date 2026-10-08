<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\PositionController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\ExpenseController;
use App\Http\Controllers\Admin\DocumentController;
use App\Http\Controllers\Admin\IncomeController;
use App\Http\Controllers\Admin\BudgetController;
use App\Http\Controllers\Admin\InvoiceController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\ReceiptController;
use App\Http\Controllers\Admin\FinancialReportController;
use App\Http\Controllers\Admin\ContractController;
use App\Http\Controllers\Admin\AuditLogController;
use App\Http\Controllers\Admin\AttachmentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// ==========================================================
// Authenticated & Active Users
// ==========================================================

Route::middleware(['auth', 'active.user'])->group(function () {

    // ======================================================
    // Dashboard
    // ======================================================

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // ======================================================
    // Admin Panel Routes
    // ======================================================

    Route::prefix('admin')
        ->name('admin.')
        ->group(function () {

            // --------------------------------------------
            // System Map (Development & Full Testing Hub)
            // --------------------------------------------
            Route::get('system-map', function () {
                return view('admin.system-map');
            })->name('system.map');

            // --------------------------------------------
            // Users
            // --------------------------------------------
            Route::get('users', [UserController::class, 'index'])->middleware('permission:view_users')->name('users.index');
            Route::get('users/create', [UserController::class, 'create'])->middleware('permission:create_user')->name('users.create');
            Route::post('users', [UserController::class, 'store'])->middleware('permission:create_user')->name('users.store');
            Route::get('users/{user}', [UserController::class, 'show'])->middleware('permission:view_users')->name('users.show');
            Route::get('users/{user}/edit', [UserController::class, 'edit'])->middleware('permission:edit_user')->name('users.edit');
            Route::put('users/{user}', [UserController::class, 'update'])->middleware('permission:edit_user')->name('users.update');
            Route::delete('users/{user}', [UserController::class, 'destroy'])->middleware('permission:delete_user')->name('users.destroy');
            Route::patch('users/{user}/activate', [UserController::class, 'activate'])->middleware('permission:edit_user')->name('users.activate');
            Route::patch('users/{user}/deactivate', [UserController::class, 'deactivate'])->middleware('permission:edit_user')->name('users.deactivate');

            // --------------------------------------------
            // Roles
            // --------------------------------------------
            Route::get('roles', [RoleController::class, 'index'])->middleware('permission:view_roles')->name('roles.index');
            Route::get('roles/create', [RoleController::class, 'create'])->middleware('permission:manage_roles')->name('roles.create');
            Route::post('roles', [RoleController::class, 'store'])->middleware('permission:manage_roles')->name('roles.store');
            Route::get('roles/{role}', [RoleController::class, 'show'])->middleware('permission:view_roles')->name('roles.show');
            Route::get('roles/{role}/edit', [RoleController::class, 'edit'])->middleware('permission:manage_roles')->name('roles.edit');
            Route::put('roles/{role}', [RoleController::class, 'update'])->middleware('permission:manage_roles')->name('roles.update');
            Route::delete('roles/{role}', [RoleController::class, 'destroy'])->middleware('permission:manage_roles')->name('roles.destroy');

            // --------------------------------------------
            // Departments
            // --------------------------------------------
            Route::get('departments', [DepartmentController::class, 'index'])->middleware('permission:view_departments')->name('departments.index');
            Route::get('departments/create', [DepartmentController::class, 'create'])->middleware('permission:manage_departments')->name('departments.create');
            Route::post('departments', [DepartmentController::class, 'store'])->middleware('permission:manage_departments')->name('departments.store');
            Route::get('departments/{department}', [DepartmentController::class, 'show'])->middleware('permission:view_departments')->name('departments.show');
            Route::get('departments/{department}/edit', [DepartmentController::class, 'edit'])->middleware('permission:manage_departments')->name('departments.edit');
            Route::put('departments/{department}', [DepartmentController::class, 'update'])->middleware('permission:manage_departments')->name('departments.update');
            Route::patch('departments/{department}/activate', [DepartmentController::class, 'activate'])->middleware('permission:manage_departments')->name('departments.activate');
            Route::patch('departments/{department}/deactivate', [DepartmentController::class, 'deactivate'])->middleware('permission:manage_departments')->name('departments.deactivate');

            // --------------------------------------------
            // Positions
            // --------------------------------------------
            Route::get('positions', [PositionController::class, 'index'])->middleware('permission:view_positions')->name('positions.index');
            Route::get('positions/create', [PositionController::class, 'create'])->middleware('permission:manage_positions')->name('positions.create');
            Route::post('positions', [PositionController::class, 'store'])->middleware('permission:manage_positions')->name('positions.store');
            Route::get('positions/{position}', [PositionController::class, 'show'])->middleware('permission:view_positions')->name('positions.show');
            Route::get('positions/{position}/edit', [PositionController::class, 'edit'])->middleware('permission:manage_positions')->name('positions.edit');
            Route::put('positions/{position}', [PositionController::class, 'update'])->middleware('permission:manage_positions')->name('positions.update');
            Route::patch('positions/{position}/activate', [PositionController::class, 'activate'])->middleware('permission:manage_positions')->name('positions.activate');
            Route::patch('positions/{position}/deactivate', [PositionController::class, 'deactivate'])->middleware('permission:manage_positions')->name('positions.deactivate');

            // --------------------------------------------
            // Projects
            // --------------------------------------------
            Route::get('projects', [ProjectController::class, 'index'])->middleware('permission:view_projects')->name('projects.index');
            Route::get('projects/create', [ProjectController::class, 'create'])->middleware('permission:create_project')->name('projects.create');
            Route::post('projects', [ProjectController::class, 'store'])->middleware('permission:create_project')->name('projects.store');
            Route::get('projects/{project}', [ProjectController::class, 'show'])->middleware('permission:view_projects')->name('projects.show');
            Route::get('projects/{project}/edit', [ProjectController::class, 'edit'])->middleware('permission:edit_project')->name('projects.edit');
            Route::put('projects/{project}', [ProjectController::class, 'update'])->middleware('permission:edit_project')->name('projects.update');
            Route::delete('projects/{project}', [ProjectController::class, 'destroy'])->middleware('permission:delete_project')->name('projects.destroy');

            // --------------------------------------------
            // Expenses
            // --------------------------------------------
            Route::get('expenses', [ExpenseController::class, 'index'])->middleware('permission:view_expenses')->name('expenses.index');
            Route::get('expenses/create', [ExpenseController::class, 'create'])->middleware('permission:create_expense')->name('expenses.create');
            Route::post('expenses', [ExpenseController::class, 'store'])->middleware('permission:create_expense')->name('expenses.store');
            Route::get('expenses/{expense}', [ExpenseController::class, 'show'])->middleware('permission:view_expenses')->name('expenses.show');
            Route::get('expenses/{expense}/edit', [ExpenseController::class, 'edit'])->middleware('permission:edit_expense')->name('expenses.edit');
            Route::put('expenses/{expense}', [ExpenseController::class, 'update'])->middleware('permission:edit_expense')->name('expenses.update');
            Route::delete('expenses/{expense}', [ExpenseController::class, 'destroy'])->middleware('permission:edit_expense')->name('expenses.destroy');
            Route::post('expenses/{expense}/submit', [ExpenseController::class, 'submit'])->middleware('permission:submit_expense')->name('expenses.submit');
            Route::post('expenses/{expense}/review', [ExpenseController::class, 'review'])->middleware('permission:review_expense')->name('expenses.review');
            Route::post('expenses/{expense}/approve', [ExpenseController::class, 'approve'])->middleware('permission:approve_expense')->name('expenses.approve');
            Route::post('expenses/{expense}/reject', [ExpenseController::class, 'reject'])->middleware('permission:reject_expense')->name('expenses.reject');

            // --------------------------------------------
            // Documents
            // --------------------------------------------
            Route::get('documents', [DocumentController::class, 'index'])->middleware('permission:view_documents')->name('documents.index');
            Route::get('documents/create', [DocumentController::class, 'create'])->middleware('permission:upload_document')->name('documents.create');
            Route::post('documents', [DocumentController::class, 'store'])->middleware('permission:upload_document')->name('documents.store');
            Route::get('documents/{document}/download', [DocumentController::class, 'download'])->middleware('permission:download_document')->name('documents.download');
            Route::get('documents/{document}', [DocumentController::class, 'show'])->middleware('permission:view_documents')->name('documents.show');
            Route::get('documents/{document}/edit', [DocumentController::class, 'edit'])->middleware('permission:edit_document')->name('documents.edit');
            Route::put('documents/{document}', [DocumentController::class, 'update'])->middleware('permission:edit_document')->name('documents.update');
            Route::delete('documents/{document}', [DocumentController::class, 'destroy'])->middleware('permission:delete_document')->name('documents.destroy');

            // --------------------------------------------
            // Financial Module: Incomes
            // --------------------------------------------
            Route::get('incomes', [IncomeController::class, 'index'])->middleware('permission:view_incomes')->name('incomes.index');
            Route::get('incomes/create', [IncomeController::class, 'create'])->middleware('permission:create_income')->name('incomes.create');
            Route::post('incomes', [IncomeController::class, 'store'])->middleware('permission:create_income')->name('incomes.store');
            Route::get('incomes/{income}', [IncomeController::class, 'show'])->middleware('permission:view_incomes')->name('incomes.show');
            Route::get('incomes/{income}/edit', [IncomeController::class, 'edit'])->middleware('permission:edit_income')->name('incomes.edit');
            Route::put('incomes/{income}', [IncomeController::class, 'update'])->middleware('permission:edit_income')->name('incomes.update');
            Route::delete('incomes/{income}', [IncomeController::class, 'destroy'])->middleware('permission:delete_income')->name('incomes.destroy');
            Route::post('incomes/{income}/submit', [IncomeController::class, 'submit'])->middleware('permission:submit_income')->name('incomes.submit');
            Route::post('incomes/{income}/approve', [IncomeController::class, 'approve'])->middleware('permission:approve_income')->name('incomes.approve');
            Route::post('incomes/{income}/reject', [IncomeController::class, 'reject'])->middleware('permission:reject_income')->name('incomes.reject');

            // --------------------------------------------
            // Financial Module: Budgets & Invoices
            // --------------------------------------------
            Route::resource('budgets', BudgetController::class)->middleware('permission:view_budgets');
            Route::resource('invoices', InvoiceController::class)->middleware('permission:view_invoices');

            Route::get('invoices/{invoice}/print', [InvoiceController::class, 'print'])->middleware('permission:view_invoices')->name('invoices.print');
            Route::post('invoices/{invoice}/submit', [InvoiceController::class, 'submit'])->middleware('permission:submit_invoice')->name('invoices.submit');
            Route::post('invoices/{invoice}/approve', [InvoiceController::class, 'approve'])->middleware('permission:approve_invoice')->name('invoices.approve');
            Route::post('invoices/{invoice}/reject', [InvoiceController::class, 'reject'])->middleware('permission:reject_invoice')->name('invoices.reject');
            Route::post('invoices/{invoice}/cancel', [InvoiceController::class, 'cancel'])->middleware('permission:cancel_invoice')->name('invoices.cancel');

            // --------------------------------------------
            // Financial Module: Payments & Receipts
            // --------------------------------------------
            Route::get('payments', [PaymentController::class, 'index'])->middleware('permission:view_payments')->name('payments.index');
            Route::get('payments/create', [PaymentController::class, 'create'])->middleware('permission:create_payment')->name('payments.create');
            Route::post('payments', [PaymentController::class, 'store'])->middleware('permission:create_payment')->name('payments.store');
            Route::get('payments/{payment}', [PaymentController::class, 'show'])->middleware('permission:view_payments')->name('payments.show');
            Route::get('payments/{payment}/edit', [PaymentController::class, 'edit'])->middleware('permission:edit_payment')->name('payments.edit');
            Route::put('payments/{payment}', [PaymentController::class, 'update'])->middleware('permission:edit_payment')->name('payments.update');
            Route::delete('payments/{payment}', [PaymentController::class, 'destroy'])->middleware('permission:delete_payment')->name('payments.destroy');

            Route::get('receipts', [ReceiptController::class, 'index'])->middleware('permission:view_receipts')->name('receipts.index');
            Route::get('receipts/{receipt}/print', [ReceiptController::class, 'print'])->middleware('permission:view_receipts')->name('receipts.print');
            Route::get('receipts/{receipt}', [ReceiptController::class, 'show'])->middleware('permission:view_receipts')->name('receipts.show');
            Route::post('payments/{payment}/receipt', [ReceiptController::class, 'store'])->middleware('permission:create_receipt')->name('receipts.store');
            Route::post('receipts/{receipt}/cancel', [ReceiptController::class, 'cancel'])->middleware('permission:cancel_receipt')->name('receipts.cancel');

            // --------------------------------------------
            // Financial Reports
            // --------------------------------------------
            Route::get('financial-reports', [FinancialReportController::class, 'index'])->middleware('permission:view_reports')->name('financial-reports.index');
            Route::get('financial-reports/summary', [FinancialReportController::class, 'summary'])->middleware('permission:view_reports')->name('financial-reports.summary');
            Route::get('financial-reports/income', [FinancialReportController::class, 'income'])->middleware('permission:view_reports')->name('financial-reports.income');
            Route::get('financial-reports/expenses', [FinancialReportController::class, 'expenses'])->middleware('permission:view_reports')->name('financial-reports.expenses');
            Route::get('financial-reports/budgets', [FinancialReportController::class, 'budgets'])->middleware('permission:view_reports')->name('financial-reports.budgets');
            Route::get('financial-reports/invoices', [FinancialReportController::class, 'invoices'])->middleware('permission:view_reports')->name('financial-reports.invoices');
            Route::get('financial-reports/payments', [FinancialReportController::class, 'payments'])->middleware('permission:view_reports')->name('financial-reports.payments');
            Route::get('financial-reports/receipts', [FinancialReportController::class, 'receipts'])->middleware('permission:view_reports')->name('financial-reports.receipts');
            Route::get('financial-reports/export', [FinancialReportController::class, 'export'])->middleware('permission:reports.export')->name('financial-reports.export');

            // --------------------------------------------
            // Contracts
            // --------------------------------------------
            Route::get('contracts', [ContractController::class, 'index'])->middleware('permission:view_contracts')->name('contracts.index');
            Route::get('contracts/create', [ContractController::class, 'create'])->middleware('permission:create_contract')->name('contracts.create');
            Route::post('contracts', [ContractController::class, 'store'])->middleware('permission:create_contract')->name('contracts.store');
            Route::get('contracts/{contract}/print', [ContractController::class, 'print'])->middleware('permission:view_contracts')->name('contracts.print');
            Route::get('contracts/{contract}', [ContractController::class, 'show'])->middleware('permission:view_contracts')->name('contracts.show');
            Route::get('contracts/{contract}/edit', [ContractController::class, 'edit'])->middleware('permission:edit_contract')->name('contracts.edit');
            Route::put('contracts/{contract}', [ContractController::class, 'update'])->middleware('permission:edit_contract')->name('contracts.update');
            Route::delete('contracts/{contract}', [ContractController::class, 'destroy'])->middleware('permission:delete_contract')->name('contracts.destroy');
            Route::post('contracts/{contract}/submit', [ContractController::class, 'submit'])->middleware('permission:submit_contract')->name('contracts.submit');
            Route::post('contracts/{contract}/approve', [ContractController::class, 'approve'])->middleware('permission:approve_contract')->name('contracts.approve');
            Route::post('contracts/{contract}/reject', [ContractController::class, 'reject'])->middleware('permission:reject_contract')->name('contracts.reject');
            Route::post('contracts/{contract}/activate', [ContractController::class, 'activate'])->middleware('permission:activate_contract')->name('contracts.activate');
            Route::post('contracts/{contract}/complete', [ContractController::class, 'complete'])->middleware('permission:complete_contract')->name('contracts.complete');
            Route::post('contracts/{contract}/terminate', [ContractController::class, 'terminate'])->middleware('permission:terminate_contract')->name('contracts.terminate');
            Route::post('contracts/{contract}/cancel', [ContractController::class, 'cancel'])->middleware('permission:cancel_contract')->name('contracts.cancel');

            // --------------------------------------------
            // Audit Logs
            // --------------------------------------------
            Route::middleware('permission:view_audit_logs')->group(function () {
                Route::get('audit-logs', [AuditLogController::class, 'index'])->name('audit-logs.index');
                Route::get('audit-logs/export', [AuditLogController::class, 'export'])->name('audit-logs.export');
                Route::get('audit-logs/{auditLog}', [AuditLogController::class, 'show'])->name('audit-logs.show');
            });

            // --------------------------------------------
            // Attachments
            // --------------------------------------------
            Route::post('attachments', [AttachmentController::class, 'store'])
                ->middleware('permission:upload_document')
                ->name('attachments.store');

            Route::get('attachments/{attachment}/download', [AttachmentController::class, 'download'])
                ->middleware('permission:download_document')
                ->name('attachments.download');

            Route::delete('attachments/{attachment}', [AttachmentController::class, 'destroy'])
                ->middleware('permission:delete_document')
                ->name('attachments.destroy');
        });
});

// ==========================================================
// Profile
// ==========================================================

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/notifications/{id}/read', [\App\Http\Controllers\NotificationController::class, 'markAsRead'])->name('notifications.read');
    Route::post('/notifications/read-all', [\App\Http\Controllers\NotificationController::class, 'markAllAsRead'])->name('notifications.read-all');
});

// ==========================================================
// Language
// ==========================================================

Route::get('/lang/{locale}', function (string $locale) {
    if (in_array($locale, ['ar', 'en'], true)) {
        session(['locale' => $locale]);
    }
    return back();
})->name('lang.switch');

require __DIR__ . '/auth.php';
