<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'username' => 'Kaldera',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        User::create([
            'username' => 'Henta',
            'email' => 'validator@example.com',
            'password' => Hash::make('password'),
            'role' => 'validator',
        ]);

        User::create([
            'username' => 'Andelky',
            'email' => 'kontributor@example.com',
            'password' => Hash::make('password'),
            'role' => 'kontributor',
        ]);
    }
}
