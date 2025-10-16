<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MahasiswaBermasalah extends Model
{
    use HasFactory;

    protected $table = 'mahasiswa_bermasalah';
    
    protected $fillable = [
        'nim',
        'nama',
        'semester',
        'nama_orang_tua',
        'pelanggaran_id',
        'sanksi_id',
        'deskripsi'
    ];

    public function pelanggaran()
    {
        return $this->belongsTo(Pelanggaran::class);
    }

    public function sanksi()
    {
        return $this->belongsTo(Sanksi::class);
    }

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'nim', 'nim');
    }
}