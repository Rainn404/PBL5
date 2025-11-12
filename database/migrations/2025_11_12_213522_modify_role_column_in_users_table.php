<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan perubahan tabel.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Ubah kolom role jadi string (varchar)
            $table->string('role', 50)->default('user')->change();
        });
    }

    /**
     * Rollback perubahan.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Kembalikan ke tipe sebelumnya (misal boolean)
            $table->boolean('role')->default(0)->change();
        });
    }
};
