<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin Gym',
            'email' => 'admin@gym.com',
            'password' => Hash::make('admin123'),
            'no_hp' => '08123456789',
            'status' => 1,
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Member Gym',
            'email' => 'member@gym.com',
            'password' => Hash::make('member123'),
            'no_hp' => '08987654321',
            'paket' => 'reguler',
            'sisa' => 10,
            'masa_aktif' => now()->addMonth(),
            'status' => 1,
            'role' => 'member',
        ]);
    }
}
