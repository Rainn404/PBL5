<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Komentar extends Model
{
    use HasFactory;

    protected $table = 'komentar';
    protected $primaryKey = 'id';          // default sudah 'id', tulis eksplisit biar jelas
    public $timestamps = true;             // gunakan created_at & updated_at

    // Field yang boleh diisi mass-assignment
    protected $fillable = ['berita_id', 'nama', 'isi'];

    // Cast waktu agar mudah di-format di Blade: $komentar->created_at->format('d M Y H:i')
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /** Relasi: komentar milik satu berita */
    public function berita()
    {
        // kolom FK di tabel komentar = 'berita_id', PK di tabel berita = 'Id_berita'
        return $this->belongsTo(\App\Models\Berita::class, 'berita_id', 'Id_berita');
    }

    /** Scope opsional: ambil komentar terbaru dulu */
    public function scopeLatestFirst($query)
    {
        return $query->orderByDesc('created_at');
    }
}
