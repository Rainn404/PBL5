<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendaftaranSetting extends Model
{
    use HasFactory;

    protected $table = 'pendaftaran_settings';
    
    protected $fillable = [
        'pendaftaran_aktif',
        'tanggal_mulai',
        'tanggal_selesai',
        'kuota',
        'auto_close'
    ];
    
    protected $casts = [
        'pendaftaran_aktif' => 'boolean',
        'auto_close' => 'boolean',
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date'
    ];
}