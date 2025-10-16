
<!-- resources/views/admin/mahasiswa/index.blade.php -->
@extends('layouts.admin.app')

@section('title', 'Data Mahasiswa - Admin')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Daftar Mahasiswa</h1>
        <a href="{{ route('admin.mahasiswa.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Mahasiswa
        </a>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3" style="background-color: #e6f2ff;">
                    <h6 class="m-0 font-weight-bold text-center" style="color: #1a73e8;">Data Mahasiswa Teknologi Informasi</h6>
                </div>
                <div class="card-body">
                    <!-- Search Form -->
                    <form method="GET" action="{{ route('admin.mahasiswa.index') }}" class="mb-4">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control" placeholder="Cari mahasiswa..." value="{{ $search ?? '' }}">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn" style="background-color: #1a73e8; color: white;">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                    <!-- Table -->
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr style="background-color: #e6f2ff;">
                                    <th class="text-center align-middle" style="width: 20%; color: #1a73e8;">NIM</th>
                                    <th class="text-center align-middle" style="width: 35%; color: #1a73e8;">Nama</th>
                                    <th class="text-center align-middle" style="width: 20%; color: #1a73e8;">Status</th>
                                    <th class="text-center align-middle" style="width: 25%; color: #1a73e8;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($mahasiswas as $mahasiswa)
                                <tr>
                                    <td class="text-center align-middle">
                                        <strong>{{ $mahasiswa->nim }}</strong>
                                    </td>
                                    <td class="align-middle">
                                        <strong>{{ $mahasiswa->nama }}</strong>
                                    </td>
                                    <td class="text-center align-middle">
                                        @if($mahasiswa->status == 'Aktif')
                                            <span class="badge px-3 py-2" style="background-color: #e6f4ea; color: #137333; border: 1px solid #34a853;">
                                                <strong>{{ $mahasiswa->status }}</strong>
                                            </span>
                                        @elseif($mahasiswa->status == 'Tidak Aktif')
                                            <span class="badge px-3 py-2" style="background-color: #fce8e6; color: #c5221f; border: 1px solid #ea4335;">
                                                <strong>{{ $mahasiswa->status }}</strong>
                                            </span>
                                        @else
                                            <span class="badge px-3 py-2" style="background-color: #fef7e0; color: #b06000; border: 1px solid #fbbc04;">
                                                <strong>{{ $mahasiswa->status }}</strong>
                                            </span>
                                        @endif
                                    </td>
                                    <td class="text-center align-middle">
                                        <div class="btn-group btn-group-sm">
                                            <a href="{{ route('admin.mahasiswa.edit', $mahasiswa) }}" class="btn btn-warning btn-icon" title="Edit" style="background-color: #fdd663; border-color: #fdd663;">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.mahasiswa.destroy', $mahasiswa) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-icon" title="Hapus" style="background-color: #f28b82; border-color: #f28b82;" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
>>>>>>> 1d52fc143bace73a1e89abde13fde41160ae60a8
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>

                                    <td colspan="4" class="text-center py-4">
                                        <i class="fas fa-users text-3xl text-gray-300 mb-2 d-block"></i>
                                        Tidak ada data mahasiswa

                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->

                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mt-4 pt-3 border-top">
                        <!-- Info Hasil -->
                        <div class="mb-3 mb-md-0">
                            <p class="mb-0 text-muted small">
                                Menampilkan 
                                <span class="font-weight-bold text-dark">{{ $mahasiswas->firstItem() ?? 0 }}</span> 
                                - 
                                <span class="font-weight-bold text-dark">{{ $mahasiswas->lastItem() ?? 0 }}</span> 
                                dari 
                                <span class="font-weight-bold text-dark">{{ $mahasiswas->total() }}</span> 
                                hasil
                            </p>
                        </div>
                        
                        <!-- Pagination Links -->
                        <div class="d-flex align-items-center">
                            <nav aria-label="Page navigation">
                                <ul class="pagination pagination-sm mb-0">
                                    <!-- Previous Page Link -->
                                    @if ($mahasiswas->onFirstPage())
                                        <li class="page-item disabled">
                                            <span class="page-link border-0">
                                                <i class="fas fa-chevron-left fa-xs mr-1"></i> Previous
                                            </span>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link border-0 text-primary" href="{{ $mahasiswas->previousPageUrl() }}" aria-label="Previous">
                                                <i class="fas fa-chevron-left fa-xs mr-1"></i> Previous
                                            </a>
                                        </li>
                                    @endif

                                    <!-- Page Numbers -->
                                    @foreach ($mahasiswas->getUrlRange(1, $mahasiswas->lastPage()) as $page => $url)
                                        @if ($page == $mahasiswas->currentPage())
                                            <li class="page-item active">
                                                <span class="page-link border-0" style="background-color: #1a73e8; border-color: #1a73e8;">
                                                    {{ $page }}
                                                </span>
                                            </li>
                                        @else
                                            <li class="page-item">
                                                <a class="page-link border-0 text-primary" href="{{ $url }}">
                                                    {{ $page }}
                                                </a>
                                            </li>
                                        @endif
                                    @endforeach

                                    <!-- Next Page Link -->
                                    @if ($mahasiswas->hasMorePages())
                                        <li class="page-item">
                                            <a class="page-link border-0 text-primary" href="{{ $mahasiswas->nextPageUrl() }}" aria-label="Next">
                                                Next <i class="fas fa-chevron-right fa-xs ml-1"></i>
                                            </a>
                                        </li>
                                    @else
                                        <li class="page-item disabled">
                                            <span class="page-link border-0">
                                                Next <i class="fas fa-chevron-right fa-xs ml-1"></i>
                                            </span>
                                        </li>
                                    @endif
                                </ul>
                            </nav>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<style>
