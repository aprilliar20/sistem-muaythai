<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // buat admin
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gym.com',
            'password' => Hash::make('password123'),
            'role' => 'admin', 
            'no_hp'=> '0897181881',
            'status'=> 1
        ]);
       User::factory()->count(50)->create();
    }
}
