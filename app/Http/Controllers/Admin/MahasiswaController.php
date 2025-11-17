<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use App\Exports\MahasiswaExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    // ... method lainnya ...

    public function export(Request $request)
    {
        $status = $request->get('status');
        $filename = 'data_mahasiswa_' . date('Y_m_d_His') . '.xlsx';

        return Excel::download(new MahasiswaExport($status), $filename);
    }

    public function exportView()
    {
        return view('admin.mahasiswa.export');
    }
}