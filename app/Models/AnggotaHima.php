<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnggotaHima extends Model
{
    use HasFactory;

    protected $table = 'anggota_hima';
    protected $primaryKey = 'id_anggota_hima';
    
    protected $fillable = [
        'user_id', // TAMBAHKAN INI
        'nama', 
        'nim', 
        'id_divisi', 
        'id_jabatan', 
        'semester', 
        'status', 
        'foto'
    ];

    protected $casts = [
        'status' => 'boolean',
        'semester' => 'integer'
    ];

    // Relasi ke divisi
    public function divisi()
    {
        return $this->belongsTo(Divisi::class, 'id_divisi', 'id_divisi');
    }

    // Relasi ke jabatan
    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class, 'id_jabatan', 'id_jabatan');
    }

    // Relasi ke user (jika ada)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}