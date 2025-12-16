<?php

namespace App\Http\Controllers;

use App\Models\AnggotaHima;
use App\Models\Divisi;
use App\Models\Prestasi;
use App\Models\Berita;
use App\Models\Pendaftaran;
use App\Models\Mahasiswa;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistik utama
        $totalAnggota = AnggotaHima::count();
        $totalDivisi = Divisi::where('status', 'active')->count();
        $totalPrestasi = Prestasi::count();
        $prestasiValid = Prestasi::where('status_validasi', 'disetujui')->count();
        $totalBerita = Berita::count();
        $anggotaAktif = AnggotaHima::count();

        $pendaftaranBaru = Pendaftaran::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        // Aktivitas terbaru dari Prestasi (TANPA user)
        $recentActivities = Prestasi::orderByDesc('created_at')
            ->limit(4)
            ->get()
            ->map(function ($prestasi) {
                return [
                    'text' => 'Prestasi ' . $prestasi->nama_prestasi,
                    'time' => optional($prestasi->created_at)->diffForHumans(),
                    'type' => 'Prestasi',
                    'color' => $prestasi->status_validasi === 'disetujui' ? 'success' : 'warning',
                ];
            })
            ->toArray();

        // Tambahkan Berita jika aktivitas kurang dari 4
        if (count($recentActivities) < 4) {
            $beritaActivities = Berita::orderByDesc('tanggal')
                ->limit(4 - count($recentActivities))
                ->get()
                ->map(function ($berita) {
                    return [
                        'text' => 'Berita ' . $berita->judul . ' dipublikasikan oleh ' . ($berita->penulis ?? 'Unknown'),
                        'time' => $berita->tanggal
                            ? Carbon::parse($berita->tanggal)->diffForHumans()
                            : 'Waktu tidak diketahui',
                        'type' => 'Berita',
                        'color' => 'info',
                    ];
                })
                ->toArray();

            $recentActivities = array_merge($recentActivities, $beritaActivities);
        }

        // Anggota terbaru
        $recentMembers = AnggotaHima::with('divisi')
            ->orderByDesc('created_at')
            ->limit(4)
            ->get()
            ->map(function ($member) {
                return [
                    'name' => $member->nama,
                    'divisi' => $member->divisi->nama_divisi ?? 'N/A',
                    'avatar' => asset('images/default-avatar.png'),
                    'status' => rand(0, 1) ? 'online' : 'offline',
                ];
            })
            ->toArray();

        $prestasiPending = Prestasi::where('status_validasi', 'pending')->count();
        $pendaftaranPending = Pendaftaran::where('status_pendaftaran', 'pending')->count();
        $mahasiswaAktif = Mahasiswa::where('status', 'Aktif')->count();

        return view('admin.dashboard', compact(
            'totalAnggota',
            'totalDivisi',
            'totalPrestasi',
            'totalBerita',
            'anggotaAktif',
            'prestasiValid',
            'prestasiPending',
            'pendaftaranBaru',
            'pendaftaranPending',
            'mahasiswaAktif',
            'recentActivities',
            'recentMembers'
        ));
    }
}
