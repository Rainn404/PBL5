<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('mahasiswa_bermasalah', function (Blueprint $table) {
            $table->dropUnique(['nim']); // Hapus constraint unique
        });
    }

    public function down()
    {
        Schema::table('mahasiswa_bermasalah', function (Blueprint $table) {
            $table->unique('nim'); // Kembalikan jika rollback
        });
    }
};