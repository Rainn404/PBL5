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
        </div>
        <div class="card-body">
            <form action="{{ route('admin.mahasiswa-bermasalah.store-multiple') }}" method="POST" id="multipleMahasiswaForm">
                @csrf

                <!-- Data Mahasiswa (Bisa Multiple) -->
                <div class="mb-4">
                    <h5 class="text-primary mb-3">
                        <i class="fas fa-users me-2"></i>Data Mahasiswa
                    </h5>
                    <div id="mahasiswa-container">
                        <!-- Item pertama -->
                        <div class="mahasiswa-item border p-3 mb-3 rounded bg-light">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="mb-3">
                                        <label class="form-label">NIM <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <input type="text" name="mahasiswa[0][nim]" class="form-control nim-input" 
                                                   placeholder="Masukkan NIM mahasiswa" required>
                                            <button type="button" class="btn btn-success btn-add-mahasiswa">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                        <div class="nim-error text-danger small mt-1"></div>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="mb-3">
                                        <label class="form-label">Nama <span class="text-danger">*</span></label>
                                        <input type="text" name="mahasiswa[0][nama]" class="form-control nama-input" 
                                               placeholder="Nama akan terisi otomatis" readonly required>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="mb-3">
                                        <label class="form-label text-muted">Aksi</label>
                                        <button type="button" class="btn btn-danger btn-remove-mahasiswa d-none w-100">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Semester <span class="text-danger">*</span></label>
                                        <input type="number" name="mahasiswa[0][semester]" class="form-control semester-input" 
                                               min="1" max="14" placeholder="Masukkan semester" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Nama Orang Tua <span class="text-danger">*</span></label>
                                        <input type="text" name="mahasiswa[0][nama_orang_tua]" class="form-control orangtua-input" 
                                               placeholder="Masukkan nama orang tua" required>
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
                    <div class="border p-4 rounded bg-light">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Pelanggaran <span class="text-danger">*</span></label>
                                    <select name="pelanggaran_id" class="form-control" required>
                                        <option value="">-- Pilih Pelanggaran --</option>
                                        @foreach ($pelanggaran as $p)
                                            <option value="{{ $p->id }}" {{ old('pelanggaran_id') == $p->id ? 'selected' : '' }}>
                                                {{ $p->nama_pelanggaran }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Sanksi <span class="text-danger">*</span></label>
                                    <select name="sanksi_id" class="form-control" required>
                                        <option value="">-- Pilih Sanksi --</option>
                                        @foreach ($sanksi as $s)
                                            <option value="{{ $s->id }}" {{ old('sanksi_id') == $s->id ? 'selected' : '' }}>
                                                {{ $s->nama_sanksi }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Deskripsi <span class="text-danger">*</span></label>
                            <textarea name="deskripsi" class="form-control" rows="4" 
                                      placeholder="Masukkan deskripsi lengkap mengenai masalah yang terjadi..." required>{{ old('deskripsi') }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center">
                    <a href="{{ route('admin.mahasiswa-bermasalah.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Kembali
                    </a>
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save me-2"></i>Simpan Semua Data
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
.mahasiswa-item {
    border-left: 4px solid #007bff !important;
    transition: all 0.3s ease;
}

.mahasiswa-item:not(:first-child) {
    border-left: 4px solid #28a745 !important;
}

.btn-add-mahasiswa, .btn-remove-mahasiswa {
    height: 38px;
    border-radius: 0.375rem;
}

.btn-add-mahasiswa:hover {
    background-color: #28a745;
    border-color: #28a745;
}

.btn-remove-mahasiswa:hover {
    background-color: #dc3545;
    border-color: #dc3545;
}

.input-group .btn {
    border-left: 1px solid #dee2e6;
}

.nim-error {
    min-height: 20px;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let mahasiswaCount = 1;
    const container = document.getElementById('mahasiswa-container');

    // Fungsi untuk auto-fill nama berdasarkan NIM
    function setupNimAutoFill(nimInput, namaInput, errorElement) {
        let isSearching = false;
        
        nimInput.addEventListener('blur', function() {
            const nim = this.value.trim();
            
            if (isSearching) return;
            
            if (nim.length >= 8) {
                isSearching = true;
                errorElement.textContent = 'Mencari data mahasiswa...';
                errorElement.className = 'text-info small mt-1';
                
                // Disable input sementara
                nimInput.disabled = true;
                
                fetch(`/admin/mahasiswa-bermasalah/get-mahasiswa/${nim}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.error) {
                            throw new Error(data.error);
                        }
                        
                        namaInput.value = data.nama || '';
                        errorElement.textContent = '✓ Data ditemukan';
                        errorElement.className = 'text-success small mt-1';
                        
                        // Auto-fill semester dan nama orang tua jika kosong
                        const cardBody = nimInput.closest('.mahasiswa-item');
                        const semesterInput = cardBody.querySelector('.semester-input');
                        const orangTuaInput = cardBody.querySelector('.orangtua-input');
                        
                        if (semesterInput && !semesterInput.value && data.semester) {
                            semesterInput.value = data.semester;
                        }
                        if (orangTuaInput && !orangTuaInput.value && data.nama_orang_tua) {
                            orangTuaInput.value = data.nama_orang_tua;
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        errorElement.textContent = error.message || 'Mahasiswa tidak ditemukan';
                        errorElement.className = 'text-danger small mt-1';
                        namaInput.value = '';
                    })
                    .finally(() => {
                        isSearching = false;
                        nimInput.disabled = false;
                        nimInput.focus();
                    });
            } else if (nim.length > 0) {
                errorElement.textContent = 'NIM harus minimal 8 karakter';
                errorElement.className = 'text-danger small mt-1';
                namaInput.value = '';
            } else {
                errorElement.textContent = '';
                namaInput.value = '';
            }
        });

        // Clear error ketika user mulai mengetik lagi
        nimInput.addEventListener('input', function() {
            if (this.value.trim().length >= 8) {
                errorElement.textContent = 'Tekan Tab atau klik di luar untuk mencari...';
                errorElement.className = 'text-muted small mt-1';
            } else {
                errorElement.textContent = '';
            }
        });
    }

    // Setup auto-fill untuk form pertama
    const firstNimInput = document.querySelector('.nim-input');
    const firstNamaInput = document.querySelector('.nama-input');
    const firstErrorElement = document.querySelector('.nim-error');
    if (firstNimInput && firstNamaInput && firstErrorElement) {
        setupNimAutoFill(firstNimInput, firstNamaInput, firstErrorElement);
    }

    // Tambah mahasiswa baru
    document.addEventListener('click', function(e) {
        if (e.target.closest('.btn-add-mahasiswa')) {
            addMahasiswaItem();
        }
        
        // Hapus mahasiswa
        if (e.target.closest('.btn-remove-mahasiswa')) {
            const items = document.querySelectorAll('.mahasiswa-item');
            if (items.length > 1) {
                const itemToRemove = e.target.closest('.mahasiswa-item');
                itemToRemove.remove();
                reindexForm();
                updateButtonStates();
            }
        }
    });

    function addMahasiswaItem() {
        const items = document.querySelectorAll('.mahasiswa-item');
        const lastItem = items[items.length - 1];
        const newIndex = mahasiswaCount++;
        
        // Clone item
        const newItem = lastItem.cloneNode(true);
        
        // Reset values
        newItem.querySelector('.nim-input').value = '';
        newItem.querySelector('.nama-input').value = '';
        newItem.querySelector('.semester-input').value = '';
        newItem.querySelector('.orangtua-input').value = '';
        
        const errorElement = newItem.querySelector('.nim-error');
        errorElement.textContent = '';
        errorElement.className = 'nim-error text-danger small mt-1';
        
        // Update names dengan index baru
        newItem.querySelectorAll('[name]').forEach(element => {
            const name = element.getAttribute('name').replace(/\[\d+\]/, `[${newIndex}]`);
            element.setAttribute('name', name);
        });
        
        // Setup auto-fill untuk input baru
        const newNimInput = newItem.querySelector('.nim-input');
        const newNamaInput = newItem.querySelector('.nama-input');
        const newErrorElement = newItem.querySelector('.nim-error');
        setupNimAutoFill(newNimInput, newNamaInput, newErrorElement);
        
        container.appendChild(newItem);
        updateButtonStates();
    }

    function updateButtonStates() {
        const items = document.querySelectorAll('.mahasiswa-item');
        
        items.forEach((item, index) => {
            const removeBtn = item.querySelector('.btn-remove-mahasiswa');
            const addBtn = item.querySelector('.btn-add-mahasiswa');
            
            if (index === items.length - 1) {
                // Item terakhir - tampilkan tombol tambah
                if (addBtn) {
                    addBtn.classList.remove('d-none');
                    addBtn.classList.remove('btn-danger');
                    addBtn.classList.add('btn-success', 'btn-add-mahasiswa');
                    addBtn.innerHTML = '<i class="fas fa-plus"></i>';
                }
                if (removeBtn) {
                    removeBtn.classList.add('d-none');
                }
            } else {
                // Bukan item terakhir - tampilkan tombol hapus
                if (removeBtn) {
                    removeBtn.classList.remove('d-none');
                    removeBtn.classList.remove('btn-success');
                    removeBtn.classList.add('btn-danger', 'btn-remove-mahasiswa');
                    removeBtn.innerHTML = '<i class="fas fa-trash"></i>';
                }
                if (addBtn) {
                    addBtn.classList.add('d-none');
                }
            }
        });
    }

    // Reindex form setelah menghapus item
    function reindexForm() {
        document.querySelectorAll('.mahasiswa-item').forEach((item, index) => {
            item.querySelectorAll('[name]').forEach(element => {
                const name = element.getAttribute('name').replace(/\[\d+\]/, `[${index}]`);
                element.setAttribute('name', name);
            });
        });
        mahasiswaCount = document.querySelectorAll('.mahasiswa-item').length;
    }

    // Validasi form sebelum submit
    document.getElementById('multipleMahasiswaForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const mahasiswaItems = document.querySelectorAll('.mahasiswa-item');
        let isValid = true;
        const errors = [];

        // Validasi setiap mahasiswa
        mahasiswaItems.forEach((item, index) => {
            const nim = item.querySelector('.nim-input').value.trim();
            const nama = item.querySelector('.nama-input').value.trim();
            const semester = item.querySelector('.semester-input').value.trim();
            const namaOrangTua = item.querySelector('.orangtua-input').value.trim();
            const errorElement = item.querySelector('.nim-error');

            // Validasi NIM dan nama
            if (!nim) {
                isValid = false;
                errors.push(`Mahasiswa ${index + 1}: NIM harus diisi`);
                item.querySelector('.nim-input').focus();
            } else if (errorElement.classList.contains('text-danger')) {
                isValid = false;
                errors.push(`Mahasiswa ${index + 1}: ${errorElement.textContent}`);
                item.querySelector('.nim-input').focus();
            } else if (!nama) {
                isValid = false;
                errors.push(`Mahasiswa ${index + 1}: Data mahasiswa tidak valid. Pastikan NIM benar`);
                item.querySelector('.nim-input').focus();
            }
            
            // Validasi semester
            if (!semester) {
                isValid = false;
                errors.push(`Mahasiswa ${index + 1}: Semester harus diisi`);
            } else if (semester < 1 || semester > 14) {
                isValid = false;
                errors.push(`Mahasiswa ${index + 1}: Semester harus antara 1-14`);
            }
            
            // Validasi nama orang tua
            if (!namaOrangTua) {
                isValid = false;
                errors.push(`Mahasiswa ${index + 1}: Nama orang tua harus diisi`);
            }
        });

        // Validasi data pelanggaran
        const pelanggaran = document.querySelector('select[name="pelanggaran_id"]').value;
        const sanksi = document.querySelector('select[name="sanksi_id"]').value;
        const deskripsi = document.querySelector('textarea[name="deskripsi"]').value.trim();

        if (!pelanggaran) {
            isValid = false;
            errors.push('Pilih jenis pelanggaran');
        }
        
        if (!sanksi) {
            isValid = false;
            errors.push('Pilih sanksi yang sesuai');
        }
        
        if (!deskripsi) {
            isValid = false;
            errors.push('Deskripsi pelanggaran harus diisi');
        } else if (deskripsi.length < 10) {
            isValid = false;
            errors.push('Deskripsi pelanggaran minimal 10 karakter');
        }

        if (!isValid) {
            alert('Terjadi kesalahan:\n' + errors.join('\n'));
            return;
        }

        // Tampilkan konfirmasi sebelum submit
        if (confirm(`Anda akan menyimpan data untuk ${mahasiswaItems.length} mahasiswa dengan pelanggaran yang sama. Lanjutkan?`)) {
            this.submit();
        }
    });

    // Initialize button states
    updateButtonStates();
});
</script>
@endsection