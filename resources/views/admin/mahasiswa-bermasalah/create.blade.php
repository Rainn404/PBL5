@extends('layouts.admin.app')

@section('title', 'Tambah Mahasiswa Bermasalah')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Mahasiswa Bermasalah</h1>
        <a href="{{ route('admin.mahasiswa-bermasalah.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Form Tambah Mahasiswa Bermasalah</h6>
            <small class="text-muted">Anda dapat menambahkan beberapa mahasiswa sekaligus untuk pelanggaran yang sama</small>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.mahasiswa-bermasalah.store-multiple') }}" method="POST" id="multipleMahasiswaForm">
                @csrf

                <!-- Data Mahasiswa (Bisa Multiple) -->
                <div class="mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="text-primary mb-0">
                            <i class="fas fa-users me-2"></i>Data Mahasiswa
                        </h5>
                        <span class="badge bg-info text-white" id="mahasiswa-counter">1 Mahasiswa</span>
                    </div>

                    <div class="alert alert-info mb-3">
                        <i class="fas fa-info-circle me-2"></i>
                        <small>Masukkan NIM mahasiswa dan sistem akan otomatis mengisi data lainnya. Klik tombol <i class="fas fa-plus text-success"></i> untuk menambah mahasiswa lainnya.</small>
                    </div>

                    <div id="mahasiswa-container">
                        <!-- Item pertama -->
                        <div class="mahasiswa-item card mb-3 border-primary">
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label fw-bold">NIM <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-light">
                                                    <i class="fas fa-id-card text-primary"></i>
                                                </span>
                                                <input type="text" name="mahasiswa[0][nim]"
                                                       class="form-control nim-input"
                                                       placeholder="Contoh: 123456789"
                                                       required
                                                       autocomplete="off">
                                                <button type="button" class="btn btn-outline-success btn-add-mahasiswa">
                                                    <i class="fas fa-plus"></i>
                                                </button>
                                            </div>
                                            <div class="mt-2">
                                                <small class="nim-status text-muted">Masukkan 9-10 digit NIM</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label class="form-label fw-bold">Nama Lengkap <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-light">
                                                    <i class="fas fa-user text-primary"></i>
                                                </span>
                                                <input type="text" name="mahasiswa[0][nama]"
                                                       class="form-control nama-input"
                                                       placeholder="Akan terisi otomatis"
                                                       readonly
                                                       required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="form-label fw-bold">Semester <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-light">
                                                    <i class="fas fa-graduation-cap text-primary"></i>
                                                </span>
                                                <input type="number" name="mahasiswa[0][semester]"
                                                       class="form-control semester-input"
                                                       min="1" max="14"
                                                       placeholder="1-14"
                                                       required>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label fw-bold">Nama Orang Tua (Opsional)</label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-light">
                                                    <i class="fas fa-users text-primary"></i>
                                                </span>
                                                      <input type="text" name="mahasiswa[0][nama_orang_tua]" 
                                                          class="form-control orangtua-input" 
                                                          placeholder="Masukkan nama orang tua (Opsional)">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row mt-2">
                                    <div class="col-12">
                                        <div class="mahasiswa-info bg-light p-2 rounded d-none">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <small class="text-muted">
                                                        <i class="fas fa-university me-1"></i>
                                                        <span class="prodi-info">-</span>
                                                    </small>
                                                </div>
                                                <div class="col-md-6">
                                                    <small class="text-muted">
                                                        <i class="fas fa-calendar me-1"></i>
                                                        Angkatan: <span class="angkatan-info">-</span>
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Data Pelanggaran (Hanya Satu untuk Semua) -->
                <div class="mb-4">
                    <h5 class="text-primary mb-3">
                        <i class="fas fa-exclamation-triangle me-2"></i>Data Pelanggaran & Sanksi
                    </h5>
                    
                    <div class="card border-warning">
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label fw-bold">Jenis Pelanggaran <span class="text-danger">*</span></label>
                                        <select name="pelanggaran_id" id="pelanggaran-select" class="form-control form-control-lg select-pelanggaran" required>
                                            <option value="">-- Pilih Pelanggaran --</option>
                                            @foreach ($pelanggaran as $p)
                                                <option value="{{ $p->id }}" {{ old('pelanggaran_id') == $p->id ? 'selected' : '' }}>
                                                    [{{ $p->kode_pelanggaran ?? 'P' . $p->id }}] {{ $p->nama_pelanggaran }}
                                                    @if($p->jenis_pelanggaran)
                                                        ({{ ucfirst($p->jenis_pelanggaran) }})
                                                    @endif
                                                </option>
                                            @endforeach
                                        </select>
                                        <small class="text-muted">Pilih jenis pelanggaran yang dilakukan</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label fw-bold">Sanksi <span class="text-danger">*</span></label>
                                        <select name="sanksi_id" id="sanksi-select" class="form-control form-control-lg select-sanksi" required>
                                            <option value="">-- Pilih Sanksi --</option>
                                            @foreach ($sanksi as $s)
                                                <option value="{{ $s->id }}" {{ old('sanksi_id') == $s->id ? 'selected' : '' }}>
                                                    [{{ $s->id_sanksi }}] {{ $s->nama_sanksi }}
                                                    @if($s->jenis_sanksi)
                                                        ({{ ucfirst($s->jenis_sanksi) }})
                                                    @endif
                                                </option>
                                            @endforeach
                                        </select>
                                        <small class="text-muted">Sanksi yang akan diberikan</small>
                                    </div>
                                </div>
                                
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-label fw-bold">Deskripsi Pelanggaran <small class="text-muted">(opsional)</small></label>
                                        <textarea name="deskripsi" class="form-control form-control-lg" rows="4"
                                                  placeholder="Jelaskan secara detail mengenai pelanggaran yang dilakukan...">{{ old('deskripsi') }}</textarea>
                                        <small class="text-muted">Minimal 20 karakter. Jelaskan kronologi, tempat, dan waktu kejadian.</small>
                                    </div>
                                </div>
                                
                                <div class="col-12">
                                    <div class="alert alert-warning mb-0">
                                        <i class="fas fa-exclamation-triangle me-2"></i>
                                        <small>Data pelanggaran ini akan berlaku untuk semua mahasiswa di atas. Pastikan semua mahasiswa terlibat dalam pelanggaran yang sama.</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center mt-4 pt-3 border-top">
                    <a href="{{ route('admin.mahasiswa-bermasalah.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Kembali
                    </a>
                    <button type="submit" class="btn btn-success btn-lg px-4">
                        <i class="fas fa-save me-2"></i>Simpan Semua Data
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
/* Basic styling */
.card {
    border: 1px solid #e3e6f0;
    border-radius: 0.5rem;
}

