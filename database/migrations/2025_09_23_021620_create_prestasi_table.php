<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('prestasi', function (Blueprint $table) {
            $table->id('id_prestasi');

            // Relasi ke tabel users
            $table->foreignId('id_user')
                ->constrained('users')
                ->onDelete('cascade');

            // Informasi dasar prestasi
            $table->string('nama_prestasi');
            $table->string('kategori');
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->string('email');
            $table->string('no_hp', 15);
            $table->decimal('ipk', 3, 2)->nullable();
            $table->string('bukti_prestasi')->nullable();
            $table->text('deskripsi');
            $table->string('nim', 20);
            $table->integer('semester');

            // Kolom untuk validasi
            $table->enum('status_validasi', ['pending', 'disetujui', 'ditolak'])
                ->default('pending');
            $table->text('alasan_penolakan')->nullable();
            $table->timestamp('tanggal_validasi')->nullable();

            // Menyimpan siapa yang memvalidasi (opsional)
            $table->foreignId('validator_id')
                ->nullable()
                ->constrained('users')
                ->onDelete('set null');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prestasi');
    }
};
