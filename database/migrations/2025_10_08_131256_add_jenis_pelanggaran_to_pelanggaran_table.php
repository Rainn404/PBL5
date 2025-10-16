<?php
// database/migrations/xxxx_xx_xx_xxxxxx_add_jenis_pelanggaran_to_pelanggaran_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('pelanggaran', function (Blueprint $table) {
            $table->enum('jenis_pelanggaran', ['ringan', 'sedang', 'berat'])->default('ringan')->after('nama_pelanggaran');
        });
    }

    public function down()
    {
        Schema::table('pelanggaran', function (Blueprint $table) {
            $table->dropColumn('jenis_pelanggaran');
        });
    }
};