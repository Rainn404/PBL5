<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('anggota_hima', function (Blueprint $table) {
            $table->id('id_anggota_hima');

        
            $table->foreignId('id_user')
                ->constrained('users', 'id')
                ->onDelete('cascade');

            // biarkan yang lain, ini sudah benar
            $table->foreignId('id_divisi')->nullable()
                ->constrained('divisi', 'id_divisi')
                ->onDelete('set null');

            $table->foreignId('id_jabatan')->nullable()
                ->constrained('jabatan', 'id_jabatan')
                ->onDelete('set null');

            $table->string('nim', 30)->unique();
            $table->string('nama', 150);
            $table->tinyInteger('semester')->nullable();
            $table->string('foto', 255)->nullable();
            $table->enum('status', ['pending', 'active', 'rejected'])->default('pending');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('anggota_hima');
    }
};
