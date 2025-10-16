<?php

namespace App\Imports;

use App\Models\Mahasiswa;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Illuminate\Validation\Rule;

class MahasiswaImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnError
{
    use SkipsErrors;

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // Cek apakah NIM sudah ada, jika ya update, jika tidak create
        $mahasiswa = Mahasiswa::where('nim', $row['nim'])->first();

        if ($mahasiswa) {
            // Update data yang sudah ada
            $mahasiswa->update([
                'nama' => $row['nama'],
                'email' => $row['email'] ?? $mahasiswa->email,
                'prodi' => $row['prodi'] ?? $mahasiswa->prodi,
                'angkatan' => $row['angkatan'] ?? $mahasiswa->angkatan,
                'no_hp' => $row['no_hp'] ?? $mahasiswa->no_hp,
                'alamat' => $row['alamat'] ?? $mahasiswa->alamat,
                'status' => $row['status'] ?? $mahasiswa->status,
            ]);
            return null;
        }

        // Create data baru
        return new Mahasiswa([
            'nim' => $row['nim'],
            'nama' => $row['nama'],
            'email' => $row['email'] ?? null,
            'prodi' => $row['prodi'] ?? null,
            'angkatan' => $row['angkatan'] ?? null,
            'no_hp' => $row['no_hp'] ?? null,
            'alamat' => $row['alamat'] ?? null,
            'status' => $row['status'] ?? 'Aktif',
        ]);
    }

    public function rules(): array
    {
        return [
            'nim' => [
                'required',
                'string',
                'max:20',
            ],
            'nama' => [
                'required',
                'string',
                'max:255'
            ],
            'email' => [
                'nullable',
                'email',
                'max:255'
            ],
            'prodi' => [
                'nullable',
                'string',
                'max:100'
            ],
            'angkatan' => [
                'nullable',
                'string',
                'max:4'
            ],
            'no_hp' => [
                'nullable',
                'string',
                'max:15'
            ],
            'alamat' => [
                'nullable',
                'string'
            ],
            'status' => [
                'nullable',
                Rule::in(['Aktif', 'Non-Aktif', 'Cuti'])
            ]
        ];
    }

    public function customValidationMessages()
    {
        return [
            'nim.required' => 'NIM wajib diisi',
            'nim.unique' => 'NIM :input sudah terdaftar',
            'nama.required' => 'Nama wajib diisi',
            'email.email' => 'Format email tidak valid',
            'status.in' => 'Status harus berupa: Aktif, Non-Aktif, atau Cuti',
        ];
    }
}