<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Divisi extends Model
{
    use HasFactory;

    protected $table = 'divisi';
    protected $primaryKey = 'id_divisi'; // ✅ sesuai DB
    public $timestamps = false;          // ✅ karena tabel tidak ada kolom created_at & updated_at

    protected $fillable = [
        'nama',
        'deskripsi'
    ];
}
