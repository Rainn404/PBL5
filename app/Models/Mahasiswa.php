<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $table = 'mahasiswa';

    protected $fillable = [
        'nama',
        'nim',
        'angkatan',
        'status',
        'ipk',
        'juara',
        'tingkatan',
        'keterangan',
    ];

    protected $casts = [
        'ipk' => 'decimal:2',
        'juara' => 'integer',
        'tingkatan' => 'integer',
        'keterangan' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get label untuk nilai juara
     */
    public function getJuaraLabelAttribute()
    {
        $labels = [
            1 => 'Anggota/Peserta',
            3 => 'Juara 3',
            5 => 'Juara 2',
            7 => 'Juara 1',
        ];
        return $labels[$this->juara] ?? '-';
    }

    /**
     * Get label untuk tingkatan
     */
    public function getTingkatanLabelAttribute()
    {
        $labels = [
            1 => 'Internal Kampus',
            3 => 'Kabupaten/Kota',
            5 => 'Provinsi',
            7 => 'Nasional',
            9 => 'Internasional',
        ];
        return $labels[$this->tingkatan] ?? '-';
    }

    /**
     * Get label untuk keterangan
     */
    public function getKeteranganLabelAttribute()
    {
        $labels = [
            1 => 'Non-Akademik',
            3 => 'Akademik',
        ];
        return $labels[$this->keterangan] ?? '-';
    }
}
