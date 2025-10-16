<?php

namespace App\Exports;

use App\Models\Mahasiswa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class MahasiswaExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    protected $isTemplate;

    public function __construct($isTemplate = false)
    {
        $this->isTemplate = $isTemplate;
    }

    public function collection()
    {
        if ($this->isTemplate) {
            // Return collection kosong untuk template
            return collect([
                [
                    'nim' => '12345678',
                    'nama' => 'Contoh Mahasiswa',
                    'email' => 'contoh@email.com',
                    'prodi' => 'Teknik Informatika',
                    'angkatan' => '2023',
                    'no_hp' => '081234567890',
                    'alamat' => 'Alamat contoh',
                    'status' => 'Aktif'
                ]
            ]);
        }
        
        return Mahasiswa::all();
    }

    public function headings(): array
    {
        return [
            'NIM',
            'Nama Lengkap',
            'Email', 
            'Program Studi',
            'Angkatan',
            'No HP',
            'Alamat',
            'Status'
        ];
    }

    public function map($mahasiswa): array
    {
        return [
            $mahasiswa->nim,
            $mahasiswa->nama,
            $mahasiswa->email ?? '',
            $mahasiswa->prodi ?? '',
            $mahasiswa->angkatan ?? '',
            $mahasiswa->no_hp ?? '',
            $mahasiswa->alamat ?? '',
            $mahasiswa->status
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style untuk header
            1 => [
                'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
                'fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '4361EE']]
            ],
        ];
    }
}