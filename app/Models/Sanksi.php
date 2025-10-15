<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sanksi extends Model
{
    use HasFactory;

    protected $table = 'sanksi';
    protected $primaryKey = 'id_sanksi';
    
    protected $fillable = ['id_masalah', 'nama_sanksi', 'deskripsi'];

    public function pelanggaran()
    {
        return $this->belongsTo(Pelanggaran::class, 'id_masalah');
    }

    public function mahasiswaBermasalah()
    {
        return $this->hasMany(MahasiswaBermasalah::class, 'id_sanksi');
    }
}