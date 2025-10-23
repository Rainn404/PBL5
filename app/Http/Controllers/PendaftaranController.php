<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use App\Models\SystemSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PendaftaranController extends Controller
{
    public function index()
    {
        return $this->checkPendaftaranStatus();
    }

    public function checkPendaftaranStatus()
    {
        $settings = SystemSetting::getSettings();

        // 🚀 SELALU AKTIF — lewati semua pengecekan
        return view('users.pendaftaran.create', compact('settings'));
    }

    public function create()
    {
        // Langsung tampilkan form
        return $this->checkPendaftaranStatus();
    }

    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'nama' => 'required|string|max:150',
            'nim' => 'required|string|max:30|unique:pendaftaran,nim',
            'semester' => 'required|integer|between:1,8',
            'no_hp' => 'required|string|max:20',
            'alasan_mendaftar' => 'required|string|min:50',
            'pengalaman' => 'nullable|string',
            'skill' => 'nullable|string',
            'dokumen' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'agree' => 'required|accepted'
        ]);

        // 🚀 Skip semua logika "tertutup" atau "kuota penuh"
        // Pendaftaran dianggap selalu terbuka

        // Handle file upload
        if ($request->hasFile('dokumen')) {
            $dokumenPath = $request->file('dokumen')->store('dokumen_pendaftaran', 'public');
            $validated['dokumen'] = $dokumenPath;
        }

        // Tambahkan submitted_at dan status
        $validated['submitted_at'] = now();
        $validated['status_pendaftaran'] = 'pending';

        // Simpan data ke database
        $pendaftaran = Pendaftaran::create($validated);
return redirect()->route('pendaftaran.success');

    }

    public function show($id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);
        return view('users.pendaftaran.status', compact('pendaftaran'));
    }

    public function closed()
    {
        // Tidak akan pernah dipakai, tapi tetap disediakan
        $settings = SystemSetting::getSettings();
        return view('users.pendaftaran.closed', compact('settings'));
    }

    public function quotaFull()
    {
        // Tidak akan pernah dipakai, tapi tetap disediakan
        $settings = SystemSetting::getSettings();
        return view('users.pendaftaran.quota-full', compact('settings'));
    }

    public function status($id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);
        return view('users.pendaftaran.status', compact('pendaftaran'));
    }

    public function success()
    {
        return view('users.pendaftaran.success');
    }

    public function showCheckStatus()
    {
        return view('users.pendaftaran.check-status');
    }

    public function checkStatus(Request $request)
    {
        $request->validate([
            'nim' => 'required|string'
        ]);

        $pendaftaran = Pendaftaran::where('nim', $request->nim)->first();

        if (!$pendaftaran) {
            return back()->with('error', 'Data pendaftaran tidak ditemukan');
        }

        return redirect()->route('pendaftaran.show', $pendaftaran->id_pendaftaran);
    }

    public function showApi($id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);
        return response()->json($pendaftaran);
    }

    public function getStatus()
    {
        $settings = SystemSetting::getSettings();
        return response()->json([
            'pendaftaran_aktif' => true, // 🚀 Selalu aktif
            'is_active' => true,
            'is_quota_full' => false,
            'tanggal_mulai' => $settings->tanggal_mulai,
            'tanggal_selesai' => $settings->tanggal_selesai,
            'kuota' => $settings->kuota,
            'total_diterima' => Pendaftaran::where('status_pendaftaran', 'diterima')->count(),
            'total_pending' => Pendaftaran::where('status_pendaftaran', 'pending')->count()
        ]);
    }
}
