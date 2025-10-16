<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('mahasiswa_bermasalah', function (Blueprint $table) {
            $table->id();
            $table->string('nim')->unique();
            $table->string('nama');
            $table->integer('semester');
            $table->string('nama_orang_tua');
            $table->foreignId('pelanggaran_id')->constrained('pelanggaran');
            $table->foreignId('sanksi_id')->constrained('sanksi');
            $table->text('deskripsi');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('mahasiswa_bermasalah');
    }
};