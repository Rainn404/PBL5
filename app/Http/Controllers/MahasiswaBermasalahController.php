<?php

namespace App\Http\Controllers;

use App\Models\MahasiswaBermasalah;
use App\Models\Mahasiswa;
use App\Models\Pelanggaran;
use App\Models\Sanksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MahasiswaBermasalahController extends Controller
{
    public function index()
    {
        $mahasiswaBermasalah = MahasiswaBermasalah::with(['pelanggaran', 'sanksi'])->paginate(10);
        return view('admin.mahasiswa-bermasalah.index', compact('mahasiswaBermasalah'));
    }

    public function create()
    {
        $pelanggaran = Pelanggaran::all();
        $sanksi = Sanksi::all();
        return view('admin.mahasiswa-bermasalah.create', compact('pelanggaran', 'sanksi'));
    }

    public function getMahasiswaByNim($nim)
    {
        $mahasiswa = Mahasiswa::where('nim', $nim)->first();

        if (!$mahasiswa) {
            return response()->json(['error' => 'Mahasiswa tidak ditemukan'], 404);
        }

        return response()->json([
            'nama' => $mahasiswa->nama ?? $mahasiswa->nama_mahasiswa ?? $mahasiswa->nama_lengkap ?? 'Tidak diketahui',
            'semester' => $mahasiswa->semester_aktif ?? $mahasiswa->semester ?? 'Tidak diketahui',
            'nama_orang_tua' => $mahasiswa->nama_ortu ?? $mahasiswa->nama_orang_tua ?? 'Tidak diketahui'
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nim' => 'required|exists:mahasiswas,nim',
            'pelanggaran_id' => 'required|exists:pelanggaran,id',
            'sanksi_id' => 'required|exists:sanksi,id',
            'deskripsi' => 'required'
        ]);

        // Ambil data mahasiswa berdasarkan NIM
        $mahasiswa = Mahasiswa::where('nim', $request->nim)->first();

        if (!$mahasiswa) {
            return back()->withErrors(['nim' => 'Mahasiswa tidak ditemukan']);
        }

        // Simpan ke tabel mahasiswa_bermasalah
        MahasiswaBermasalah::create([
            'nim' => $mahasiswa->nim,
            'nama' => $mahasiswa->nama ?? $mahasiswa->nama_mahasiswa ?? $mahasiswa->nama_lengkap ?? 'Tidak diketahui',
            'semester' => $mahasiswa->semester_aktif ?? $mahasiswa->semester ?? $request->semester ?? 0,
            'nama_orang_tua' => $mahasiswa->nama_ortu ?? $mahasiswa->nama_orang_tua ?? $request->nama_orang_tua ?? 'Tidak diketahui',
            'pelanggaran_id' => $request->pelanggaran_id,
            'sanksi_id' => $request->sanksi_id,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('admin.mahasiswa-bermasalah.index')
            ->with('success', 'Data mahasiswa bermasalah berhasil ditambahkan.');
    }

    // Method baru untuk menyimpan multiple mahasiswa dengan data pelanggaran sama
    public function storeMultiple(Request $request)
    {
        $request->validate([
            'mahasiswa.*.nim' => 'required|exists:mahasiswas,nim',
            'mahasiswa.*.nama' => 'required|string|max:255',
            'mahasiswa.*.semester' => 'required|integer|min:1|max:14',
            'mahasiswa.*.nama_orang_tua' => 'required|string|max:255',
            'pelanggaran_id' => 'required|exists:pelanggaran,id',
            'sanksi_id' => 'required|exists:sanksi,id',
            'deskripsi' => 'required|string'
        ]);

        DB::beginTransaction();
        try {
            $savedCount = 0;
            
            foreach ($request->mahasiswa as $data) {
                // Ambil data mahasiswa untuk memastikan data konsisten
                $mahasiswa = Mahasiswa::where('nim', $data['nim'])->first();
                
                if ($mahasiswa) {
                    MahasiswaBermasalah::create([
                        'nim' => $mahasiswa->nim,
                        'nama' => $mahasiswa->nama ?? $mahasiswa->nama_mahasiswa ?? $mahasiswa->nama_lengkap ?? $data['nama'],
                        'semester' => $mahasiswa->semester_aktif ?? $mahasiswa->semester ?? $data['semester'],
                        'nama_orang_tua' => $mahasiswa->nama_ortu ?? $mahasiswa->nama_orang_tua ?? $data['nama_orang_tua'],
                        'pelanggaran_id' => $request->pelanggaran_id, // SAMA untuk semua mahasiswa
                        'sanksi_id' => $request->sanksi_id, // SAMA untuk semua mahasiswa
                        'deskripsi' => $request->deskripsi // SAMA untuk semua mahasiswa
                    ]);
                } else {
                    // Fallback jika mahasiswa tidak ditemukan di database
                    MahasiswaBermasalah::create([
                        'nim' => $data['nim'],
                        'nama' => $data['nama'],
                        'semester' => $data['semester'],
                        'nama_orang_tua' => $data['nama_orang_tua'],
                        'pelanggaran_id' => $request->pelanggaran_id, // SAMA untuk semua mahasiswa
                        'sanksi_id' => $request->sanksi_id, // SAMA untuk semua mahasiswa
                        'deskripsi' => $request->deskripsi // SAMA untuk semua mahasiswa
                    ]);
                }
                $savedCount++;
            }
            
            DB::commit();
            
            return redirect()->route('admin.mahasiswa-bermasalah.index')
                ->with('success', "Data $savedCount mahasiswa bermasalah berhasil ditambahkan dengan pelanggaran yang sama.");
                
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                         ->withInput();
        }
    }

    public function edit($id)
    {
        $mahasiswaBermasalah = MahasiswaBermasalah::findOrFail($id);
        $pelanggaran = Pelanggaran::all();
        $sanksi = Sanksi::all();
        return view('admin.mahasiswa-bermasalah.edit', compact('mahasiswaBermasalah', 'pelanggaran', 'sanksi'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nim' => 'required|exists:mahasiswas,nim',
            'pelanggaran_id' => 'required|exists:pelanggaran,id',
            'sanksi_id' => 'required|exists:sanksi,id',
            'deskripsi' => 'required'
        ]);

        $mahasiswa = Mahasiswa::where('nim', $request->nim)->first();

        $mahasiswaBermasalah = MahasiswaBermasalah::findOrFail($id);
        $mahasiswaBermasalah->update([
            'nim' => $mahasiswa->nim,
            'nama' => $mahasiswa->nama ?? $mahasiswa->nama_mahasiswa ?? $mahasiswa->nama_lengkap ?? 'Tidak diketahui',
            'semester' => $mahasiswa->semester_aktif ?? $mahasiswa->semester ?? $request->semester ?? 0,
            'nama_orang_tua' => $mahasiswa->nama_ortu ?? $mahasiswa->nama_orang_tua ?? $request->nama_orang_tua ?? 'Tidak diketahui',
            'pelanggaran_id' => $request->pelanggaran_id,
            'sanksi_id' => $request->sanksi_id,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('admin.mahasiswa-bermasalah.index')
            ->with('success', 'Data mahasiswa bermasalah berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $mahasiswaBermasalah = MahasiswaBermasalah::findOrFail($id);
        $mahasiswaBermasalah->delete();

        return redirect()->route('admin.mahasiswa-bermasalah.index')
            ->with('success', 'Data mahasiswa bermasalah berhasil dihapus.');
    }
}