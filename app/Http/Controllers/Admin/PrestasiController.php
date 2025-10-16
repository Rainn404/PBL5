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
    public function validasi(Request $request, $id)
    {
        try {
            $prestasi = Prestasi::findOrFail($id);

            $request->validate([
                'status_validasi' => 'required|in:Menunggu Validasi,Tervalidasi,Ditolak',  // Sesuaikan dengan view
                'alasan_penolakan' => 'nullable|string|max:500',
            ]);

            $prestasi->update([
                'status_validasi' => $request->status_validasi,
                'alasan_penolakan' => $request->status_validasi === 'Ditolak' ? $request->alasan_penolakan : null,
                'tanggal_validasi' => $request->status_validasi === 'Tervalidasi' ? now() : null,
                'validator_id' => auth('super_admin')->id(),  // Pastikan guard ini benar
            ]);

            return redirect()->route('admin.prestasi.index')
                ->with('success', 'Status prestasi berhasil diperbarui!');
        } catch (\Exception $e) {
            Log::error('Error in validasi: ' . $e->getMessage());  // Log error
            return redirect()->route('admin.prestasi.index')
                ->with('error', 'Terjadi kesalahan saat memvalidasi prestasi: ' . $e->getMessage());
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
