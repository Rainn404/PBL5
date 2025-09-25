<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Insert user admin
        DB::table('users')->insert([
            'nama' => 'Admin HIMA',
            'email' => 'admin@hima.com',
            'password' => Hash::make('password123'),
            'no_hp' => '081234567890',
            'role' => 'admin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Insert user biasa
        $userId = DB::table('users')->insertGetId([
            'nama' => 'User Pendaftar',
            'email' => 'user@example.com',
            'password' => Hash::make('password123'),
            'no_hp' => '081298765432',
            'role' => 'freeuser',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Insert divisi
        DB::table('divisi')->insert([
            ['nama' => 'Divisi IT', 'deskripsi' => 'Divisi Teknologi Informasi', 'created_at' => now()],
            ['nama' => 'Divisi Humas', 'deskripsi' => 'Divisi Hubungan Masyarakat', 'created_at' => now()],
            ['nama' => 'Divisi Acara', 'deskripsi' => 'Divisi Penyelenggara Acara', 'created_at' => now()],
        ]);

        // Insert jabatan
        DB::table('jabatan')->insert([
            ['nama_jabatan' => 'Ketua', 'deskripsi' => 'Pimpinan', 'created_at' => now()],
            ['nama_jabatan' => 'Anggota', 'deskripsi' => 'Anggota Biasa', 'created_at' => now()],
            ['nama_jabatan' => 'Sekretaris', 'deskripsi' => 'Penanggung Jawab Administrasi', 'created_at' => now()],
        ]);

        // Insert data pendaftaran contoh
        DB::table('pendaftaran')->insert([
            [
                'id_user' => $userId,
                'nim' => '20210001',
                'nama' => 'Budi Santoso',
                'semester' => 3,
                'alasan_mendaftar' => 'Ingin mengembangkan skill dan pengalaman di HIMA TI',
                'no_hp' => '08123456789',
                'status_pendaftaran' => 'pending',
                'submitted_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_user' => $userId,
                'nim' => '20210002',
                'nama' => 'Siti Rahayu',
                'semester' => 5,
                'alasan_mendaftar' => 'Mau aktif berorganisasi dan berkontribusi untuk kampus',
                'no_hp' => '08129876543',
                'status_pendaftaran' => 'diterima',
                'divalidasi_oleh' => 1,
                'submitted_at' => now()->subDays(2),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}