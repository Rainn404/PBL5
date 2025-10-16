<?php
// app/Models/Pelanggaran.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggaran extends Model
{
    use HasFactory;

    protected $table = 'pelanggaran';

    protected $fillable = [
        'kode_pelanggaran',
        'nama_pelanggaran',
        'jenis_pelanggaran'
    ];

    protected $casts = [
        'jenis_pelanggaran' => 'string'
    ];
}