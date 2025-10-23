<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Prestasi;  // Pastikan model ini sesuai
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;  // Untuk logging error

class PrestasiController extends Controller
{
    /**
     * Validasi prestasi individual
     */
  // AdminPrestasiController.php
public function validasi(Request $request, $id)
{
    try {
        $prestasi = Prestasi::findOrFail($id);
        
        $request->validate([
            'status' => 'required|in:Menunggu Validasi,Tervalidasi,Ditolak'
        ]);
        
        $prestasi->update([
            'status' => $request->status
        ]);
        
        $statusText = $request->status == 'Tervalidasi' ? 'divalidasi' : 
                     ($request->status == 'Ditolak' ? 'ditolak' : 'dibatalkan validasinya');
        
        return redirect()->route('admin.prestasi.index')
            ->with('success', "Prestasi '{$prestasi->nama_prestasi}' berhasil $statusText!");
            
    } catch (\Exception $e) {
        return redirect()->route('admin.prestasi.index')
            ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
    }
}

    /**
     * Aksi massal untuk validasi
     */
    public function bulkAction(Request $request)
    {
        try {
            $request->validate([
                'selected_ids' => 'required|string',  // JSON string
                'status_validasi' => 'required|in:Tervalidasi,Ditolak',  // Sesuaikan dengan view
                'alasan_penolakan' => 'nullable|string|max:500',
            ]);

            $selectedIds = json_decode($request->selected_ids, true);  // Decode JSON

            if (!is_array($selectedIds)) {
                throw new \Exception('ID yang dipilih tidak valid. Harus berupa array.');
            }

            $updateData = [
                'status_validasi' => $request->status_validasi,
                'validator_id' => auth('super_admin')->id(),
                'tanggal_validasi' => $request->status_validasi === 'Tervalidasi' ? now() : null,
            ];

            if ($request->status_validasi === 'Ditolak') {
                $updateData['alasan_penolakan'] = $request->alasan_penolakan;
            }

            // Update batch
            Prestasi::whereIn('id_prestasi', $selectedIds)->update($updateData);

            return redirect()->route('admin.prestasi.index')
                ->with('success', 'Prestasi berhasil diperbarui secara massal!');
        } catch (\Exception $e) {
            Log::error('Error in bulkAction: ' . $e->getMessage());  // Log error untuk debugging
            return redirect()->route('admin.prestasi.index')
                ->with('error', 'Terjadi kesalahan saat melakukan aksi massal: ' . $e->getMessage());
        }
    }

    /**
     * Statistik untuk dashboard
     */
    /**
 * Tampilkan form tambah prestasi
 */
public function create()
{
    // Kalau kamu perlu data tambahan untuk form (misal daftar kategori, user, dsb.)
    // bisa ambil di sini.
    return view('admin.prestasi.create');
}

/**
 * Simpan data prestasi baru
 */
// Di Controller - ganti validasi dari 'tanggal' menjadi 'tanggal_mulai' dan 'tanggal_selesai'
public function store(Request $request)
{
    try {
        // Debug request data
        // dd($request->all());
        
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nim' => 'required|string|max:15',
            'email' => 'required|email',
            'no_hp' => 'required|string|max:15',
            'semester' => 'required|integer|min:1|max:8',
            'nama_prestasi' => 'required|string|max:255',
            'kategori' => 'required|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date',
            'ipk' => 'nullable|numeric|min:0|max:4',
            'deskripsi' => 'required|string|max:500',
            'status' => 'required|string',
            'bukti' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120'
        ]);

        // Debug validated data
        // dd($validated);

        // Handle file upload
        if ($request->hasFile('bukti')) {
            $file = $request->file('bukti');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('bukti_prestasi', $fileName, 'public');
            $validated['bukti'] = $filePath;
        }

        // Create prestasi
        Prestasi::create($validated);

        return redirect()->route('admin.prestasi.index')
            ->with('success', 'Prestasi berhasil ditambahkan!');

    } catch (\Exception $e) {
        // Tambahkan ini untuk melihat error
        dd($e->getMessage());
        return redirect()->back()
            ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
            ->withInput();
    }
}

public function show($id)
{
    $prestasi = \App\Models\Prestasi::findOrFail($id);
    return view('admin.prestasi.show', compact('prestasi'));
}

    public function index()
    {
        $prestasiQuery = Prestasi::with('user');
        
        // Filter berdasarkan status (sesuaikan dengan 'status_validasi')
        if (request('status') && request('status') != 'all') {
            $prestasiQuery->where('status_validasi', request('status'));  // Ganti 'status' menjadi 'status_validasi'
        }
        
        // Filter berdasarkan kategori
        if (request('kategori') && request('kategori') != 'all') {
            $prestasiQuery->where('kategori', request('kategori'));
        }
        
        // Filter berdasarkan pencarian
        if (request('search')) {
            $search = request('search');
            $prestasiQuery->where(function($query) use ($search) {
                $query->where('nama_prestasi', 'like', "%{$search}%")
                      ->orWhere('nama', 'like', "%{$search}%")
                      ->orWhereHas('user', function($q) use ($search) {
                          $q->where('name', 'like', "%{$search}%")
                            ->orWhere('nim', 'like', "%{$search}%");
                      });
            });
        }

        $prestasi = $prestasiQuery->latest()->paginate(10);

        // Statistik - Gunakan 'status_validasi' untuk konsistensi
        $totalPrestasi = Prestasi::count();
        $prestasiMenunggu = Prestasi::where('status_validasi', 'Menunggu Validasi')->count();  // Sesuaikan
        $prestasiTervalidasi = Prestasi::where('status_validasi', 'Tervalidasi')->count();
        $prestasiDitolak = Prestasi::where('status_validasi', 'Ditolak')->count();
        $totalUsers = \App\Models\User::count();
        $rataRataIPK = Prestasi::whereNotNull('ipk')->avg('ipk') ?? 0;

        return view('admin.prestasi.index', compact(
            'prestasi',
            'totalPrestasi',
            'prestasiMenunggu',
            'prestasiTervalidasi',
            'prestasiDitolak',
            'totalUsers',
            'rataRataIPK'
        ));
    }

    /**
     * Update prestasi (jika diperlukan)
     */
    public function update(Request $request, $id)
    {
        try {
            $prestasi = Prestasi::findOrFail($id);

            $request->validate([
                'status_validasi' => 'required|in:Menunggu Validasi,Tervalidasi,Ditolak',  // Sesuaikan
                'alasan_penolakan' => 'nullable|string|max:500',
            ]);

            $prestasi->status_validasi = $request->status_validasi;
            $prestasi->alasan_penolakan = $request->status_validasi === 'Ditolak' ? $request->alasan_penolakan : null;
            $prestasi->validator_id = auth('super_admin')->id();

            if ($request->status_validasi === 'Tervalidasi') {
                $prestasi->tanggal_validasi = now();
            } else {
                $prestasi->tanggal_validasi = null;
            }

            $prestasi->save();

            return redirect()->route('admin.prestasi.index')
                ->with('success', 'Status prestasi berhasil diperbarui!');
        } catch (\Exception $e) {
            Log::error('Error in update: ' . $e->getMessage());
            return redirect()->route('admin.prestasi.index')
                ->with('error', 'Error: ' . $e->getMessage());
        }
    }
}
