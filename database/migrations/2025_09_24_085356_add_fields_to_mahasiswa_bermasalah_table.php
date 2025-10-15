<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('mahasiswa_bermasalah', function (Blueprint $table) {
            $table->string('nama');
            $table->string('nim')->unique();
            $table->integer('semester');
            $table->string('nama_orang_tua')->nullable();
            $table->unsignedBigInteger('id_masalah');
            $table->unsignedBigInteger('id_sanksi');
            $table->date('tanggal');
            $table->string('bukti')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('mahasiswa_bermasalah', function (Blueprint $table) {
            $table->dropColumn([
                'nama', 'nim', 'semester', 'nama_orang_tua',
                'id_masalah', 'id_sanksi', 'tanggal', 'bukti'
            ]);
        });
    }
};
