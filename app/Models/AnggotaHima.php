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
        'id_user',
        'id_divisi',
        'id_jabatan',
        'nim',
        'nama',
        'semester',
        'foto',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function divisi()
    {
        return $this->belongsTo(Divisi::class, 'id_divisi');
    }

    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class, 'id_jabatan');
    }
}