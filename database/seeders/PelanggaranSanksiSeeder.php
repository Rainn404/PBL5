<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PelanggaranSanksiSeeder extends Seeder
{
    public function run()
    {
        // Data pelanggaran
        $pelanggaran = [
            ['nama' => 'Tidak Hadir Rapat', 'deskripsi' => 'Tidak hadir dalam rapat tanpa keterangan'],
            ['nama' => 'Melanggar Dress Code', 'deskripsi' => 'Tidak mematuhi peraturan dress code organisasi'],
            ['nama' => 'Tidak Menyelesaikan Tugas', 'deskripsi' => 'Tidak menyelesaikan tugas yang diberikan'],
            ['nama' => 'Merokok di Area Kampus', 'deskripsi' => 'Melakukan aktivitas merokok di area terlarang'],
            ['nama' => 'Pelanggaran Disiplin Lainnya', 'deskripsi' => 'Pelanggaran disiplin lainnya'],
        ];

        foreach ($pelanggaran as $p) {
            $id = DB::table('pelanggaran')->insertGetId($p);
            
            // Data sanksi untuk setiap pelanggaran
            $sanksi = $this->getSanksiByPelanggaran($p['nama']);
            DB::table('sanksi')->insert([
                'id_masalah' => $id,
                'nama_sanksi' => $sanksi,
                'deskripsi' => 'Sanksi untuk pelanggaran: ' . $p['nama']
            ]);
        }
    }

    private function getSanksiByPelanggaran($pelanggaran)
    {
        $sanksiMapping = [
            'Tidak Hadir Rapat' => 'Teguran Lisan',
            'Melanggar Dress Code' => 'Teguran Tertulis',
            'Tidak Menyelesaikan Tugas' => 'Peringatan dan tugas tambahan',
            'Merokok di Area Kampus' => 'Skorsing 1 minggu',
            'Pelanggaran Disiplin Lainnya' => 'Dievaluasi lebih lanjut'
        ];

        return $sanksiMapping[$pelanggaran] ?? 'Teguran';
    }
}