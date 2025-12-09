<?php

namespace App\Http\Controllers;

use App\Models\Prestasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class PrestasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
  public function index(Request $request)
{
    $user = Auth::user();
    
    // Base query
    $query = Prestasi::with('user');
    
    // Hanya tampilkan disetujui untuk public view
    $query->where('status_validasi', 'disetujui');
    
    // Search by nama mahasiswa (user name)
    if ($request->filled('search')) {
        $query->whereHas('user', function ($q) use ($request) {
            $q->where('name', 'like', '%' . $request->search . '%');
        });
    }
    
    // Filter tahun
    if ($request->filled('tahun')) {
        $query->whereYear('tanggal_mulai', $request->tahun);
    }
    
    // Filter kategori
    if ($request->filled('kategori')) {
        $query->where('kategori', $request->kategori);
    }
    
    // Order by newest first
    $query->orderBy('tanggal_mulai', 'desc');
    
    // Pagination 20 per page dengan appends untuk menjaga filter
    $prestasi = $query->paginate(20)->appends(request()->query());
    
    // List tahun untuk dropdown (hanya dari prestasi disetujui)
    $tahunList = Prestasi::where('status_validasi', 'disetujui')
        ->selectRaw('YEAR(tanggal_mulai) as tahun')
        ->distinct()
        ->orderBy('tahun', 'desc')
        ->pluck('tahun');

    return view('users.prestasi.index', compact('prestasi', 'tahunList'));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.prestasi.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_prestasi' => 'required|string|max:255',
            'kategori' => 'required|string|max:50',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'email' => 'nullable|email|max:255',
            'no_hp' => 'nullable|string|max:15',
            'ipk' => 'nullable|numeric|min:0|max:4',
            'bukti_prestasi' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'deskripsi' => 'required|string',
            'nim' => 'nullable|string|max:20',
            'semester' => 'nullable|integer|min:1|max:8',
        ]);

        // Handle file upload
        if ($request->hasFile('bukti_prestasi')) {
            $file = $request->file('bukti_prestasi');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('prestasi/bukti', $fileName, 'public');
            $validated['bukti_prestasi'] = $filePath;
        }

        // Add user ID and default status
        $validated['id_user'] = Auth::id();
        $validated['status_validasi'] = 'pending';

        Prestasi::create($validated);

        return redirect()->route('prestasi.index')
            ->with('success', 'Prestasi berhasil diajukan! Menunggu validasi admin.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Prestasi $prestasi)
    {
        // Authorization check
        if (Auth::user()->role === 'anggota' && $prestasi->id_user !== Auth::id()) {
            abort(403);
        }

        return response()->json([
            'prestasi' => $prestasi
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Prestasi $prestasi)
    {
        // Authorization check
        if (Auth::user()->role === 'anggota' && $prestasi->id_user !== Auth::id()) {
            abort(403);
        }

        return view('users.prestasi.edit', compact('prestasi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Prestasi $prestasi)
    {
        // Authorization check
        if (Auth::user()->role === 'anggota' && $prestasi->id_user !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'nama_prestasi' => 'required|string|max:255',
            'kategori' => 'required|string|max:50',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'email' => 'required|email|max:255',
            'no_hp' => 'required|string|max:15',
            'ipk' => 'nullable|numeric|min:0|max:4',
            'bukti_prestasi' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'deskripsi' => 'required|string',
            'nim' => 'required|string|max:20',
            'semester' => 'required|integer|min:1|max:8',
        ]);

        // Handle file upload
        if ($request->hasFile('bukti_prestasi')) {
            // Delete old file
            if ($prestasi->bukti_prestasi) {
                Storage::disk('public')->delete($prestasi->bukti_prestasi);
            }

            $file = $request->file('bukti_prestasi');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('prestasi/bukti', $fileName, 'public');
            $validated['bukti_prestasi'] = $filePath;
        }

        $prestasi->update($validated);

        return redirect()->route('prestasi.index')
            ->with('success', 'Prestasi berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Prestasi $prestasi)
    {
        // Authorization check
        if (Auth::user()->role === 'anggota' && $prestasi->id_user !== Auth::id()) {
            abort(403);
        }

        // Delete file
        if ($prestasi->bukti_prestasi) {
            Storage::disk('public')->delete($prestasi->bukti_prestasi);
        }

        $prestasi->delete();

        return redirect()->route('prestasi.index')
            ->with('success', 'Prestasi berhasil dihapus!');
    }

    /**
     * Validate prestasi (admin only)
     */
    public function validatePrestasi(Prestasi $prestasi)
    {
        if (!Auth::user()->isAdministrator()) {
            abort(403);
        }

        $prestasi->update(['status_validasi' => 'disetujui']);

        return response()->json(['success' => true]);
    }

    /**
     * Reject prestasi (admin only)
     */
    public function rejectPrestasi(Prestasi $prestasi)
    {
        if (!Auth::user()->isAdministrator()) {
            abort(403);
        }

        $prestasi->update(['status_validasi' => 'ditolak']);

        return response()->json(['success' => true]);
    }
}