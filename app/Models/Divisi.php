<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Divisi extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'divisis';

    protected $primaryKey = 'id_divisi';

    protected $fillable = [
        'ketua_divisi',
        'nama_divisi',
        'deskripsi',
        'status',
    ];

    // 🔹 Tambahkan relasi ke AnggotaHima
    public function anggotaHima()
{
    return $this->hasMany(\App\Models\AnggotaHima::class, 'id_divisi', 'id_divisi');
}

}
