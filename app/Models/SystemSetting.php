<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pendaftaran;

class SystemSetting extends Model
{
    use HasFactory;

    protected $table = 'system_settings';
    protected $primaryKey = 'id';

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
     * Get system settings with caching
     */
    public static function getSettings()
    {
        return cache()->remember('system_settings', 3600, function () {
            return self::firstOrCreate([], [
                'pendaftaran_aktif' => false,
                'tanggal_mulai' => now()->format('Y-m-d'),
                'tanggal_selesai' => now()->addDays(30)->format('Y-m-d'),
                'kuota' => 30,
                'auto_close' => true
            ]);
        });
    }

    /**
     * Clear settings cache
     */
    public static function clearCache()
    {
        cache()->forget('system_settings');
    }

    /**
     * Check if registration is currently active
     */
    public static function isRegistrationActive()
    {
        $settings = self::getSettings();
        
        if (!$settings->pendaftaran_aktif) {
            return false;
        }

        $now = now();
        if ($now->lt($settings->tanggal_mulai) || $now->gt($settings->tanggal_selesai)) {
            return false;
        }

        return true;
    }

    /**
     * Check if quota is full
     */
    public static function isQuotaFull()
    {
        $settings = self::getSettings();
        $totalAccepted = Pendaftaran::where('status_pendaftaran', 'diterima')->count();
        
        return $totalAccepted >= $settings->kuota;
    }
}