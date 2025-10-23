<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePendaftaranSettingsTable extends Migration
{
    public function up()
    {
        Schema::create('pendaftaran_settings', function (Blueprint $table) {
            $table->id();
            $table->boolean('pendaftaran_aktif')->default(false);
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->integer('kuota')->default(50);
            $table->boolean('auto_close')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pendaftaran_settings');
    }
}