.card-header {
    background-color: #e6f2ff !important;
}

.table thead th {
    background-color: #e6f2ff !important;
    border: none;
    font-weight: 700;
    font-size: 0.9rem;
    padding: 12px 8px;
    color: #1a73e8;
}

.table tbody td {
    padding: 12px 8px;
    vertical-align: middle;
}

.badge {
    border: 1px solid;
    font-weight: 600;
}

.btn-icon {
    width: 35px;
    height: 35px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: 4px;
    margin: 0 2px;
}

.btn-warning {
    background-color: #fdd663;
    border-color: #fdd663;
    color: #fff;
}

.btn-warning:hover {
    background-color: #fcc72a;
    border-color: #fcc72a;
    color: #fff;
}

.btn-danger {
    background-color: #f28b82;
    border-color: #f28b82;
    color: #fff;
}

.btn-danger:hover {
    background-color: #ee675c;
    border-color: #ee675c;
    color: #fff;
}

.table-bordered {
    border: 1px solid #e3e6f0;
}

.table-bordered thead th {
    border: none;
}

.table-bordered tbody td {
    border: 1px solid #e3e6f0;
}

/* Hover effect for table rows */
.table tbody tr:hover {
    background-color: #f8f9fc;
}

.btn-primary {
    background-color: #1a73e8;
    border-color: #1a73e8;
}

.btn-primary:hover {
    background-color: #0d62d9;
    border-color: #0d62d9;
}

/* Pagination Styles */
.pagination {
    margin-bottom: 0;
}

.page-link {
    padding: 0.4rem 0.75rem;
    font-size: 0.875rem;
    color: #1a73e8;
    background-color: transparent;
    border: 1px solid transparent;
    margin: 0 2px;
    border-radius: 4px;
}

.page-link:hover {
    background-color: #f8f9fa;
    border-color: #dee2e6;
    color: #0d62d9;
}

.page-item.active .page-link {
    background-color: #1a73e8;
    border-color: #1a73e8;
    color: white;
}

.page-item.disabled .page-link {
    color: #6c757d;
    background-color: transparent;
    border-color: transparent;
}

.border-top {
    border-top: 1px solid #e3e6f0 !important;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .btn-icon {
        width: 30px;
        height: 30px;
        margin: 0 1px;
    }
    
    .table thead th {
        font-size: 0.8rem;
        padding: 8px 4px;
    }
    
    .table tbody td {
        padding: 8px 4px;
        font-size: 0.9rem;
    }
    
    .badge {
        padding: 4px 8px;
        font-size: 0.8rem;
    }
    
    .pagination {
        flex-wrap: wrap;
        justify-content: center;
    }
    
    .page-link {
        padding: 0.3rem 0.6rem;
        font-size: 0.8rem;
        margin: 1px;
    }
    
    .d-flex.flex-column.flex-md-row {
        text-align: center;
    }
    
    .mb-3.mb-md-0 {
        margin-bottom: 1rem !important;
    }
}

@media (max-width: 576px) {
    .pagination {
        font-size: 0.8rem;
    }
    
    .page-link {
        padding: 0.25rem 0.5rem;
        margin: 0 1px;
    }
    
    .text-muted.small {
        font-size: 0.8rem;
    }
}
</style>
@endsection

