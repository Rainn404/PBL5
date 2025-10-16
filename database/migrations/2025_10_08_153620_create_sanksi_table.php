<?php
// database/migrations/2024_01_01_create_sanksi_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSanksiTable extends Migration
{
    public function up()
    {
        Schema::create('sanksi', function (Blueprint $table) {
            $table->id();
            $table->string('id_sanksi')->unique();
            $table->string('nama_sanksi');
            $table->enum('jenis_sanksi', ['ringan', 'sedang', 'berat']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sanksi');
    }
}