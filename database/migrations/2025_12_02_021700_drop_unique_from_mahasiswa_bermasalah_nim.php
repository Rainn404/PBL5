<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Drop the unique index on nim so the same NIM can be inserted multiple times
        Schema::table('mahasiswa_bermasalah', function (Blueprint $table) {
            // The default Laravel unique index name is 'mahasiswa_bermasalah_nim_unique'
            if (Schema::hasColumn('mahasiswa_bermasalah', 'nim')) {
                try {
                    $table->dropUnique('mahasiswa_bermasalah_nim_unique');
                } catch (\Throwable $e) {
                    // If the index does not exist, ignore the error to make migration idempotent
                }
            }
        });
    }

    public function down()
    {
        // Re-create unique index on nim if you need to rollback (may require doctrine/dbal)
        Schema::table('mahasiswa_bermasalah', function (Blueprint $table) {
            try {
                $table->unique('nim');
            } catch (\Throwable $e) {
                // ignore if cannot create unique index during rollback
            }
        });
    }
};
