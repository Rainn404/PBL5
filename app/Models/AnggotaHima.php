<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnggotaHima extends Model
{
    use HasFactory;

    protected $table = 'anggota_hima';
    protected $primaryKey = 'id_anggota_hima';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'id_user',
        'nama',
        'nim', 
        'id_divisi',
        'id_jabatan',
        'semester',
        'status',
        'foto',
    ];

    protected $casts = [
        'status' => 'boolean',
        'semester' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // 🔹 Relasi ke Divisi dengan default value
    public function divisi()
    {
        return $this->belongsTo(Divisi::class, 'id_divisi', 'id_divisi')
                    ->withDefault([
                        'nama_divisi' => 'Tidak ada divisi',
                        'id_divisi' => null
                    ]);
    }

    // 🔹 Relasi ke Jabatan dengan default value  
    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class, 'id_jabatan', 'id_jabatan')
                    ->withDefault([
                        'nama_jabatan' => 'Tidak ada jabatan',
                        'id_jabatan' => null
                    ]);
    }

    // 🔹 Relasi ke User dengan default value
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id')
                    ->withDefault([
                        'name' => 'Tidak ada user',
                        'email' => 'No email'
                    ]);
    }

    // 🔹 Accessor untuk status text
    public function getStatusTextAttribute()
    {
        return $this->status ? 'Aktif' : 'Tidak Aktif';
    }

    // 🔹 Accessor untuk foto URL
    public function getFotoUrlAttribute()
    {
        if ($this->foto) {
            return asset('storage/' . $this->foto);
        }
        return 'https://ui-avatars.com/api/?name=' . urlencode($this->nama) . '&background=3B82F6&color=fff';
    }

    // 🔹 Scope untuk anggota aktif
    public function scopeAktif($query)
    {
        return $query->where('status', true);
    }

    // 🔹 Scope untuk anggota tidak aktif
    public function scopeTidakAktif($query)
    {
        return $query->where('status', false);
    }

    // 🔹 Scope untuk mencari by nama atau NIM
    public function scopeSearch($query, $search)
    {
        return $query->where('nama', 'like', "%{$search}%")
                     ->orWhere('nim', 'like', "%{$search}%");
    }

    // 🔹 Validasi unique NIM saat create
    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            // Cek jika NIM sudah ada
            if (static::where('nim', $model->nim)->exists()) {
                throw new \Exception('NIM sudah terdaftar');
            }
        });

        static::updating(function ($model) {
            // Cek unique NIM kecuali untuk record ini
            if (static::where('nim', $model->nim)->where('id_anggota_hima', '!=', $model->id_anggota_hima)->exists()) {
                throw new \Exception('NIM sudah terdaftar');
            }
        });
    }
}