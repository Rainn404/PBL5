<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Buat tabel pelanggaran
        Schema::create('pelanggaran', function (Blueprint $table) {
            $table->id('id_masalah');
            $table->string('nama', 150);
            $table->text('deskripsi')->nullable();
            $table->timestamps(); // Menambahkan kolom created_at & updated_at
        });

        // Buat tabel sanksi dengan relasi ke pelanggaran
        Schema::create('sanksi', function (Blueprint $table) {
            $table->id('id_sanksi');
            $table->unsignedBigInteger('id_masalah'); // Foreign key manual
            $table->string('nama_sanksi', 150);
            $table->text('deskripsi')->nullable();
            $table->timestamps();

            // Definisi foreign key
            $table->foreign('id_masalah')
                  ->references('id_masalah')
                  ->on('pelanggaran')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('sanksi');
        Schema::dropIfExists('pelanggaran');
    }
};
