<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pendaftaran_settings', function (Blueprint $table) {
            $table->id();

            // Status sesi pendaftaran
            $table->boolean('pendaftaran_aktif')->default(false); // false = ditutup, true = dibuka

            // Tanggal sesi (opsional tapi berguna)
            $table->date('tanggal_mulai')->nullable();
            $table->date('tanggal_selesai')->nullable();

            // Tambahan fitur dari controller
            $table->integer('kuota')->default(50); // batas maksimal pendaftar
            $table->boolean('auto_close')->default(true); // otomatis tutup jika kuota penuh

            // Info tambahan
            $table->text('keterangan')->nullable();

            // Waktu buat & update
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pendaftaran_settings');
    }
};
