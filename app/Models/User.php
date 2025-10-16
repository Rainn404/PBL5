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
        'nim',
        'phone',
        'role',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Relationship dengan prestasi
    public function prestasi()
    {
        return $this->hasMany(Prestasi::class, 'nim', 'nim');
    }

    // Helper methods untuk check role
    public function isMahasiswa()
    {
        return $this->role === 'mahasiswa';
    }

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isSuperAdmin()
    {
        return $this->role === 'super_admin';
    }

    // Method yang diperbaiki - tambahkan ini
    public function isAdminOrSuperAdmin()
    {
        return $this->isAdmin() || $this->isSuperAdmin();
    }
}