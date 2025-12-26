<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Admin
        User::create([
            'name' => 'Admin System',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // User
        User::create([
            'name' => 'User Staff',
            'email' => 'user@example.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);
    }
}
