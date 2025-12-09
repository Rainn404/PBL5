<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        // Use raw ALTER TABLE statements to avoid requiring doctrine/dbal
        $table = DB::getTablePrefix() . 'mahasiswa_bermasalah';
        try {
            DB::statement("ALTER TABLE `mahasiswa_bermasalah` MODIFY `nama_orang_tua` VARCHAR(255) NULL;");
        } catch (\Throwable $e) {
            // ignore - may already be nullable or not present
        }

        try {
            DB::statement("ALTER TABLE `mahasiswa_bermasalah` MODIFY `deskripsi` TEXT NULL;");
        } catch (\Throwable $e) {
            // ignore
        }
    }

    public function down()
    {
        try {
            DB::statement("ALTER TABLE `mahasiswa_bermasalah` MODIFY `nama_orang_tua` VARCHAR(255) NOT NULL;");
        } catch (\Throwable $e) {
            // ignore
        }
        try {
            DB::statement("ALTER TABLE `mahasiswa_bermasalah` MODIFY `deskripsi` TEXT NOT NULL;");
        } catch (\Throwable $e) {
            // ignore
        }
    }
};
