<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('berita', function (Blueprint $table) {
            // Sesuaikan posisi kolom kalau mau (after('Nama_penulis') opsional)
            $table->date('Tanggal_berita')->nullable()->after('Nama_penulis');
        });
    }

    public function down(): void
    {
        Schema::table('berita', function (Blueprint $table) {
            $table->dropColumn('Tanggal_berita');
        });
    }
};
