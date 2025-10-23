<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin user
        User::create([
            'name' => 'Admin SkyWings',
            'email' => 'admin@skywings.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
            'phone' => '+6281234567890',
        ]);

        // Regular users
        User::create([
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'password' => Hash::make('password123'),
            'role' => 'user',
            'phone' => '+6281876543210',
        ]);

        User::create([
            'name' => 'Jane Smith',
            'email' => 'jane.smith@example.com',
            'password' => Hash::make('password123'),
            'role' => 'user',
            'phone' => '+6281987654321',
        ]);

        // Generate additional users
        User::factory(10)->create();
    }
}