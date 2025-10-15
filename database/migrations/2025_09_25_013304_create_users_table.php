<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id('id_user');
            $table->string('nama', 150);
            $table->string('email', 150)->unique();
            $table->string('password', 255);
            $table->string('no_hp', 20)->nullable();
            $table->enum('role', ['freeuser', 'anggota', 'admin'])->default('freeuser');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
};