<?php

namespace App\Exports;

use App\Models\Mahasiswa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class MahasiswaExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithTitle
{
    protected $status;

    public function __construct($status = null)
    {
        $this->status = $status;
    }

    public function collection()
    {
        $query = Mahasiswa::query();
        
        if ($this->status) {
            $query->where('status', $this->status);
        }
        
        return $query->orderBy('nim')->get();
    }

    public function headings(): array
    {
        return [
            'NIM',
            'NAMA MAHASISWA',
            'STATUS',
            'TANGGAL DIBUAT',
            'TANGGAL DIPERBARUI'
        ];
    }

    public function map($mahasiswa): array
    {
        return [
            $mahasiswa->nim,
            $mahasiswa->nama,
            $mahasiswa->status,
            $mahasiswa->created_at->format('d/m/Y H:i'),
            $mahasiswa->updated_at->format('d/m/Y H:i'),
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style untuk header
            1 => [
                'font' => [
                    'bold' => true,
                    'color' => ['rgb' => 'FFFFFF']
                ],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '4e73df']
                ]
            ],
            
            // Style untuk seluruh tabel
            'A:E' => [
                'alignment' => [
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                ]
            ],
            
            // Auto size columns
            'A' => ['width' => 15],
            'B' => ['width' => 30],
            'C' => ['width' => 12],
            'D' => ['width' => 18],
            'E' => ['width' => 18],
        ];
    }

    public function title(): string
    {
        return 'DATA_MAHASISWA';
    }
}