@extends('layouts.admin.app')

@section('title', 'Perbandingan AHP')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">

                <!-- ================= HEADER ================= -->
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-balance-scale"></i>
                        Perbandingan Kriteria AHP
                    </h3>
                </div>

                <!-- ================= BODY ================= -->
                <div class="card-body">

                    @if($kriteria->count() < 2)
                        <div class="alert alert-warning">
                            Minimal diperlukan 2 kriteria
                        </div>
                    @else

                    <form method="POST" action="{{ route('admin.ahp.storePerbandingan') }}">
                        @csrf

                        <div class="table-responsive">
                            <table class="table table-bordered table-hover align-middle">
                                <thead class="thead-light">
                                    <tr>
                                        <th width="5%" class="text-center">#</th>
                                        <th width="30%">Kriteria 1</th>
                                        <th width="30%">Kriteria 2</th>
                                        <th width="25%">Perbandingan</th>
                                    </tr>
                                </thead>

                                <tbody>
                                @php $no = 1; @endphp

                                @foreach($kriteria as $krit1)
                                    @foreach($kriteria as $krit2)
                                        <tr>
                                            <!-- NO -->
                                            <td class="text-center">{{ $no++ }}</td>

                                            <!-- KRITERIA 1 -->
                                            <td>
                                                <strong>{{ $krit1->name }}</strong>
                                            </td>

                                            <!-- KRITERIA 2 (DROPDOWN) -->
                                            <td>
                                                <select name="kriteria2[{{ $krit1->id }}][]"
                                                        class="form-control"
                                                        required>
                                                    <option value="">-- Pilih Kriteria --</option>
                                                    @foreach($kriteria as $opt)
                                                        <option value="{{ $opt->id }}">
                                                            {{ $opt->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </td>

                                            <!-- PERBANDINGAN -->
                                            <td>
                                                <select name="perbandingan[{{ $krit1->id }}][]"
                                                        class="form-control"
                                                        required>
                                                    <option value="">-- Pilih Nilai --</option>
                                                    <option value="1">1 - Sama penting</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3 - Sedikit lebih penting</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5 - Lebih penting</option>
                                                    <option value="6">6</option>
                                                    <option value="7">7 - Sangat lebih penting</option>
                                                    <option value="8">8</option>
                                                    <option value="9">9 - Mutlak lebih penting</option>
                                                </select>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- ================= BUTTON AREA ================= -->
                        <div class="d-flex justify-content-center gap-3 mt-4">

                            <!-- SIMPAN -->
                            <button type="submit" class="btn btn-primary btn-lg px-5">
                                <i class="fas fa-save"></i> Simpan Perbandingan
                            </button>

                            <!-- HITUNG AHP -->
                            <a href="{{ route('admin.ahp.hitung') }}"
                               class="btn btn-success btn-lg px-5">
                                <i class="fas fa-calculator"></i> Hitung AHP
                            </a>

                        </div>

                    </form>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
