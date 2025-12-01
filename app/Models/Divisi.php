<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Divisi extends Model
{
    use HasFactory;

    protected $table = 'divisis';
    protected $primaryKey = 'id_divisi';
    
    protected $fillable = [
        'nama_divisi',
        'ketua_divisi', // ini adalah string/nama ketua
        'deskripsi'
    ];

    public $timestamps = true;

    // Relationship ke AnggotaHima
    public function anggotaHima()
    {
        return $this->hasMany(AnggotaHima::class, 'id_divisi', 'id_divisi');
    }

    // Accessor untuk jumlah anggota
    public function getJumlahAnggotaAttribute()
    {
        return $this->anggotaHima()->count();
    }

    // Accessor untuk menampilkan ketua divisi
    public function getNamaKetuaAttribute()
    {
        return $this->ketua_divisi ?: 'Belum ada ketua';
    }

    // Scope untuk divisi yang memiliki anggota
    public function scopeWithAnggota($query)
    {
        return $query->withCount('anggotaHima');
    }

    // Scope untuk divisi aktif (yang memiliki anggota)
    public function scopeAktif($query)
    {
        return $query->has('anggotaHima');
    }
}