.card-body {
    padding: 1.5rem;
}

.form-control-lg {
    height: 48px;
    padding: 0.75rem 1rem;
    font-size: 1rem;
}

.form-group {
    margin-bottom: 1.5rem;
}

/* Custom select styling untuk dropdown yang lebih baik */
.select-pelanggaran, .select-sanksi {
    appearance: none;
    -webkit-appearance: none;
    -moz-appearance: none;
    background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
    background-repeat: no-repeat;
    background-position: right 1rem center;
    background-size: 1em;
    padding-right: 2.5rem;
    cursor: pointer;
}

/* Hover dan focus states */
.select-pelanggaran:hover, .select-sanksi:hover {
    border-color: #4e73df;
}

.select-pelanggaran:focus, .select-sanksi:focus {
    border-color: #4e73df;
    box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
    outline: none;
}

/* Mahasiswa items */
.mahasiswa-item {
    border-left: 4px solid #4e73df !important;
    margin-bottom: 1rem;
}

.mahasiswa-item:not(:first-child) {
    border-left: 4px solid #1cc88a !important;
}

/* Button styling */
.btn-add-mahasiswa:hover {
    background-color: #1cc88a;
    color: white;
}

.btn-remove-mahasiswa:hover {
    background-color: #e74a3b;
    color: white;
}

/* Input groups */
.input-group-text {
    background-color: #f8f9fc;
    border: 1px solid #e3e6f0;
    color: #6e707e;
}

