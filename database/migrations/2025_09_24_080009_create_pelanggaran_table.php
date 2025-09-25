<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pelanggaran', function (Blueprint $table) {
            $table->id('id_masalah');
            $table->string('nama', 150);
            $table->text('deskripsi')->nullable();
            $table->timestamps();
        });

        // Insert data default
        Schema::create('sanksi', function (Blueprint $table) {
            $table->id('id_sanksi');
            $table->foreignId('id_masalah')->constrained('pelanggaran', 'id_masalah')->onDelete('cascade');
            $table->string('nama_sanksi', 150);
            $table->text('deskripsi')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sanksi');
        Schema::dropIfExists('pelanggaran');
    }
};