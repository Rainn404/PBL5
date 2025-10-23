<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prestasi extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang digunakan oleh model ini
     */
    protected $table = 'prestasi'; // ✅ Tambahkan ini agar tidak dicari 'prestasis'

    /**
     * Primary key dari tabel
     */
    protected $primaryKey = 'id_prestasi';

    /**
     * Kolom yang bisa diisi (mass assignable)
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
        'validator_id'
    ];

    /**
     * Konversi otomatis tipe data kolom tertentu
     */
    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
        'tanggal_validasi' => 'datetime',
        'ipk' => 'decimal:2'
    ];

    /**
     * Relasi ke tabel users (user yang mengajukan prestasi)
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    /**
     * Relasi ke validator (jika ada kolom validator_id)
     */
    public function validator()
    {
        return $this->belongsTo(User::class, 'validator_id');
    }

    /**
     * Accessor: menampilkan status_validasi dalam bentuk label (untuk tampilan)
     */
    public function getStatusAttribute()
    {
        $mapping = [
            'pending' => 'Menunggu Validasi',
            'disetujui' => 'Tervalidasi',
            'ditolak' => 'Ditolak',
        ];

        return $mapping[$this->status_validasi] ?? 'Tidak Diketahui';
    }

    /**
     * Mutator: menerima input dari view dalam bentuk label dan ubah ke status_validasi
     */
    public function setStatusAttribute($value)
    {
        $mapping = [
            'Menunggu Validasi' => 'pending',
            'Tervalidasi' => 'disetujui',
            'Ditolak' => 'ditolak',
        ];

        $this->attributes['status_validasi'] = $mapping[$value] ?? 'pending';
    }
}
