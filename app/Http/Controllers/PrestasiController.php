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
  public function index()
{
    $user = Auth::user(); // Cek user login

    $prestasi = Prestasi::with('user')
        ->when($user && $user->role === 'anggota', function ($query) use ($user) {
            return $query->where('id_user', $user->id);
        })
        ->orderBy('created_at', 'desc')
        ->paginate(10);

    $totalPrestasi = Prestasi::count();
    $prestasiTervalidasi = Prestasi::where('status_validasi', 'disetujui')->count();
    $prestasiMenunggu = Prestasi::where('status_validasi', 'pending')->count();
    $prestasiDitolak = Prestasi::where('status_validasi', 'ditolak')->count();
    $mahasiswaBerprestasi = Prestasi::distinct('id_user')->count('id_user');
    $tahunList = Prestasi::selectRaw('YEAR(tanggal_mulai) as tahun')
        ->distinct()
        ->orderBy('tahun', 'desc')
        ->pluck('tahun');

    $prestasiTerbaru = Prestasi::latest()->take(5)->get();

    return view('users.prestasi.index', compact(
        'prestasi',
        'totalPrestasi',
        'prestasiTervalidasi',
        'prestasiMenunggu',
        'prestasiDitolak',
        'mahasiswaBerprestasi',
        'tahunList',
        'prestasiTerbaru'
    ));
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
        if (Auth::user()->role !== 'admin') {
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
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        $prestasi->update(['status_validasi' => 'ditolak']);

        return response()->json(['success' => true]);
    }
}