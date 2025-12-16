<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class DropUniqueFromMahasiswaBermasalahNim extends Migration
{
    public function up()
    {
        // FIX: drop index hanya jika memang ADA
        if (Schema::hasTable('mahasiswa_bermasalah')) {
            $indexes = DB::select("SHOW INDEX FROM mahasiswa_bermasalah");

            $indexNames = array_map(function ($idx) {
                return $idx->Key_name;
            }, $indexes);

            if (in_array('mahasiswa_bermasalah_nim_unique', $indexNames)) {
                DB::statement("
                    ALTER TABLE mahasiswa_bermasalah 
                    DROP INDEX mahasiswa_bermasalah_nim_unique
                ");
            }
        }
    }

    public function down()
    {
        // Tidak perlu restore index (aman dikosongkan)
    }
}
