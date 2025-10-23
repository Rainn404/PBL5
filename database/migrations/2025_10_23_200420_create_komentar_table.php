<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('komentar', function (Blueprint $table) {
            $table->id(); // kolom id otomatis jadi PK
            $table->unsignedBigInteger('berita_id'); // FK ke tabel berita
            $table->string('nama', 100);
            $table->text('isi');
            $table->timestamps(); // created_at & updated_at

            $table->foreign('berita_id')
                  ->references('id_berita')
                  ->on('berita')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('komentar');
    }
};
