<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Create Super Admin
        User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@hima.com',
            'nim' => 'SUPER001',
            'phone' => '081234567890',
            'role' => 'super_admin',
            'password' => Hash::make('password123'),
        ]);

        // Create Admin
        User::create([
            'name' => 'Admin HIMA',
            'email' => 'admin@hima.com',
            'nim' => 'ADMIN001',
            'phone' => '081234567891',
            'role' => 'admin',
            'password' => Hash::make('password123'),
        ]);

        // Create Mahasiswa
        User::create([
            'name' => 'Ahmad Fauzi',
            'email' => 'ahmad@hima.com',
            'nim' => '12345678',
            'phone' => '081234567892',
            'role' => 'mahasiswa',
            'password' => Hash::make('password123'),
        ]);

        User::create([
            'name' => 'Siti Rahayu',
            'email' => 'siti@hima.com',
            'nim' => '22334455',
            'phone' => '081234567893',
            'role' => 'mahasiswa',
            'password' => Hash::make('password123'),
        ]);

        User::create([
            'name' => 'Budi Santoso',
            'email' => 'budi@hima.com',
            'nim' => '33445566',
            'phone' => '081234567894',
            'role' => 'mahasiswa',
            'password' => Hash::make('password123'),
        ]);

        User::create([
            'name' => 'Maya Sari',
            'email' => 'maya@hima.com',
            'nim' => '44556677',
            'phone' => '081234567895',
            'role' => 'mahasiswa',
            'password' => Hash::make('password123'),
        ]);

        User::create([
            'name' => 'Rizki Pratama',
            'email' => 'rizki@hima.com',
            'nim' => '55667788',
            'phone' => '081234567896',
            'role' => 'mahasiswa',
            'password' => Hash::make('password123'),
        ]);

        // Create sample prestasi data
        $this->call(PrestasiSeeder::class);
    }
}