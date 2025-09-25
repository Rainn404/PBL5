<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    use HasFactory;

    protected $table = 'pendaftaran';
    protected $primaryKey = 'id_pendaftaran';
    
    protected $fillable = [
        'id_user',
        'nim',
        'nama',
        'semester',
        'alasan_mendaftar',
        'dokumen',
        'no_hp',
        'status_pendaftaran',
        'divalidasi_oleh'
    ];

    // Relasi dengan user yang mendaftar
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    // Relasi dengan user yang memvalidasi
    public function validator()
    {
        return $this->belongsTo(User::class, 'divalidasi_oleh');
    }
}