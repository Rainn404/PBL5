<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('anggota_hima', function (Blueprint $table) {
            $table->id('id_anggota_hima');
            $table->foreignId('id_user')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('id_divisi')->nullable()
                ->constrained(
                    table: 'divisis',
                    column: 'id_divisi'
                )
                ->onDelete('set null');
            $table->foreignId('id_jabatan')
                ->nullable()
                ->constrained(table: 'jabatans', column: 'id_jabatan')
                ->onDelete('set null');
            $table->string('nim', 20)->unique();
            $table->string('nama', 100);
            $table->integer('semester')->default(1);
            $table->string('foto')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();

            // Indexes
            $table->index('nim');
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('anggota_hima');
    }
};
