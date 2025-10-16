<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('berita', function (Blueprint $table) {
            $table->id('id_berita');
            $table->string('judul', 200);
            $table->text('isi');
            $table->string('foto')->nullable();
            $table->date('tanggal');
            $table->string('penulis', 100)->default('Admin');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('berita');
    }
};