<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prestasi extends Model
{
    use HasFactory;

    protected $table = 'prestasi';
    protected $primaryKey = 'id_prestasi';
    
    protected $fillable = [
        'id_user',
        'nama',
        'nim',
        'email',
        'no_hp',
        'kategori',
        'capaian',
        'semester',
        'tanggal_mulai',
        'tanggal_selesai',
        'bukti',
        'status_validasi'
    ];

    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
    ];

    // Relasi ke user
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    // Scope untuk prestasi yang sudah divalidasi
    public function scopeValid($query)
    {
        return $query->where('status_validasi', 'disetujui');
    }

    // Scope untuk prestasi pending
    public function scopePending($query)
    {
        return $query->where('status_validasi', 'pending');
    }

    // Accessor untuk status
    public function getStatusAttribute()
    {
        return $this->status_validasi;
    }

    // Mutator untuk status
    public function setStatusAttribute($value)
    {
        $this->attributes['status_validasi'] = $value;
    }
}