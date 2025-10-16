<?php

// app/Models/Mahasiswa.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;


    protected $fillable = [
        'nama',
        'nim', 
        'status'
    ];

    // HAPUS JIKA ADA: protected $attributes yang set default 'Aktif'

}