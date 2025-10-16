<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Divisi extends Model
{
    use HasFactory;

    protected $table = 'divisis';
    protected $primaryKey = 'id_divisi';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false; 

    protected $fillable = [
        'nama_divisi',
        'ketua_divisi',
        'deskripsi',
        'status'
    ];

    protected $casts = [
        'status' => 'boolean'
    ];

    // Relasi ke AnggotaHima
    public function anggotaHima()
    {
        return $this->hasMany(AnggotaHima::class, 'id_divisi', 'id_divisi');
    }

    // Accessor untuk jumlah anggota (optional)
    public function getJumlahAnggotaAttribute()
    {
        return $this->anggotaHima()->count();
    }

    // Scope untuk withCount
    public function scopeWithAnggotaCount($query)
    {
        return $query->withCount('anggotaHima');
    }
}