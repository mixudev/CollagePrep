<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin Account
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@tryout.com',
            'username' => 'admin',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'phone' => '081234567890',
            'status' => 'active',
            'email_verified_at' => now(),
        ]);

        // Demo Student Accounts
        User::create([
            'name' => 'Budi Santoso',
            'email' => 'budi@student.com',
            'username' => 'budi',
            'password' => Hash::make('password'),
            'role' => 'student',
            'phone' => '081234567891',
            'school' => 'SMA Negeri 1 Jakarta',
            'status' => 'active',
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'Ani Wijaya',
            'email' => 'ani@student.com',
            'username' => 'ani',
            'password' => Hash::make('password'),
            'role' => 'student',
            'phone' => '081234567892',
            'school' => 'SMA Negeri 2 Jakarta',
            'status' => 'active',
            'email_verified_at' => now(),
        ]);

        // Generate 20 random students
        User::factory(20)->create([
            'role' => 'student',
            'status' => 'active',
            'email_verified_at' => now(),
        ]);
    }
}