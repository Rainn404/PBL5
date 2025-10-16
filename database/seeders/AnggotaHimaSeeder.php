<?php

namespace Database\Seeders;

use App\Models\AnggotaHima;
use App\Models\Divisi;
use App\Models\Jabatan;
use Illuminate\Database\Seeder;

class AnggotaHimaSeeder extends Seeder
{
    public function run(): void
    {
        // Buat data divisi
        $divisi1 = Divisi::create([
            'nama_divisi' => 'Pengembangan Sumber Daya Anggota',
            'deskripsi' => 'Divisi yang menangani pengembangan anggota',
            'status' => true
        ]);

        $divisi2 = Divisi::create([
            'nama_divisi' => 'Kewirausahaan',
            'deskripsi' => 'Divisi yang menangani kegiatan kewirausahaan',
            'status' => true
        ]);

        // Buat data jabatan
        $jabatan1 = Jabatan::create([
            'nama_jabatan' => 'Ketua HIMA',
            'deskripsi' => 'Pimpinan tertinggi HIMA',
            'level' => 1,
            'status' => true
        ]);

        $jabatan2 = Jabatan::create([
            'nama_jabatan' => 'Anggota Biasa',
            'deskripsi' => 'Anggota biasa HIMA',
            'level' => 5,
            'status' => true
        ]);

        // Buat data anggota
        AnggotaHima::create([
            'id_divisi' => $divisi1->id_divisi,
            'id_jabatan' => $jabatan1->id_jabatan,
            'nim' => '20210001',
            'nama' => 'Ahmad Rizki',
            'semester' => 5,
            'status' => true
        ]);

        AnggotaHima::create([
            'id_divisi' => $divisi2->id_divisi,
            'id_jabatan' => $jabatan2->id_jabatan,
            'nim' => '20210002',
            'nama' => 'Siti Nurhaliza',
            'semester' => 5,
            'status' => true
        ]);
    }
}