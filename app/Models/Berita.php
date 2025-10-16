<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;

    protected $table = 'berita';
    protected $primaryKey = 'id_berita';
    
    protected $fillable = [
        'judul',
        'isi',
        'tanggal',
        'penulis',
        'foto'
    ];

    protected $casts = [
        'tanggal' => 'date'
    ];

    // Jika primary key bukan 'id', tambahkan ini:
    public $incrementing = true;
    protected $keyType = 'int';
}