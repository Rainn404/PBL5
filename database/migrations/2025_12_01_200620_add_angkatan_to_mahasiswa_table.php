<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAngkatanToMahasiswaTable extends Migration
{
    public function up()
    {
        // FIX: ganti mahasiswa -> mahasiswas
        Schema::table('mahasiswas', function (Blueprint $table) {
            if (!Schema::hasColumn('mahasiswas', 'angkatan')) {
                $table->integer('angkatan')->nullable()->after('status');
            }
        });
    }

    public function down()
    {
        Schema::table('mahasiswas', function (Blueprint $table) {
            if (Schema::hasColumn('mahasiswas', 'angkatan')) {
                $table->dropColumn('angkatan');
            }
        });
    }
}
