<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Divisi extends Model
{
    use HasFactory;

<<<<<<< HEAD
    protected $table = 'divisis';
    protected $primaryKey = 'id_divisi';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false; 
=======
    protected $table = 'divisi';
    protected $primaryKey = 'id_divisi'; // ✅ sesuai DB
    public $timestamps = false;          // ✅ karena tabel tidak ada kolom created_at & updated_at
>>>>>>> a71095d5ee2fe0a68106f6d8451d0822c6670154

    protected $fillable = [
        'nama_divisi',
        'ketua_divisi',
        'deskripsi',
        'status'
    ];
<<<<<<< HEAD

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
=======
}
>>>>>>> a71095d5ee2fe0a68106f6d8451d0822c6670154
