<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Divisi extends Model
{
    use HasFactory;

    protected $table = 'divisi';
    protected $primaryKey = 'id_divisi';
    public $timestamps = false;

    protected $fillable = [
        'nama',
        'deskripsi'
    ];

    /**
     * Get the anggota_hima for the divisi.
     */
    public function anggotaHima()
    {
        return $this->hasMany(AnggotaHima::class, 'id_divisi', 'id_divisi');
    }
}