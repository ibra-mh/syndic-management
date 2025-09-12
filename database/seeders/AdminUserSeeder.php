<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        // Create or update admin user
        User::updateOrCreate(
            ['email' => 'admin@syndic.com'],
            [
                'name' => 'Super Admin',
                'email' => 'admin@syndic.com',
                'password' => Hash::make('admin123'),
                'role' => 'admin'
            ]
        );

        // Also ensure the original admin exists
        User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'password' => Hash::make('password123'),
                'role' => 'admin'
            ]
        );
    }
}
