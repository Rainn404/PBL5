<!-- resources/views/admin/ahp/hitung.blade.php -->
@extends('layouts.admin.app')

@section('title', 'Hitung AHP')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-calculator mr-1"></i>
                        Hitung Bobot AHP
                    </h3>
                </div>
                <div class="card-body text-center">
                    <div class="alert alert-info">
                        <h4><i class="icon fas fa-info"></i> Fitur Sedang Dalam Pengembangan</h4>
                        <p>Fitur perhitungan AHP akan segera tersedia.</p>
                    </div>
                    
                    <a href="{{ route('admin.ahp.perbandingan') }}" class="btn btn-primary">
                        <i class="fas fa-arrow-left"></i> Kembali ke Perbandingan
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection