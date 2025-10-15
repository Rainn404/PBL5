<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggaran extends Model
{
    use HasFactory;

    protected $table = 'pelanggaran';
    protected $primaryKey = 'id_masalah';
    
    protected $fillable = ['nama', 'deskripsi'];

    public function sanksi()
    {
        return $this->hasOne(Sanksi::class, 'id_masalah');
    }

    public function mahasiswaBermasalah()
    {
        return $this->hasMany(MahasiswaBermasalah::class, 'id_masalah');
    }
}