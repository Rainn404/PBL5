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
        'ketua_divisi',
        'deskripsi',
        'status',
        'color',
    ];

    public $timestamps = true;

    /**
     * RELASI: Divisi punya banyak anggota
     */
    public function anggotaHima()
    {
        return $this->hasMany(AnggotaHima::class, 'id_divisi', 'id_divisi');
    }

    /**
     * Scope untuk mengambil jumlah anggota otomatis
     */
    public function scopeWithAnggota($query)
    {
        return $query->withCount('anggotaHima');
    }
}
