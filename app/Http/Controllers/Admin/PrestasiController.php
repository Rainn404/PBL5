<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Prestasi;
use Illuminate\Http\Request;

class PrestasiController extends Controller
{
    public function index()
    {
        $prestasiQuery = Prestasi::with('user');
        
        // Filter berdasarkan status (menggunakan accessor)
        if (request('status') && request('status') != 'all') {
            $statusMapping = [
                'Menunggu Validasi' => 'pending',
                'Tervalidasi' => 'disetujui', 
                'Ditolak' => 'ditolak'
            ];
            $prestasiQuery->where('status_validasi', $statusMapping[request('status')]);
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
                      ->orWhere('nim', 'like', "%{$search}%")
                      ->orWhereHas('user', function($q) use ($search) {
                          $q->where('name', 'like', "%{$search}%")
                            ->orWhere('nim', 'like', "%{$search}%");
                      });
            });
        }

        $prestasi = $prestasiQuery->latest()->paginate(10);

        // Statistik - menggunakan field database yang benar
        $totalPrestasi = Prestasi::count();
        $prestasiMenunggu = Prestasi::where('status_validasi', 'pending')->count();
        $prestasiTervalidasi = Prestasi::where('status_validasi', 'disetujui')->count();
        $prestasiDitolak = Prestasi::where('status_validasi', 'ditolak')->count();
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
     * Validasi prestasi individual
     */
    public function validasi(Request $request, $id)
    {
        try {
            $prestasi = Prestasi::findOrFail($id);
            
            $request->validate([
                'status' => 'required|in:Menunggu Validasi,Tervalidasi,Ditolak'
            ]);
            
            // Gunakan mutator untuk update status
            $updateData = [
                'status' => $request->status // Ini akan trigger mutator
            ];
            
            // Jika status disetujui, set tanggal validasi dan validator
            if ($request->status == 'Tervalidasi') {
                $updateData['tanggal_validasi'] = now();
                $updateData['validator_id'] = auth('super_admin')->id();
            }
            
            // Jika status ditolak atau menunggu, reset tanggal validasi
            if ($request->status == 'Ditolak' || $request->status == 'Menunggu Validasi') {
                $updateData['tanggal_validasi'] = null;
            }
            
            $prestasi->update($updateData);
            
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
     * Tampilkan form tambah prestasi
     */
    public function create()
    {
        return view('admin.prestasi.create', [
            'title' => 'Tambah Prestasi',
            'action' => route('admin.prestasi.store')
        ]);
    }

    /**
     * Simpan data prestasi baru
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'nama' => 'required|string|max:255',
                'nim' => 'required|string|max:20',
                'email' => 'required|email',
                'no_hp' => 'required|string|max:15',
                'semester' => 'required|integer|min:1|max:8',
                'nama_prestasi' => 'required|string|max:255',
                'kategori' => 'required|string',
                'tanggal_mulai' => 'required|date',
                'tanggal_selesai' => 'required|date',
                'ipk' => 'nullable|numeric|min:0|max:4',
                'deskripsi' => 'required|string',
                'status' => 'required|in:Menunggu Validasi,Tervalidasi,Ditolak',
                'bukti' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120'
            ]);

            // Handle file upload - sesuaikan dengan nama field migration
            if ($request->hasFile('bukti')) {
                $file = $request->file('bukti');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $filePath = $file->storeAs('bukti_prestasi', $fileName, 'public');
                $validated['bukti_prestasi'] = $filePath;
            }

            // Create prestasi dengan field yang sesuai migration
            // 'status' akan dihandle oleh mutator
            Prestasi::create([
                'nama_prestasi' => $validated['nama_prestasi'],
                'kategori' => $validated['kategori'],
                'tanggal_mulai' => $validated['tanggal_mulai'],
                'tanggal_selesai' => $validated['tanggal_selesai'],
                'email' => $validated['email'],
                'no_hp' => $validated['no_hp'],
                'ipk' => $validated['ipk'],
                'bukti_prestasi' => $validated['bukti_prestasi'] ?? null,
                'deskripsi' => $validated['deskripsi'],
                'nim' => $validated['nim'],
                'semester' => $validated['semester'],
                'status' => $validated['status'] // Ini akan trigger mutator
            ]);

            return redirect()->route('admin.prestasi.index')
                ->with('success', 'Prestasi berhasil ditambahkan!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function show($id)
    {
        $prestasi = Prestasi::findOrFail($id);
        return view('admin.prestasi.show', compact('prestasi'));
    }

    public function edit($id)
    {
        $prestasi = Prestasi::findOrFail($id);
        return view('admin.prestasi.edit', [
            'title' => 'Edit Prestasi',
            'prestasi' => $prestasi,
            'action' => route('admin.prestasi.update', $prestasi->id_prestasi)
        ]);
    }

    public function update(Request $request, $id)
    {
        try {
            $prestasi = Prestasi::findOrFail($id);

            $validated = $request->validate([
                'nama_prestasi' => 'required|string|max:255',
                'kategori' => 'required|string',
                'tanggal_mulai' => 'required|date',
                'tanggal_selesai' => 'required|date',
                'email' => 'required|email',
                'no_hp' => 'required|string|max:15',
                'ipk' => 'nullable|numeric|min:0|max:4',
                'deskripsi' => 'required|string',
                'nim' => 'required|string|max:20',
                'semester' => 'required|integer|min:1|max:8',
                'status' => 'required|in:Menunggu Validasi,Tervalidasi,Ditolak',
                'bukti' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120'
            ]);

            // Handle file upload
            if ($request->hasFile('bukti')) {
                $file = $request->file('bukti');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $filePath = $file->storeAs('bukti_prestasi', $fileName, 'public');
                $validated['bukti_prestasi'] = $filePath;
            }

            // Update prestasi - 'status' akan dihandle oleh mutator
            $prestasi->update($validated);

            return redirect()->route('admin.prestasi.index')
                ->with('success', 'Prestasi berhasil diperbarui!');
                
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $prestasi = Prestasi::findOrFail($id);
            $prestasi->delete();
            
            return redirect()->route('admin.prestasi.index')
                ->with('success', 'Prestasi berhasil dihapus!');
                
        } catch (\Exception $e) {
            return redirect()->route('admin.prestasi.index')
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}