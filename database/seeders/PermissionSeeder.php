<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Reset permission cache
        |--------------------------------------------------------------------------
        */

        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        /*
        |--------------------------------------------------------------------------
        | Roles
        |--------------------------------------------------------------------------
        */

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
        | Permissions
        |--------------------------------------------------------------------------
        |
        | IMPORTANT:
        | Create every permission before assigning permissions to roles.
        |
        */

        $permissions = [

            // Dashboard
            'view_dashboard',

            // Users
            'view_users',
            'create_user',
            'edit_user',
            'delete_user',
            'manage_users',

            // Roles
            'view_roles',
            'manage_roles',

            // Departments
            'view_departments',
            'manage_departments',

            // Positions
            'view_positions',
            'manage_positions',

            // Settings
            'view_settings',
            'manage_settings',

            // Audit
            'view_audit_logs',

            // Projects
            'view_projects',
            'create_project',
            'edit_project',
            'delete_project',

            // Documents
            'view_documents',
            'upload_document',
            'edit_document',
            'delete_document',
            'download_document',

            // Expenses
            'create_expense',
            'edit_expense',
            'submit_expense',
            'review_expense',
            'approve_expense',
            'reject_expense',

            // Income
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

            // Invoices
            'view_invoices',
            'create_invoice',
            'edit_invoice',
            'delete_invoice',
            'submit_invoice',
            'approve_invoice',
            'reject_invoice',
            'cancel_invoice',

            // Payments
            'view_payments',
            'create_payment',
            'edit_payment',
            'delete_payment',

            // Receipts
            'view_receipts',
            'create_receipt',
            'cancel_receipt',

            // Contracts
            'view_contracts',
            'create_contract',
            'edit_contract',
            'delete_contract',
            'submit_contract',
            'approve_contract',
            'reject_contract',
            'activate_contract',
            'complete_contract',
            'terminate_contract',
            'cancel_contract',

            // Reports
            'view_reports',
            'export_reports',
            'reports.export',
        ];

        foreach ($permissions as $permission) {
            Permission::findOrCreate($permission, 'web');
        }

        /*
        |--------------------------------------------------------------------------
        | Super Admin
        |--------------------------------------------------------------------------
        |
        | Super Admin receives every web permission.
        |
        */

        $superAdmin = Role::findByName('Super Admin', 'web');

        $superAdmin->syncPermissions(
            Permission::where('guard_name', 'web')->get()
        );

        /*
        |--------------------------------------------------------------------------
        | Administrator
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

            'view_contracts',

            'view_reports',
            'export_reports',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Finance Manager
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

            // Income
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

            // Invoices
            'view_invoices',
            'create_invoice',
            'edit_invoice',
            'delete_invoice',
            'submit_invoice',
            'approve_invoice',
            'reject_invoice',
            'cancel_invoice',

            // Payments
            'view_payments',
            'create_payment',
            'edit_payment',
            'delete_payment',

            // Receipts
            'view_receipts',
            'create_receipt',
            'cancel_receipt',

            // Contracts
            'view_contracts',
            'approve_contract',
            'reject_contract',

            // Reports
            'view_reports',
            'export_reports',
            'reports.export',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Finance Officer
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

            // Income
            'view_incomes',
            'create_income',
            'edit_income',
            'submit_income',

            // Budgets
            'view_budgets',

            // Invoices
            'view_invoices',
            'create_invoice',
            'edit_invoice',
            'submit_invoice',

            // Payments
            'view_payments',
            'create_payment',
            'edit_payment',

            // Receipts
            'view_receipts',
            'create_receipt',

            // Contracts
            'view_contracts',

            // Reports
            'view_reports',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Project Manager
        |--------------------------------------------------------------------------
        */

        Role::findByName('Project Manager', 'web')->syncPermissions([
            'view_dashboard',

            'view_projects',
            'create_project',
            'edit_project',
            'delete_project',

            'view_documents',
            'upload_document',
            'download_document',

            'view_invoices',
            'view_budgets',

            // Contracts
            'view_contracts',
            'create_contract',
            'edit_contract',
            'delete_contract',
            'submit_contract',
            'activate_contract',
            'complete_contract',
            'terminate_contract',
            'cancel_contract',

            // Reports
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
        | Auditor / Reviewer
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

            'view_contracts',

            'view_reports',
            'export_reports',

            'view_audit_logs',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Viewer
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

            'view_contracts',

            'view_reports',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Final cache reset
        |--------------------------------------------------------------------------
        */

        app()[PermissionRegistrar::class]->forgetCachedPermissions();
    }
}
