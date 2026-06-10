<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create Admin User
        User::create([
            'name' => 'Admin MeeTopia',
            'email' => 'admin@meetopia.com',
            'password' => bcrypt('admin123'),
            'role' => 'admin',
            'phone' => '081234567890',
        ]);

        // Create Demo User
        User::create([
            'name' => 'John Doe',
            'email' => 'user@meetopia.com',
            'password' => bcrypt('user123'),
            'role' => 'user',
            'phone' => '089876543210',
        ]);
    }
}
