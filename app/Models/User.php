<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Scope untuk super admin
     */
    public function scopeSuperAdmin($query)
    {
        return $query->where('role', 'super_admin');
    }

    /**
     * Scope untuk admin biasa
     */
    public function scopeAdmin($query)
    {
        return $query->where('role', 'admin');
    }

    /**
     * Scope untuk mahasiswa
     */
    public function scopeMahasiswa($query)
    {
        return $query->where('role', 'mahasiswa');
    }

    /**
     * Relasi dengan pendaftaran
     */
    public function pendaftaran()
    {
        return $this->hasOne(Pendaftaran::class, 'user_id');
    }

    /**
     * Cek apakah user adalah super admin
     */
    public function isSuperAdmin()
    {
        return $this->role === 'super_admin';
    }

    /**
     * Cek apakah user adalah admin
     */
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    /**
     * Cek apakah user adalah mahasiswa
     */
    public function isMahasiswa()
    {
        return $this->role === 'mahasiswa';
    }

    /**
     * Cek apakah user memiliki akses admin
     */
    public function isAdministrator()
    {
        return in_array($this->role, ['super_admin', 'admin']);
    }
}