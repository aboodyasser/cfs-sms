<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            PermissionSeeder::class,       // 1. إنشاء الصلاحيات الأساسية أولاً
            RolePermissionSeeder::class,   // 2. إنشاء الأدوار وربط الصلاحيات بها
            AdminUserSeeder::class,        // 3. إنشاء المستخدمين والمشرفين
            OrganizationSeeder::class,     // 4. الأقسام وهيكل المنظمة
            // ExpensePermissionSeeder::class, // (أضفه هنا إذا وجد صلاحيات إضافية للمصروفات)
        ]);
    }
}
