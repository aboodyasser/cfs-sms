<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class ExpensePermissionSeeder extends Seeder
{
    public function run(): void
    {
        app()[PermissionRegistrar::class]
            ->forgetCachedPermissions();

        Permission::findOrCreate(
            'view_expenses',
            'web'
        );

        $viewPermission = Permission::findByName(
            'view_expenses',
            'web'
        );

        foreach (
            [
                'Super Admin',
                'Administrator',
                'Finance Manager',
                'Finance Officer',
                'Auditor / Reviewer',
                'Viewer',
            ] as $roleName
        ) {
            $role = Role::findByName(
                $roleName,
                'web'
            );

            $role->givePermissionTo($viewPermission);
        }

        app()[PermissionRegistrar::class]
            ->forgetCachedPermissions();
    }
}
