<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SystemSetting extends Model
{
    use HasFactory;

    protected $table = 'system_settings';
    
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

    /**
     * Get system settings
     */
    public static function getSettings()
    {
        return self::first() ?? new self([
            'pendaftaran_aktif' => false,
            'tanggal_mulai' => now()->format('Y-m-d'),
            'tanggal_selesai' => now()->addMonth()->format('Y-m-d'),
            'kuota' => 50,
            'auto_close' => true
        ]);
    }

    /**
     * Check if registration is active
     */
    public static function isRegistrationActive()
    {
        $settings = self::getSettings();
        
        if (!$settings->pendaftaran_aktif) {
            return false;
        }

        $now = now();
        $start = \Carbon\Carbon::parse($settings->tanggal_mulai);
        $end = \Carbon\Carbon::parse($settings->tanggal_selesai)->endOfDay();

        return $now->between($start, $end);
    }

    /**
     * Check if quota is full
     */
    public static function isQuotaFull()
    {
        $settings = self::getSettings();
        $totalDiterima = \App\Models\Pendaftaran::where('status_pendaftaran', 'diterima')->count();
        
        return $totalDiterima >= $settings->kuota;
    }
}