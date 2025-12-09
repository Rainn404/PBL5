@extends('layouts.admin.app')

@section('title', 'Export Data Mahasiswa')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-download mr-2"></i>Export Data Mahasiswa
                    </h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.mahasiswa.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="card border-info">
                                <div class="card-header bg-info text-white">
                                    <h5 class="mb-0"><i class="fas fa-filter"></i> Filter & Export Data</h5>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('admin.mahasiswa.export') }}" method="GET">
                                        <div class="form-group">
                                            <label for="status">Filter berdasarkan Status</label>
                                            <select class="form-control" id="status" name="status">
                                                <option value="">Semua Status</option>
                                                <option value="Aktif" {{ request('status') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                                                <option value="Non-Aktif" {{ request('status') == 'Non-Aktif' ? 'selected' : '' }}>Non-Aktif</option>
                                                <option value="Cuti" {{ request('status') == 'Cuti' ? 'selected' : '' }}>Cuti</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <small class="form-text text-muted">
                                                Pilih status untuk memfilter data yang akan diekspor. Kosongkan untuk mengekspor semua data.
                                            </small>
                                        </div>

                                        <button type="submit" class="btn btn-info btn-lg">
                                            <i class="fas fa-download"></i> Export Data Excel
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card border-warning">
                                <div class="card-header bg-warning text-white">
                                    <h5 class="mb-0"><i class="fas fa-info-circle"></i> Informasi</h5>
                                </div>
                                <div class="card-body">
                                    <h6>Kolom yang akan diekspor:</h6>
                                    <ul class="mb-3">
                                        <li>NIM</li>
                                        <li>Nama Mahasiswa</li>
                                        <li>Status</li>
                                        <li>Tanggal Dibuat</li>
                                        <li>Tanggal Diperbarui</li>
                                    </ul>

                                    <h6>Format file:</h6>
                                    <p class="mb-0">Microsoft Excel (.xlsx)</p>
                                </div>
                            </div>

                            <div class="card border-primary mt-3">
                                <div class="card-header bg-primary text-white">
                                    <h5 class="mb-0"><i class="fas fa-download"></i> Template Import</h5>
                                </div>
                                <div class="card-body text-center">
                                    <p class="mb-2">Download template untuk import data</p>
                                    <a href="{{ route('admin.mahasiswa.template') }}" class="btn btn-primary btn-sm">
                                        <i class="fas fa-download"></i> Download Template
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    // Form submission with loading
    $('form').submit(function() {
        var submitBtn = $(this).find('button[type="submit"]');
        var originalText = submitBtn.html();

        submitBtn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Menyiapkan file...');

        // Re-enable button after 10 seconds as fallback
        setTimeout(function() {
            submitBtn.prop('disabled', false).html(originalText);
        }, 10000);
    });
});
</script>
@endsection
