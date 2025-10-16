<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Carbon;

class Berita extends Model
{
    use HasFactory;

    protected $table = 'berita';

    protected $primaryKey = 'Id_berita';
    public $incrementing = true;
    protected $keyType = 'int';

    // Tabel berita tidak memiliki created_at/updated_at
    public $timestamps = false;

    // Field yang bisa diisi
    protected $fillable = [
        'Judul_berita',
        'Isi_berita',
        'Nama_penulis',
        'foto',
        'Tanggal_berita',
    ];

    /* =======================
     * Accessors & Mutators (map field kode ↔ kolom DB)
     * ======================= */

    protected function judul(): Attribute
    {
        return Attribute::make(
            get: fn($v, $attr) => $attr['Judul_berita'] ?? null,
            set: fn($v) => ['Judul_berita' => $v]
        );
    }

    protected function isi(): Attribute
    {
        return Attribute::make(
            get: fn($v, $attr) => $attr['Isi_berita'] ?? null,
            set: fn($v) => ['Isi_berita' => $v]
        );
    }

    protected function namaPenulis(): Attribute
    {
        return Attribute::make(
            get: fn($v, $attr) => $attr['Nama_penulis'] ?? null,
            set: fn($v) => ['Nama_penulis' => $v]
        );
    }

    protected function foto(): Attribute
    {
        return Attribute::make(
            get: fn($v, $attr) => $attr['foto'] ?? null,
            set: fn($v) => ['foto' => $v]
        );
    }

    /**
     * Kolom di DB: Tanggal_berita
     * Bisa diakses/diisi via `tanggal_berita` atau `tanggal`
     */
    protected function tanggalBerita(): Attribute
    {
        return Attribute::make(
            get: fn($v, $attr) => isset($attr['Tanggal_berita'])
                ? Carbon::parse($attr['Tanggal_berita'])
                : null,
            set: function ($v) {
                if ($v instanceof \DateTimeInterface) {
                    $v = $v->format('Y-m-d');
                }
                return ['Tanggal_berita' => $v ?: null];
            }
        );
    }

    protected function tanggal(): Attribute
    {
        return Attribute::make(
            get: fn($v, $attr) => isset($attr['Tanggal_berita'])
                ? Carbon::parse($attr['Tanggal_berita'])
                : null,
            set: function ($v) {
                if ($v instanceof \DateTimeInterface) {
                    $v = $v->format('Y-m-d');
                }
                return ['Tanggal_berita' => $v ?: null];
            }
        );
    }

    // Helper URL foto
    protected function fotoUrl(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->foto ? asset('storage/' . $this->foto) : asset('images/no-image.png')
        );
    }

    /* =======================
     * Scopes
     * ======================= */

    public function scopeLatestById($q)
    {
        return $q->orderByDesc('Id_berita');
    }

    public function scopeLatestByDate($q)
    {
        // Urutkan berdasarkan tanggal jika ada, lalu fallback ke id
        return $q->orderByDesc('Tanggal_berita')->orderByDesc('Id_berita');
    }

    /* =======================
     * Relasi
     * ======================= */

    // Satu berita punya banyak komentar
    public function komentar()
    {
        return $this->hasMany(\App\Models\Komentar::class, 'berita_id', 'Id_berita')
                    ->latest('created_at');
    }
}

