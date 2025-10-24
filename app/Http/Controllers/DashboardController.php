<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display dashboard page
     */
    public function index()
    {
        // Data statis sementara - nanti bisa diambil dari database
        $data = [
            'totalAnggota' => 150,
            'totalDivisi' => 8,
            'totalPrestasi' => 25,
            'totalBerita' => 12,
            'anggotaAktif' => 142,
            'prestasiValid' => 18,
            'pendaftaranBaru' => 5,
            'recentActivities' => [
                [
                    'text' => 'Prestasi baru ditambahkan oleh Ahmad Rizki',
                    'time' => '2 jam lalu',
                    'type' => 'Prestasi',
                    'color' => 'warning'
                ],
                [
                    'text' => 'Anggota baru bergabung: Siti Nurhaliza',
                    'time' => '4 jam lalu',
                    'type' => 'Anggota',
                    'color' => 'primary'
                ],
                [
                    'text' => 'Berita dipublikasikan oleh Admin',
                    'time' => '6 jam lalu',
                    'type' => 'Berita',
                    'color' => 'info'
                ],
                [
                    'text' => 'Divisi IT diperbarui oleh Ketua Divisi',
                    'time' => '1 hari lalu',
                    'type' => 'Divisi',
                    'color' => 'success'
                ]
            ],
            // Tambahkan ini agar tidak error di Blade
            'recentMembers' => [
                [
                    'name' => 'Ahmad Rizki',
                    'divisi' => 'IT',
                    'avatar' => asset('images/default-avatar.png'),
                    'status' => 'online'
                ],
                [
                    'name' => 'Siti Nurhaliza',
                    'divisi' => 'Desain',
                    'avatar' => asset('images/default-avatar.png'),
                    'status' => 'offline'
                ],
                [
                    'name' => 'Budi Santoso',
                    'divisi' => 'Humas',
                    'avatar' => asset('images/default-avatar.png'),
                    'status' => 'online'
                ],
                [
                    'name' => 'Dewi Lestari',
                    'divisi' => 'Keuangan',
                    'avatar' => asset('images/default-avatar.png'),
                    'status' => 'offline'
                ]
            ]
        ];

        return view('admin.dashboard', $data);
    }
}
