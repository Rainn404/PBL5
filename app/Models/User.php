<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'id_user';

    protected $fillable = [
        'nama',
        'email',
        'password',
        'no_hp',
        'role'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Relasi dengan pendaftaran
    public function pendaftaran()
    {
        return $this->hasMany(Pendaftaran::class, 'id_user');
    }

    // Relasi sebagai validator
    public function validasiPendaftaran()
    {
        return $this->hasMany(Pendaftaran::class, 'divalidasi_oleh');
    }
}