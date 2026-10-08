<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $roles = [
            'Super Admin',
            'Administrator',
            'Finance Manager',
            'Finance Officer',
            'Project Manager',
            'HR Officer',
            'Document Officer',
            'Auditor / Reviewer',
            'Viewer',
        ];

        foreach ($roles as $role) {
            Role::findOrCreate($role, 'web');
        }

        /*
        |--------------------------------------------------------------------------
        | Super Admin
        |--------------------------------------------------------------------------
        */

        $superAdmin = Role::findByName('Super Admin', 'web');

        $superAdmin->syncPermissions(
            Permission::where('guard_name', 'web')->get()
        );

        /*
        |--------------------------------------------------------------------------
        | Administrator
        |
        | Now that User/Role/Department/Position routes are split into
        | per-module permissions instead of one shared manage_users
        | gate, Administrator needs each module's manage_* permission
        | explicitly — manage_users alone is no longer sufficient.
        |--------------------------------------------------------------------------
        */

        Role::findByName('Administrator', 'web')->syncPermissions([
            'view_dashboard',

            'view_users',
            'create_user',
            'edit_user',
            'delete_user',
            'manage_users',

            'view_roles',
            'manage_roles',

            'view_departments',
            'manage_departments',

            'view_positions',
            'manage_positions',

            'view_settings',
            'manage_settings',

            'view_audit_logs',

            'view_projects',

            'view_reports',
            'export_reports',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Finance Manager — full authority over the financial module,
        | including approval/rejection workflow actions.
        |--------------------------------------------------------------------------
        */

        Role::findByName('Finance Manager', 'web')->syncPermissions([
            'view_dashboard',

            'view_projects',

            'view_documents',
            'upload_document',
            'download_document',

            // Expenses
            'create_expense',
            'edit_expense',
            'submit_expense',
            'review_expense',
            'approve_expense',
            'reject_expense',

            // Income — including full workflow authority
            'view_incomes',
            'create_income',
            'edit_income',
            'delete_income',
            'submit_income',
            'approve_income',
            'reject_income',

            // Budgets
            'view_budgets',
            'create_budget',
            'edit_budget',
            'delete_budget',

            // Invoices — including full workflow authority
            'view_invoices',
            'create_invoice',
            'edit_invoice',
            'delete_invoice',
            'submit_invoice',
            'approve_invoice',
            'reject_invoice',
            'cancel_invoice',

            // Payments & Receipts — full authority
            'view_payments',
            'create_payment',
            'edit_payment',
            'delete_payment',

            'view_receipts',
            'create_receipt',
            'cancel_receipt',

            'view_reports',
            'export_reports',
            'reports.export',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Finance Officer — day-to-day data entry, no approval authority.
        |--------------------------------------------------------------------------
        */

        Role::findByName('Finance Officer', 'web')->syncPermissions([
            'view_dashboard',

            'view_projects',

            'view_documents',
            'upload_document',
            'download_document',

            // Expenses
            'create_expense',
            'edit_expense',
            'submit_expense',

            // Income — can create/edit/submit, cannot approve/reject
            'view_incomes',
            'create_income',
            'edit_income',
            'submit_income',

            // Budgets — read only
            'view_budgets',

            // Invoices — can create/edit/submit, cannot approve/reject/cancel
            'view_invoices',
            'create_invoice',
            'edit_invoice',
            'submit_invoice',

            // Payments — can record and edit, cannot delete
            'view_payments',
            'create_payment',
            'edit_payment',

            // Receipts — can generate, cannot cancel
            'view_receipts',
            'create_receipt',

            'view_reports',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Project Manager — read-only visibility into project finances.
        |--------------------------------------------------------------------------
        */

        Role::findByName('Project Manager', 'web')->syncPermissions([
            'view_dashboard',

            'view_projects',
            'create_project',
            'edit_project',

            'view_documents',
            'upload_document',
            'download_document',

            'view_invoices',
            'view_budgets',

            'view_reports',
            'export_reports',
        ]);

        /*
        |--------------------------------------------------------------------------
        | HR Officer
        |--------------------------------------------------------------------------
        */

        Role::findByName('HR Officer', 'web')->syncPermissions([
            'view_dashboard',

            'view_documents',
            'upload_document',
            'download_document',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Document Officer
        |--------------------------------------------------------------------------
        */

        Role::findByName('Document Officer', 'web')->syncPermissions([
            'view_dashboard',

            'view_documents',
            'upload_document',
            'edit_document',
            'delete_document',
            'download_document',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Auditor / Reviewer — full read-only visibility across the
        | financial module, for oversight purposes.
        |--------------------------------------------------------------------------
        */

        Role::findByName('Auditor / Reviewer', 'web')->syncPermissions([
            'view_dashboard',

            'view_projects',

            'view_documents',
            'download_document',

            'review_expense',

            'view_incomes',
            'view_budgets',
            'view_invoices',
            'view_payments',
            'view_receipts',

            'view_reports',
            'export_reports',

            'view_audit_logs',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Viewer — read-only, same financial visibility as Auditor.
        |--------------------------------------------------------------------------
        */

        Role::findByName('Viewer', 'web')->syncPermissions([
            'view_dashboard',

            'view_projects',

            'view_documents',
            'download_document',

            'view_incomes',
            'view_budgets',
            'view_invoices',
            'view_payments',
            'view_receipts',

            'view_reports',
        ]);

        app()[PermissionRegistrar::class]->forgetCachedPermissions();
    }
}
