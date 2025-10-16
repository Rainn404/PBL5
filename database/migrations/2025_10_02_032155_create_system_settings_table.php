<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('system_settings', function (Blueprint $table) {
            $table->id();
            $table->boolean('pendaftaran_aktif')->default(false);
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->integer('kuota')->default(30);
            $table->boolean('auto_close')->default(true);
            $table->timestamps();
        });

        // Insert default data
        DB::table('system_settings')->insert([
            'pendaftaran_aktif' => false,
            'tanggal_mulai' => now()->format('Y-m-d'),
            'tanggal_selesai' => now()->addDays(30)->format('Y-m-d'),
            'kuota' => 30,
            'auto_close' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('system_settings');
    }
};