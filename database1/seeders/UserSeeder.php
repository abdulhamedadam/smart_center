<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user
        User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('12345678'),
            'email_verified_at' => now(),
        ]);

        // Create regular user
        User::create([
            'name' => 'User',
            'email' => 'user@admin.com',
            'password' => Hash::make('12345678'),
            'email_verified_at' => now(),
        ]);
    }
} 