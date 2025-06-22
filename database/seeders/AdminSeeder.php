<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // Create admin user if not exists
        User::firstOrCreate([
            'email' => 'admin@theindonesianpress.com'
        ], [
            'name' => 'Admin The Indonesian Press',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);

        // Create additional test admin
        User::firstOrCreate([
            'email' => 'admin@admin.com'
        ], [
            'name' => 'Admin Test',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);
    }
}