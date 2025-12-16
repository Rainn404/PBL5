<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    // FIX UTAMA: samakan dengan nama tabel di database
    protected $table = 'mahasiswas';

    protected $fillable = [
        'nama',
        'nim',
        'angkatan',
        'status',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
