<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            [
                'nama' => 'Administrator',
                'email' => 'admin@hima.com',
                'password' => Hash::make('password123'),
                'no_hp' => '081234567890',
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'User Biasa',
                'email' => 'user@example.com',
                'password' => Hash::make('password123'),
                'no_hp' => '081298765432',
                'role' => 'freeuser',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}