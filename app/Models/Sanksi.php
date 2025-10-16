<?php
// app/Models/Sanksi.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sanksi extends Model
{
    use HasFactory;

    protected $table = 'sanksi';
    
    protected $fillable = [
        'id_sanksi',
        'nama_sanksi',
        'jenis_sanksi'
    ];
}