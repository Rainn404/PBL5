<?php

namespace app\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    use HasFactory;

    protected $table = 'pendaftaran';
    protected $primaryKey = 'id_pendaftaran';

    protected $fillable = [
    'id_user',
    'nim', 
    'nama',
    'semester',
    'alasan_mendaftar',
    'dokumen',
    'no_hp',
    'status_pendaftaran',
    'submitted_at'
];

    protected $casts = [
        'submitted_at' => 'datetime',
    ];

    /**
     * Get the user that owns the pendaftaran.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    /**
     * Get the validator user.
     */
    public function validator()
    {
        return $this->belongsTo(User::class, 'divalidasi_oleh');
    }

    /**
     * Get status badge class
     */
    public function getStatusBadgeAttribute()
    {
        $statuses = [
            'pending' => 'bg-yellow-100 text-yellow-800',
            'diterima' => 'bg-green-100 text-green-800',
            'ditolak' => 'bg-red-100 text-red-800',
        ];

        return $statuses[$this->status_pendaftaran] ?? 'bg-gray-100 text-gray-800';
    }

    /**
     * Get status label
     */
    public function getStatusLabelAttribute()
    {
        $labels = [
            'pending' => 'Menunggu',
            'diterima' => 'Diterima',
            'ditolak' => 'Ditolak',
        ];

        return $labels[$this->status_pendaftaran] ?? 'Tidak Diketahui';
    }
}