<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Prestasi;
use Carbon\Carbon;

class PrestasiSeeder extends Seeder
{
    public function run()
    {
        $prestasiData = [
            // Prestasi untuk Ahmad Fauzi (12345678)
            [
                'nama' => 'Juara 1 Lomba Programming Competition',
                'nim' => '12345678',
                'kategori' => 'Akademik',
                'deskripsi' => 'Meraih juara 1 dalam kompetisi programming nasional yang diselenggarakan oleh Universitas Indonesia',
                'tanggal_mulai' => '2024-03-01',
                'tanggal_selesai' => '2024-03-03',
                'semester' => 'Semester 5',
                'email' => 'ahmad@hima.com',
                'no_hp' => '081234567892',
                'ipk' => 3.75,
                'status' => 'Tervalidasi',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama' => 'Finalis Business Plan Competition',
                'nim' => '12345678',
                'kategori' => 'Non-Akademik',
                'deskripsi' => 'Menjadi finalis dalam kompetisi business plan tingkat regional',
                'tanggal_mulai' => '2024-02-15',
                'tanggal_selesai' => '2024-02-17',
                'semester' => 'Semester 5',
                'email' => 'ahmad@hima.com',
                'no_hp' => '081234567892',
                'ipk' => 3.75,
                'status' => 'Tervalidasi',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            // Prestasi untuk Siti Rahayu (22334455)
            [
                'nama' => 'Juara 2 Lomba Debat Bahasa Inggris',
                'nim' => '22334455',
                'kategori' => 'Akademik',
                'deskripsi' => 'Meraih juara 2 dalam lomba debat bahasa Inggris tingkat universitas',
                'tanggal_mulai' => '2024-03-10',
                'tanggal_selesai' => '2024-03-10',
                'semester' => 'Semester 3',
                'email' => 'siti@hima.com',
                'no_hp' => '081234567893',
                'ipk' => 3.82,
                'status' => 'Tervalidasi',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama' => 'Peserta Aktif Volunteer Pendidikan',
                'nim' => '22334455',
                'kategori' => 'Pengabdian Masyarakat',
                'deskripsi' => 'Aktif sebagai volunteer dalam program pendidikan untuk anak-anak kurang mampu',
                'tanggal_mulai' => '2024-01-15',
                'tanggal_selesai' => '2024-04-15',
                'semester' => 'Semester 3',
                'email' => 'siti@hima.com',
                'no_hp' => '081234567893',
                'ipk' => 3.82,
                'status' => 'Menunggu Validasi',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            // Prestasi untuk Budi Santoso (33445566)
            [
                'nama' => 'Juara 1 Turnamen Futsal Antar Fakultas',
                'nim' => '33445566',
                'kategori' => 'Olahraga',
                'deskripsi' => 'Memimpin tim futsal fakultas meraih juara 1 turnamen antar fakultas',
                'tanggal_mulai' => '2024-02-20',
                'tanggal_selesai' => '2024-02-25',
                'semester' => 'Semester 4',
                'email' => 'budi@hima.com',
                'no_hp' => '081234567894',
                'ipk' => 3.45,
                'status' => 'Tervalidasi',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            // Prestasi untuk Maya Sari (44556677)
            [
                'nama' => 'Juara 3 Lomba Poster Digital',
                'nim' => '44556677',
                'kategori' => 'Seni',
                'deskripsi' => 'Meraih juara 3 dalam lomba poster digital bertema lingkungan',
                'tanggal_mulai' => '2024-03-05',
                'tanggal_selesai' => '2024-03-05',
                'semester' => 'Semester 6',
                'email' => 'maya@hima.com',
                'no_hp' => '081234567895',
                'ipk' => 3.68,
                'status' => 'Tervalidasi',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama' => 'Presenter Conference Nasional',
                'nim' => '44556677',
                'kategori' => 'Penelitian',
                'deskripsi' => 'Menjadi presenter dalam konferensi nasional tentang teknologi informasi',
                'tanggal_mulai' => '2024-04-01',
                'tanggal_selesai' => '2024-04-02',
                'semester' => 'Semester 6',
                'email' => 'maya@hima.com',
                'no_hp' => '081234567895',
                'ipk' => 3.68,
                'status' => 'Menunggu Validasi',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            // Prestasi untuk Rizki Pratama (55667788)
            [
                'nama' => 'Juara 1 Hackathon Fintech',
                'nim' => '55667788',
                'kategori' => 'Akademik',
                'deskripsi' => 'Memenangkan hackathon fintech dengan mengembangkan aplikasi mobile banking',
                'tanggal_mulai' => '2024-03-20',
                'tanggal_selesai' => '2024-03-22',
                'semester' => 'Semester 7',
                'email' => 'rizki@hima.com',
                'no_hp' => '081234567896',
                'ipk' => 3.91,
                'status' => 'Tervalidasi',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        Prestasi::insert($prestasiData);
    }
}