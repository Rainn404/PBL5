<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Criterion; // <-- Ganti ini
use App\Models\Comparison; // <-- Ganti ini (jika ada)
use App\Models\Perbandingan; // <-- atau ini jika ada
use Illuminate\Http\Request;

class AhpController extends Controller
{
    /**
     * Form Perbandingan Berpasangan
     */
    public function perbandingan()
    {
        // Coba gunakan Criterion dulu
        $kriteria = Criterion::where('is_active', 1)->orderBy('order')->get();
        
        // Cek apakah ada data perbandingan
        if (class_exists('App\Models\Comparison')) {
            $perbandingan = Comparison::all()->keyBy(function($item) {
                return $item->criterion1_id . '_' . $item->criterion2_id;
            });
        } elseif (class_exists('App\Models\Perbandingan')) {
            $perbandingan = Perbandingan::all()->keyBy(function($item) {
                return $item->kriteria1_id . '_' . $item->kriteria2_id;
            });
        } else {
            $perbandingan = collect();
        }
        
        $totalPasangan = ($kriteria->count() * ($kriteria->count() - 1)) / 2;
        $terisi = count($perbandingan) / 2;
        $progress = $totalPasangan > 0 ? ($terisi / $totalPasangan) * 100 : 0;
        
        return view('admin.ahp.perbandingan', compact(
            'kriteria', 'perbandingan', 'totalPasangan', 'terisi', 'progress'
        ));
    }
    
    /**
     * Simpan Perbandingan
     */
    public function storePerbandingan(Request $request)
    {
        $kriteria = Criterion::where('is_active', 1)->get();
        
        $request->validate([
            'perbandingan.*' => 'required|numeric|min:1|max:9'
        ]);
        
        \DB::beginTransaction();
        try {
            // Hapus yang lama
            if (class_exists('App\Models\Comparison')) {
                Comparison::truncate();
                $model = 'Comparison';
            } elseif (class_exists('App\Models\Perbandingan')) {
                Perbandingan::truncate();
                $model = 'Perbandingan';
            } else {
                return redirect()->back()
                    ->with('error', 'Model perbandingan tidak ditemukan!');
            }
            
            $data = $request->perbandingan;
            
            foreach ($kriteria as $i => $krit1) {
                foreach ($kriteria as $j => $krit2) {
                    if ($i < $j) {
                        $key = $krit1->id . '_' . $krit2->id;
                        if (isset($data[$key])) {
                            $nilai = $data[$key];
                            
                            if ($model == 'Comparison') {
                                // Simpan Comparison
                                Comparison::create([
                                    'criterion1_id' => $krit1->id,
                                    'criterion2_id' => $krit2->id,
                                    'value' => $nilai
                                ]);
                                
                                Comparison::create([
                                    'criterion1_id' => $krit2->id,
                                    'criterion2_id' => $krit1->id,
                                    'value' => 1 / $nilai
                                ]);
                            } else {
                                // Simpan Perbandingan
                                Perbandingan::create([
                                    'kriteria1_id' => $krit1->id,
                                    'kriteria2_id' => $krit2->id,
                                    'nilai' => $nilai
                                ]);
                                
                                Perbandingan::create([
                                    'kriteria1_id' => $krit2->id,
                                    'kriteria2_id' => $krit1->id,
                                    'nilai' => 1 / $nilai
                                ]);
                            }
                        }
                    }
                }
            }
            
            \DB::commit();
            return redirect()->route('admin.ahp.perbandingan')
                ->with('success', 'Perbandingan berhasil disimpan!');
                
        } catch (\Exception $e) {
            \DB::rollBack();
            return redirect()->back()
                ->with('error', 'Gagal menyimpan perbandingan: ' . $e->getMessage());
        }
    }
    
    /**
     * Dashboard AHP
     */
    public function index()
    {
        return view('admin.ahp.index');
    }
    
    /**
     * Form Hitung AHP
     */
    public function hitung()
    {
        $kriteria = Criterion::where('is_active', 1)->get();
        
        // Cek apakah ada data perbandingan
        if (class_exists('App\Models\Comparison')) {
            $perbandingan = Comparison::count();
        } elseif (class_exists('App\Models\Perbandingan')) {
            $perbandingan = Perbandingan::count();
        } else {
            $perbandingan = 0;
        }
        
        if ($perbandingan == 0) {
            return redirect()->route('admin.ahp.perbandingan')
                ->with('error', 'Silakan isi perbandingan terlebih dahulu!');
        }
        
        return view('admin.ahp.hitung', compact('kriteria'));
    }
    
    /**
     * Proses Hitung AHP
     */
    public function prosesHitung(Request $request)
    {
        // Implementasi nanti
        return redirect()->route('admin.ahp.hasil')
            ->with('success', 'Perhitungan AHP berhasil!');
    }
    
    /**
     * Hasil Perhitungan
     */
    public function hasil()
    {
        return view('admin.ahp.hasil');
    }
    
    /**
     * Ranking
     */
    public function ranking()
    {
        return view('admin.ahp.ranking');
    }
    
    /**
     * Subkriteria
     */
    public function subkriteria()
    {
        $kriteria = Criterion::with('subcriteria')->get();
        return view('admin.ahp.subkriteria', compact('kriteria'));
    }
}