/* Loading spinner */
.loading-spinner {
    display: inline-block;
    width: 16px;
    height: 16px;
    border: 2px solid #f3f3f3;
    border-top: 2px solid #3498db;
    border-radius: 50%;
    animation: spin 1s linear infinite;
    margin-right: 8px;
    vertical-align: middle;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

/* Responsive */
@media (max-width: 768px) {
    .container-fluid {
        padding-left: 1rem;
        padding-right: 1rem;
    }
    
    .card-body {
        padding: 1rem;
    }
    
    .col-md-4, .col-md-5, .col-md-3, .col-md-6 {
        margin-bottom: 1rem;
    }
}
</style>

<!-- LOAD JQUERY DENGAN BENAR -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
// Periksa apakah jQuery sudah dimuat
console.log('jQuery version:', $.fn.jquery);

// Fungsi untuk memeriksa apakah Select2 tersedia
function isSelect2Loaded() {
    return typeof $.fn.select2 !== 'undefined';
}

// Fungsi untuk memuat Select2 secara dinamis jika belum dimuat
function loadSelect2(callback) {
    if (isSelect2Loaded()) {
        console.log('Select2 sudah dimuat');
        if (callback) callback();
        return;
    }
    
    console.log('Memuat Select2...');
    
    // Load CSS
    var cssLink = document.createElement('link');
    cssLink.rel = 'stylesheet';
    cssLink.href = 'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css';
    document.head.appendChild(cssLink);
    
    // Load JS
    var script = document.createElement('script');
    script.src = 'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js';
    script.onload = function() {
        console.log('Select2 berhasil dimuat');
        if (callback) callback();
    };
    script.onerror = function() {
        console.error('Gagal memuat Select2');
        // Fallback ke select biasa
        enableEnhancedSelects();
    };
    document.head.appendChild(script);
}

// Fallback function jika Select2 tidak bisa dimuat
function enableEnhancedSelects() {
    console.log('Menggunakan select biasa dengan styling tambahan');
    
    // Tambahkan styling tambahan untuk select
    $('.select-pelanggaran, .select-sanksi').each(function() {
        $(this).addClass('enhanced-select');
    });
    
    // Pastikan select bisa diklik
    $('.select-pelanggaran, .select-sanksi').on('mousedown', function(e) {
        console.log('Select diklik:', this.id);
        // Biarkan event default berjalan
    });
}

// Inisialisasi form
$(document).ready(function() {
    console.log('Document ready - initializing form...');
    
    // Coba muat Select2
    loadSelect2(function() {
        if (isSelect2Loaded()) {
            initializeSelect2();
        } else {
            enableEnhancedSelects();
        }
    });
    
    // ========== MAHASISWA FUNCTIONS ==========
    let mahasiswaCount = 1;
    let searchTimeout = null;
    
    // Update counter
    function updateCounter() {
        const count = $('.mahasiswa-item').length;
        $('#mahasiswa-counter').text(`${count} Mahasiswa${count > 1 ? ' (Banyak)' : ''}`);
    }
    
    // Function to search student by NIM
    function searchStudentByNIM(nimInput, card) {
        const nim = nimInput.val().trim();
        
        if (nim.length < 9 || nim.length > 10) {
            card.find('.nim-status').removeClass('text-success text-danger').addClass('text-muted')
                .html(`<i class="fas fa-info-circle me-1"></i>Masukkan 9-10 digit NIM`);
            card.find('.mahasiswa-info').addClass('d-none');
            card.find('.nama-input').val('');
            return;
        }
        
        // Show loading
        card.find('.nim-status').removeClass('text-success text-danger').addClass('text-info')
            .html(`<span class="loading-spinner"></span> Mencari data...`);
        card.find('.nama-input').val('Mencari...');
        
        // Clear previous timeout
        if (searchTimeout) {
            clearTimeout(searchTimeout);
        }
        
        // Debounce search
        searchTimeout = setTimeout(function() {
            $.ajax({
                url: `/admin/mahasiswa-bermasalah/get-mahasiswa/${nim}`,
                method: 'GET',
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    console.log('Search response:', data);

                    // Support two response shapes:
                    // 1) { success: true, mahasiswa: { nama, semester, ... } }
                    // 2) { success: true, nama: '...', semester: '...', ... }
                    if (data && data.success) {
                        const mhs = data.mahasiswa ? data.mahasiswa : data;

                        // Fill name if available
                        if (mhs.nama) {
                            card.find('.nama-input').val(mhs.nama);
                        }

                        // Auto-fill semester if available
                        if (mhs.semester) {
                            card.find('.semester-input').val(mhs.semester);
                        }

                        // Auto-fill nama orang tua if available
                        if (mhs.nama_orang_tua) {
                            card.find('.orangtua-input').val(mhs.nama_orang_tua);
                        }

                        // Update additional info
                        card.find('.prodi-info').text(mhs.prodi || mhs.jurusan || 'Tidak diketahui');
                        card.find('.angkatan-info').text(mhs.angkatan || 'Tidak diketahui');
                        card.find('.mahasiswa-info').removeClass('d-none');

                        card.find('.nim-status').removeClass('text-info text-danger').addClass('text-success')
                            .html(`<i class="fas fa-check-circle me-1"></i>${mhs.nama || 'Ditemukan'}`);

                        // Auto-focus next empty field
                        if (!card.find('.semester-input').val()) {
                            setTimeout(() => card.find('.semester-input').focus(), 100);
                        }
                    } else {
                        card.find('.nama-input').val('');
                        card.find('.mahasiswa-info').addClass('d-none');
                        card.find('.nim-status').removeClass('text-info text-success').addClass('text-danger')
                            .html(`<i class="fas fa-exclamation-circle me-1"></i>${(data && (data.message || data.error)) || 'Mahasiswa tidak ditemukan'}`);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Search error:', error);
                    card.find('.nama-input').val('');
                    card.find('.mahasiswa-info').addClass('d-none');
                    card.find('.nim-status').removeClass('text-info text-success').addClass('text-danger')
                        .html(`<i class="fas fa-exclamation-circle me-1"></i>Gagal mencari data`);
                }
            });
        }, 500);
    }
    
    // Setup NIM auto-search
    function setupNIMSearch(nimInput) {
        const card = nimInput.closest('.mahasiswa-item');
        
        // Search on input change
        nimInput.off('input').on('input', function() {
            searchStudentByNIM($(this), $(card));
        });
        
        // Search on paste
        nimInput.off('paste').on('paste', function() {
            setTimeout(() => {
                searchStudentByNIM($(this), $(card));
            }, 100);
        });
    }
    
    // Setup for first NIM input
    setupNIMSearch($('.nim-input').first());
    
    // Add new student
    $(document).on('click', '.btn-add-mahasiswa', function() {
        const lastItem = $('.mahasiswa-item').last();
        const newIndex = mahasiswaCount++;
        
        // Clone item
        const newItem = lastItem.clone();
        
        // Reset values
        newItem.find('input').val('');
        newItem.find('.nim-status').removeClass('text-success text-danger').addClass('text-muted')
            .html('<i class="fas fa-info-circle me-1"></i>Masukkan 9-10 digit NIM');
        newItem.find('.mahasiswa-info').addClass('d-none');
        newItem.find('.prodi-info').text('-');
        newItem.find('.angkatan-info').text('-');
        
        // Update names with new index
        newItem.find('[name]').each(function() {
            const name = $(this).attr('name').replace(/\[\d+\]/, `[${newIndex}]`);
            $(this).attr('name', name);
        });
        
        // Update card border color
        newItem.removeClass('border-primary').addClass('border-success');
        
        // Update buttons
        newItem.find('.btn-add-mahasiswa')
            .removeClass('btn-outline-success')
            .addClass('btn-outline-danger')
            .html('<i class="fas fa-trash"></i>')
            .removeClass('btn-add-mahasiswa')
            .addClass('btn-remove-mahasiswa');
        
        // Setup NIM search for new input
        const newNimInput = newItem.find('.nim-input');
        setupNIMSearch(newNimInput);
        
        // Add to container
        $('#mahasiswa-container').append(newItem);
        
        // Focus on new NIM input
        newNimInput.focus();
        
        updateCounter();
        updateButtonStates();
    });
    
    // Remove student with confirmation
    $(document).on('click', '.btn-remove-mahasiswa', function() {
        const $btn = $(this);
        const total = $('.mahasiswa-item').length;

        if (total <= 1) {
            // Never remove the last item
            return;
        }

        Swal.fire({
            title: 'Hapus Mahasiswa?',
            text: 'Baris mahasiswa ini akan dihapus. Lanjutkan?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Batal',
            confirmButtonColor: '#e74a3b',
            cancelButtonColor: '#6c757d'
        }).then((result) => {
            if (result.isConfirmed) {
                $btn.closest('.mahasiswa-item').remove();
                reindexForm();
                updateCounter();
                updateButtonStates();
            }
        });
    });
    
    // Reindex form
    function reindexForm() {
        $('.mahasiswa-item').each(function(index) {
            $(this).find('[name]').each(function() {
                const name = $(this).attr('name').replace(/\[\d+\]/, `[${index}]`);
                $(this).attr('name', name);
            });
        });
        mahasiswaCount = $('.mahasiswa-item').length;
    }
    
    // Update button states: ensure last row shows add (+) and other rows show remove (trash).
    function updateButtonStates() {
        const items = $('.mahasiswa-item');

        items.each(function(index) {
            const isLast = index === items.length - 1;
            let $addBtn = $(this).find('.btn-add-mahasiswa');
            let $removeBtn = $(this).find('.btn-remove-mahasiswa');

            // If neither button exists (defensive), try to find any button in the input-group
            if ($addBtn.length === 0 && $removeBtn.length === 0) {
                const $anyBtn = $(this).find('.input-group .btn').first();
                if ($anyBtn.length) {
                    // Normalize it to an add or remove depending on position
                    if (isLast) {
                        $anyBtn.removeClass('btn-remove-mahasiswa btn-outline-danger').addClass('btn-add-mahasiswa btn-outline-success').html('<i class="fas fa-plus"></i>');
                        $addBtn = $anyBtn;
                    } else {
                        $anyBtn.removeClass('btn-add-mahasiswa btn-outline-success').addClass('btn-remove-mahasiswa btn-outline-danger').html('<i class="fas fa-trash"></i>');
                        $removeBtn = $anyBtn;
                    }
                }
            }

            if (isLast) {
                // Ensure there is an add button on the last item
                if ($addBtn.length === 0 && $removeBtn.length > 0) {
                    // convert remove to add
                    $removeBtn.removeClass('btn-remove-mahasiswa btn-outline-danger').addClass('btn-add-mahasiswa btn-outline-success').html('<i class="fas fa-plus"></i>');
                    $addBtn = $removeBtn;
                    $removeBtn = $();
                }

                if ($addBtn.length === 0) {
                    // create add button and append to input-group
                    const $newAdd = $("<button type='button' class='btn btn-outline-success btn-add-mahasiswa'><i class='fas fa-plus'></i></button>");
                    $(this).find('.input-group').append($newAdd);
                    $addBtn = $newAdd;
                }

                $addBtn.removeClass('d-none').removeClass('btn-outline-danger').addClass('btn-outline-success');
                if ($removeBtn && $removeBtn.length) $removeBtn.addClass('d-none');
            } else {
                // Ensure there is a remove button on non-last items
                if ($removeBtn.length === 0 && $addBtn.length > 0) {
                    // convert add to remove
                    $addBtn.removeClass('btn-add-mahasiswa btn-outline-success').addClass('btn-remove-mahasiswa btn-outline-danger').html('<i class="fas fa-trash"></i>');
                    $removeBtn = $addBtn;
                    $addBtn = $();
                }

                if ($removeBtn.length === 0) {
                    // create remove button and append to input-group
                    const $newRemove = $("<button type='button' class='btn btn-outline-danger btn-remove-mahasiswa'><i class='fas fa-trash'></i></button>");
                    $(this).find('.input-group').append($newRemove);
                    $removeBtn = $newRemove;
                }

                $removeBtn.removeClass('d-none').removeClass('btn-outline-success').addClass('btn-outline-danger');
                if ($addBtn && $addBtn.length) $addBtn.addClass('d-none');
            }
        });
    }
    
    // Form validation
    $('#multipleMahasiswaForm').on('submit', function(e) {
        e.preventDefault();
        
        let isValid = true;
        const errors = [];
        
        // Validate students
        $('.mahasiswa-item').each(function(index) {
            const card = $(this);
            const nim = card.find('.nim-input').val().trim();
            const nama = card.find('.nama-input').val().trim();
            const semester = card.find('.semester-input').val().trim();
            const orangTua = card.find('.orangtua-input').val().trim();
            const nimStatus = card.find('.nim-status');
            
            // Validate NIM
            if (!nim) {
                isValid = false;
                errors.push(`Mahasiswa ${index + 1}: NIM harus diisi`);
                card.find('.nim-input').focus();
                return false;
            } else if (nim.length < 9 || nim.length > 10) {
                isValid = false;
                errors.push(`Mahasiswa ${index + 1}: NIM harus 9-10 digit`);
                card.find('.nim-input').focus();
                return false;
            } else if (nimStatus.hasClass('text-danger')) {
                isValid = false;
                errors.push(`Mahasiswa ${index + 1}: Data mahasiswa tidak ditemukan. Periksa NIM`);
                card.find('.nim-input').focus();
                return false;
            }
            
            // Validate name
            if (!nama || nama === 'Mencari...') {
                isValid = false;
                errors.push(`Mahasiswa ${index + 1}: Data mahasiswa tidak valid. Pastikan NIM benar`);
                card.find('.nim-input').focus();
                return false;
            }
            
            // Validate semester
            if (!semester) {
                isValid = false;
                errors.push(`Mahasiswa ${index + 1}: Semester harus diisi`);
                card.find('.semester-input').focus();
                return false;
            } else if (semester < 1 || semester > 14) {
                isValid = false;
                errors.push(`Mahasiswa ${index + 1}: Semester harus antara 1-14`);
                card.find('.semester-input').focus();
                return false;
            }
            
            // Nama orang tua is optional now; no client-side required check
        });
        
        // Validate violation data
        const pelanggaran = $('#pelanggaran-select').val();
        const sanksi = $('#sanksi-select').val();
        const deskripsi = $('textarea[name="deskripsi"]').val().trim();
        
        if (!pelanggaran) {
            isValid = false;
            errors.push('Pilih jenis pelanggaran');
            $('#pelanggaran-select').css('border-color', '#e74a3b');
        } else {
            $('#pelanggaran-select').css('border-color', '#d1d3e2');
        }
        
        if (!sanksi) {
            isValid = false;
            errors.push('Pilih sanksi yang sesuai');
            $('#sanksi-select').css('border-color', '#e74a3b');
        } else {
            $('#sanksi-select').css('border-color', '#d1d3e2');
        }
        
        // Deskripsi is optional; if provided enforce minimum length
        if (deskripsi && deskripsi.length < 20) {
            isValid = false;
            errors.push('Deskripsi pelanggaran minimal 20 karakter');
        }
        
        if (!isValid) {
            Swal.fire({
                icon: 'error',
                title: 'Validasi Gagal',
                html: errors.join('<br>'),
                confirmButtonText: 'Perbaiki',
                confirmButtonColor: '#e74a3b'
            });
            return;
        }
        
        // Confirmation dialog
        const studentCount = $('.mahasiswa-item').length;
        Swal.fire({
            title: 'Konfirmasi Penyimpanan',
            html: `Anda akan menyimpan data untuk <b>${studentCount} mahasiswa</b> dengan pelanggaran yang sama.<br><br>Apakah data sudah benar?`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Ya, Simpan',
            cancelButtonText: 'Periksa Lagi',
            confirmButtonColor: '#1cc88a',
            cancelButtonColor: '#6c757d'
        }).then((result) => {
            if (result.isConfirmed) {
                // Show loading
                Swal.fire({
                    title: 'Menyimpan Data',
                    text: 'Harap tunggu...',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
                
                // Submit form
                this.submit();
            }
        });
    });
    
    // Initialize
    updateCounter();
    updateButtonStates();
    console.log('Form initialization complete');
});

// Function to initialize Select2 if available
function initializeSelect2() {
    console.log('Initializing Select2...');
    
    try {
        // Initialize Select2
        $('#pelanggaran-select').select2({
            theme: 'classic',
            width: '100%',
            placeholder: '-- Pilih Pelanggaran --',
            allowClear: false,
            dropdownParent: $('body')
        });
        
        $('#sanksi-select').select2({
            theme: 'classic',
            width: '100%',
            placeholder: '-- Pilih Sanksi --',
            allowClear: false,
            dropdownParent: $('body')
        });
        
        console.log('Select2 initialized successfully');
    } catch (error) {
        console.error('Error initializing Select2:', error);
        // Fallback to regular select
        $('.select-pelanggaran, .select-sanksi').addClass('enhanced-select');
    }
}

// Handle success/error messages
@if(session('success'))
$(document).ready(function() {
    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: '{{ session('success') }}',
        confirmButtonColor: '#1cc88a'
    });
});
@endif

@if($errors->any())
$(document).ready(function() {
    Swal.fire({
        icon: 'error',
        title: 'Gagal!',
        html: '{!! implode('<br>', $errors->all()) !!}',
        confirmButtonColor: '#e74a3b'
    });
});
@endif
</script>
@endsection