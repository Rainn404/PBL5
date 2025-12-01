<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@himati.com'],
            [
                'name' => 'Administrator',
                'password' => Hash::make('HanyaAdmin345'),
                'role' => 'admin',
            ]
        );
    }
}
