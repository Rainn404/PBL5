<?php

namespace App\Http\Controllers;

use App\Models\Prestasi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PrestasiController extends Controller
{
    public function index()
    {
        $query = Prestasi::with('user');
        
        // Filter berdasarkan role user
        if (Auth::check()) {
            if (Auth::user()->role === 'anggota') {
                $query->where('id_user', Auth::id());
            }
        } else {
            // Untuk freeuser, hanya tampilkan yang disetujui
            $query->where('status_validasi', 'disetujui');
        }
        
        $prestasi = $query->orderBy('created_at', 'desc')->paginate(9);
        
        $stats = [
            'totalPrestasi' => Prestasi::count(),
            'prestasiValid' => Prestasi::where('status_validasi', 'disetujui')->count(),
            'prestasiPending' => Prestasi::where('status_validasi', 'pending')->count(),
            'mahasiswaBerprestasi' => Prestasi::distinct('id_user')->count('id_user'),
            'tahunList' => Prestasi::selectRaw('YEAR(tanggal_mulai) as tahun')
                ->distinct()
                ->orderBy('tahun', 'desc')
                ->pluck('tahun')
        ];
        
        return view('prestasi', array_merge($stats, ['prestasi' => $prestasi]));
    }

    public function create()
    {
        // Hanya anggota yang bisa mengajukan prestasi
        if (Auth::user()->role !== 'anggota') {
            return redirect()->route('prestasi.index')
                ->with('error', 'Hanya anggota HIMA-TI yang dapat mengajukan prestasi.');
        }
        
        return view('prestasi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:150',
            'nim' => 'required|string|max:30',
            'email' => 'required|email|max:150',
            'no_hp' => 'required|string|max:20',
            'kategori' => 'required|in:akademik,non-akademik',
            'capaian' => 'required|string|max:255',
            'semester' => 'required|integer|min:1|max:14',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'bukti' => 'required|file|mimes:pdf,jpg,png,jpeg|max:2048'
        ]);

        // Upload bukti prestasi
        $buktiPath = $request->file('bukti')->store('prestasi-bukti');

        $prestasi = new Prestasi();
        $prestasi->id_user = Auth::id();
        $prestasi->fill($request->all());
        $prestasi->bukti = $buktiPath;
        $prestasi->status_validasi = 'pending';

        $prestasi->save();

        return redirect()->route('prestasi.index')
            ->with('success', 'Prestasi berhasil diajukan. Menunggu validasi admin.');
    }

    public function show($id)
    {
        $prestasi = Prestasi::with('user')->findOrFail($id);
        
        return response()->json([
            'prestasi' => $prestasi
        ]);
    }

    public function edit($id)
    {
        $prestasi = Prestasi::findOrFail($id);
        
        // Authorization check
        if (Auth::user()->role === 'anggota' && $prestasi->id_user !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('prestasi.edit', compact('prestasi'));
    }

    public function update(Request $request, $id)
    {
        $prestasi = Prestasi::findOrFail($id);
        
        // Authorization check
        if (Auth::user()->role === 'anggota' && $prestasi->id_user !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'nama' => 'required|string|max:150',
            'nim' => 'required|string|max:30',
            'email' => 'required|email|max:150',
            'no_hp' => 'required|string|max:20',
            'kategori' => 'required|in:akademik,non-akademik',
            'capaian' => 'required|string|max:255',
            'semester' => 'required|integer|min:1|max:14',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'bukti' => 'nullable|file|mimes:pdf,jpg,png,jpeg|max:2048'
        ]);

        $prestasi->fill($request->all());

        if ($request->hasFile('bukti')) {
            // Delete old bukti if exists
            if ($prestasi->bukti) {
                Storage::delete($prestasi->bukti);
            }
            $prestasi->bukti = $request->file('bukti')->store('prestasi-bukti');
        }

        $prestasi->save();

        return redirect()->route('prestasi.index')
            ->with('success', 'Prestasi berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $prestasi = Prestasi::findOrFail($id);
        
        // Authorization check
        if (Auth::user()->role === 'anggota' && $prestasi->id_user !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        if ($prestasi->bukti) {
            Storage::delete($prestasi->bukti);
        }

        $prestasi->delete();

        return redirect()->route('prestasi.index')
            ->with('success', 'Prestasi berhasil dihapus.');
    }

    public function validatePrestasi($id)
    {
        // Hanya admin yang bisa validasi
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        $prestasi = Prestasi::findOrFail($id);
        $prestasi->status_validasi = 'disetujui';
        $prestasi->save();

        return response()->json(['success' => true]);
    }

    public function rejectPrestasi($id)
    {
        // Hanya admin yang bisa reject
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        $prestasi = Prestasi::findOrFail($id);
        $prestasi->status_validasi = 'ditolak';
        $prestasi->save();

        return response()->json(['success' => true]);
    }

    public function validasiIndex()
    {
        // Hanya admin yang bisa akses
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        $prestasiPending = Prestasi::with('user')
            ->where('status_validasi', 'pending')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('prestasi.validasi', compact('prestasiPending'));
    }
}