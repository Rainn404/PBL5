<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prestasi extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang terhubung dengan model.
     *
     * @var string
     */
    protected $table = 'prestasi';

    /**
     * Primary key untuk model.
     *
     * @var string
     */
    protected $primaryKey = 'id_prestasi';

    /**
     * Atribut yang dapat diisi secara massal (mass assignable).
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_user',
        'nama_prestasi',
        'kategori',
        'tanggal_mulai',
        'tanggal_selesai',
        'email',
        'no_hp',
        'ipk',
        'bukti_prestasi',
        'deskripsi',
        'nim',
        'semester',
        'status_validasi',
        'alasan_penolakan',
        'tanggal_validasi',
        'validator_id',
    ];

    /**
     * Tipe data native yang harus di-cast.
     *
     * @var array
     */
    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
        'ipk' => 'decimal:2',
    ];

    /**
     * Mendapatkan data user yang memiliki prestasi ini.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
    
    /**
     * (Saran) Mendapatkan data admin yang melakukan validasi.
     * Pastikan 'validator_id' merujuk ke tabel yang benar (misal: 'users' atau 'super_admins').
     */
    public function validator()
    {
        // Ganti User::class jika admin ada di tabel lain, misal SuperAdmin::class
        return $this->belongsTo(User::class, 'validator_id');
    }

    /**
     * Scope query untuk memfilter prestasi yang sudah disetujui.
     */
    public function scopeDisetujui($query)
    {
        return $query->where('status_validasi', 'disetujui');
    }

    /**
     * Scope query untuk memfilter prestasi yang masih pending.
     */
    public function scopePending($query)
    {
        return $query->where('status_validasi', 'pending');
    }
}