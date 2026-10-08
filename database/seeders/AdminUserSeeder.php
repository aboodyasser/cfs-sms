<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::updateOrCreate(
            [
                'email' => 'admin@cfs-sms.local',
            ],
            [
                'name' => 'System Administrator',
                'password' => Hash::make('ChangeMe123!'),
                'status' => 'active',
            ]
        );

        $admin->assignRole('Super Admin');
    }
}
