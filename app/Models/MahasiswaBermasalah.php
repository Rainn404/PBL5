<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MahasiswaBermasalah extends Model
{
    use HasFactory;

    protected $table = 'mahasiswa_bermasalah';
    protected $primaryKey = 'id';
    
    protected $fillable = [
        'nama', 'nim', 'semester', 'nama_orang_tua', 
        'bukti', 'tanggal', 'id_masalah', 'id_sanksi'
    ];

    protected $dates = ['tanggal'];

    public function pelanggaran()
    {
        return $this->belongsTo(Pelanggaran::class, 'id_masalah');
    }

    public function sanksi()
    {
        return $this->belongsTo(Sanksi::class, 'id_sanksi');
    }
}