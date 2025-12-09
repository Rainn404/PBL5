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
        <div class="card-header py-3 bg-primary text-white">
            <h6 class="m-0 font-weight-bold">Form Tambah Mahasiswa Bermasalah</h6>
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
                        <div class="d-flex align-items-center gap-2">
                            <span class="badge bg-primary" id="mahasiswa-counter">1 Mahasiswa</span>
                            <!-- Input untuk menambah banyak mahasiswa sekaligus -->
                            <div class="input-group input-group-sm" style="width: 220px;">
                                <span class="input-group-text">
                                    <i class="fas fa-plus"></i>
                                </span>
                                <input type="number" id="jumlah-tambah" class="form-control" 
                                       min="1" max="50" placeholder="Jumlah mahasiswa" value="1">
                                <button type="button" id="btn-tambah-banyak" class="btn btn-info">
                                    Tambah
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Info tambahan -->
                    <div class="alert alert-info alert-dismissible fade show mb-3 py-2" role="alert">
                        <i class="fas fa-info-circle me-2"></i>
                        <small>Input jumlah mahasiswa di atas, lalu klik "Tambah" untuk menambah formulir sekaligus.</small>
                        <button type="button" class="btn-close py-2" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    
                    <div id="mahasiswa-container">
                        <div class="mahasiswa-item card mb-3 border-primary">
                            <div class="card-header py-2 bg-light d-flex justify-content-between align-items-center">
                                <span class="fw-bold text-primary">Mahasiswa #1</span>
                                <button type="button" class="btn btn-sm btn-danger btn-remove-mahasiswa d-none">
                                    <i class="fas fa-times me-1"></i> Hapus
                                </button>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label fw-semibold">NIM <span class="text-danger">*</span></label>
                                            <div class="mb-3">
                                                <input type="text" name="mahasiswa[0][nim]" class="form-control nim-input" 
                                                       placeholder="Masukkan NIM mahasiswa" required>
                                                <div class="nim-error text-danger small mt-1"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label fw-semibold">Nama <span class="text-danger">*</span></label>
                                            <input type="text" name="mahasiswa[0][nama]" class="form-control nama-input" 
                                                   placeholder="Nama akan terisi otomatis" readonly required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label fw-semibold">Semester <span class="text-danger">*</span></label>
                                            <input type="number" name="mahasiswa[0][semester]" class="form-control" 
                                                   min="1" max="14" placeholder="Masukkan semester" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label fw-semibold">Nama Orang Tua <span class="text-danger">*</span></label>
                                            <input type="text" name="mahasiswa[0][nama_orang_tua]" class="form-control" 
                                                   placeholder="Masukkan nama orang tua" required>
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
                        <div class="card-header bg-warning text-dark py-2">
                            <span class="fw-bold">Pelanggaran yang Dilakukan</span>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">Jenis Pelanggaran <span class="text-danger">*</span></label>
                                        <select name="pelanggaran_id" class="form-control select2" required>
                                            <option value="">-- Pilih Pelanggaran --</option>
                                            @foreach ($pelanggaran as $p)
                                                <option value="{{ $p->id }}">{{ $p->nama_pelanggaran }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">Sanksi <span class="text-danger">*</span></label>
                                        <select name="sanksi_id" class="form-control select2" required>
                                            <option value="">-- Pilih Sanksi --</option>
                                            @foreach ($sanksi as $s)
                                                <option value="{{ $s->id }}">{{ $s->nama_sanksi }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-0">
                                <label class="form-label fw-semibold">Deskripsi Kejadian <span class="text-danger">*</span></label>
                                <textarea name="deskripsi" class="form-control" rows="4" 
                                          placeholder="Masukkan deskripsi lengkap mengenai masalah yang terjadi..." required>{{ old('deskripsi') }}</textarea>
                                <div class="form-text">Jelaskan secara detail kronologi pelanggaran yang dilakukan.</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center border-top pt-3">
                    <a href="{{ route('admin.mahasiswa-bermasalah.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Kembali
                    </a>
                    <button type="submit" class="btn btn-success px-4">
                        <i class="fas fa-save me-2"></i>Simpan Semua Data
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
.mahasiswa-item {
    transition: all 0.3s ease;
}

.mahasiswa-item .card-header {
    transition: all 0.3s ease;
}

#btn-tambah-banyak:hover, .btn-remove-mahasiswa:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

.nim-error {
    min-height: 20px;
}

.select2-container--default .select2-selection--single {
    height: 38px;
    padding: 5px 10px;
}

.select2-container--default .select2-selection--single .select2-selection__arrow {
    height: 36px;
}

#jumlah-tambah:focus {
    border-color: #86b7fe;
    box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
}

.batch-add-notification {
    position: fixed;
    top: 20px;
    right: 20px;
    z-index: 9999;
    animation: slideIn 0.3s ease-out;
}

@keyframes slideIn {
    from {
        transform: translateX(100%);
        opacity: 0;
    }
    to {
        transform: translateX(0);
        opacity: 1;
    }
}

.alert-info {
    background-color: #e7f3ff;
    border-color: #b6d4fe;
    color: #055160;
}

.btn-remove-mahasiswa {
    padding: 0.25rem 0.5rem;
    font-size: 0.75rem;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let mahasiswaCount = 1;
    const container = document.getElementById('mahasiswa-container');
    const counterElement = document.getElementById('mahasiswa-counter');
    const jumlahTambahInput = document.getElementById('jumlah-tambah');
    const btnTambahBanyak = document.getElementById('btn-tambah-banyak');

    // Inisialisasi Select2 jika tersedia
    if (typeof $.fn.select2 !== 'undefined') {
        $('.select2').select2({
            theme: 'bootstrap4',
            width: '100%'
        });
    }

    // Update counter mahasiswa
    function updateCounter() {
        const count = document.querySelectorAll('.mahasiswa-item').length;
        counterElement.textContent = `${count} Mahasiswa`;
        // Update title badge jika lebih dari 1
        if (count > 1) {
            counterElement.classList.remove('bg-primary');
            counterElement.classList.add('bg-success');
        } else {
            counterElement.classList.remove('bg-success');
            counterElement.classList.add('bg-primary');
        }
    }

    // Tampilkan/sembunyikan tombol hapus
    function updateRemoveButtons() {
        const items = document.querySelectorAll('.mahasiswa-item');
        items.forEach((item, index) => {
            const removeBtn = item.querySelector('.btn-remove-mahasiswa');
            
            if (items.length > 1) {
                // Tampilkan tombol hapus untuk semua item
                removeBtn.classList.remove('d-none');
            } else {
                // Hanya satu item, sembunyikan tombol hapus
                removeBtn.classList.add('d-none');
            }
        });
    }

    // Fungsi untuk auto-fill nama berdasarkan NIM
    function setupNimAutoFill(nimInput, namaInput, errorElement) {
        const searchHandler = function() {
            const nim = nimInput.value.trim();
            
            if (nim.length >= 8) {
                errorElement.textContent = 'Mencari data mahasiswa...';
                errorElement.className = 'text-info small mt-1';
                
                fetch(`/admin/mahasiswa-bermasalah/get-mahasiswa/${nim}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Mahasiswa tidak ditemukan');
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
                        const semesterInput = cardBody.querySelector('input[name*="semester"]');
                        const orangTuaInput = cardBody.querySelector('input[name*="nama_orang_tua"]');
                        
                        if (semesterInput && !semesterInput.value && data.semester && data.semester !== 'Tidak diketahui') {
                            semesterInput.value = data.semester;
                        }
                        if (orangTuaInput && !orangTuaInput.value && data.nama_orang_tua && data.nama_orang_tua !== 'Tidak diketahui') {
                            orangTuaInput.value = data.nama_orang_tua;
                        }
                    })
                    .catch(error => {
                        errorElement.textContent = error.message;
                        errorElement.className = 'text-danger small mt-1';
                        namaInput.value = '';
                    });
            } else if (nim.length > 0) {
                errorElement.textContent = 'NIM harus minimal 8 karakter';
                errorElement.className = 'text-danger small mt-1';
                namaInput.value = '';
            } else {
                errorElement.textContent = '';
                namaInput.value = '';
            }
        };

        // Event listener untuk blur pada input NIM
        nimInput.addEventListener('blur', searchHandler);
    }

    // Setup auto-fill untuk form pertama
    const firstNimInput = document.querySelector('.nim-input');
    const firstNamaInput = document.querySelector('.nama-input');
    const firstErrorElement = document.querySelector('.nim-error');
    setupNimAutoFill(firstNimInput, firstNamaInput, firstErrorElement);

    // Fungsi untuk membuat item mahasiswa baru
    function createMahasiswaItem(index) {
        const originalItem = document.querySelector('.mahasiswa-item');
        const newItem = originalItem.cloneNode(true);
        
        // Reset values
        newItem.querySelector('.nim-input').value = '';
        newItem.querySelector('.nama-input').value = '';
        newItem.querySelector('input[name*="semester"]').value = '';
        newItem.querySelector('input[name*="nama_orang_tua"]').value = '';
        newItem.querySelector('.nim-error').textContent = '';
        newItem.querySelector('.nim-error').className = 'nim-error text-danger small mt-1';
        
        // Update header
        const header = newItem.querySelector('.card-header');
        const headerText = header.querySelector('span');
        headerText.textContent = `Mahasiswa #${index}`;
        
        // Update names
        newItem.querySelectorAll('[name]').forEach(element => {
            const name = element.getAttribute('name').replace(/\[\d+\]/, `[${index - 1}]`);
            element.setAttribute('name', name);
        });
        
        // Change border color for new item
        newItem.classList.remove('border-primary');
        newItem.classList.add('border-success');
        
        // Setup auto-fill untuk input baru
        const newNimInput = newItem.querySelector('.nim-input');
        const newNamaInput = newItem.querySelector('.nama-input');
        const newErrorElement = newItem.querySelector('.nim-error');
        setupNimAutoFill(newNimInput, newNamaInput, newErrorElement);
        
        return newItem;
    }

    // Fungsi untuk menampilkan notifikasi
    function showNotification(message, type = 'success') {
        const notification = document.createElement('div');
        notification.className = `alert alert-${type} batch-add-notification`;
        notification.innerHTML = `
            <div class="d-flex align-items-center">
                <i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-triangle'} me-2"></i>
                <span>${message}</span>
            </div>
        `;
        
        document.body.appendChild(notification);
        
        // Hapus notifikasi setelah 3 detik
        setTimeout(() => {
            notification.style.opacity = '0';
            notification.style.transform = 'translateX(100%)';
            setTimeout(() => notification.remove(), 300);
        }, 3000);
    }

    // Tambah banyak mahasiswa sekaligus
    btnTambahBanyak.addEventListener('click', function() {
        const jumlah = parseInt(jumlahTambahInput.value);
        
        if (!jumlah || jumlah < 1 || jumlah > 50) {
            showNotification('Masukkan jumlah antara 1-50', 'warning');
            jumlahTambahInput.focus();
            return;
        }
        
        const currentCount = document.querySelectorAll('.mahasiswa-item').length;
        const totalAfterAdd = currentCount + jumlah;
        
        if (totalAfterAdd > 50) {
            showNotification(`Maksimal 50 mahasiswa. Saat ini sudah ${currentCount} mahasiswa.`, 'warning');
            return;
        }
        
        // Tambahkan item sebanyak jumlah yang diminta
        for (let i = 0; i < jumlah; i++) {
            const newIndex = mahasiswaCount++;
            const newItem = createMahasiswaItem(newIndex + 1);
            container.appendChild(newItem);
        }
        
        updateCounter();
        updateRemoveButtons();
        
        // Scroll ke item terakhir yang ditambahkan
        const lastItem = container.lastElementChild;
        lastItem.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        
        // Tampilkan notifikasi
        showNotification(`Berhasil menambahkan ${jumlah} formulir mahasiswa`, 'success');
        
        // Reset input
        jumlahTambahInput.value = '';
        jumlahTambahInput.focus();
    });

    // Hapus mahasiswa
    document.addEventListener('click', function(e) {
        if (e.target.closest('.btn-remove-mahasiswa')) {
            const items = document.querySelectorAll('.mahasiswa-item');
            if (items.length > 1) {
                const itemToRemove = e.target.closest('.mahasiswa-item');
                itemToRemove.remove();
                reindexForm();
                updateCounter();
                updateRemoveButtons();
                showNotification('Formulir mahasiswa dihapus', 'info');
            }
        }
    });

    // Reindex form setelah menghapus item
    function reindexForm() {
        document.querySelectorAll('.mahasiswa-item').forEach((item, index) => {
            // Update header
            const headerText = item.querySelector('.card-header span');
            headerText.textContent = `Mahasiswa #${index + 1}`;
            
            // Update names
            item.querySelectorAll('[name]').forEach(element => {
                const name = element.getAttribute('name').replace(/\[\d+\]/, `[${index}]`);
                element.setAttribute('name', name);
            });
            
            // Update border color
            if (index === 0) {
                item.classList.remove('border-success');
                item.classList.add('border-primary');
            } else {
                item.classList.remove('border-primary');
                item.classList.add('border-success');
            }
        });
    }

    // Validasi form sebelum submit
    document.getElementById('multipleMahasiswaForm').addEventListener('submit', function(e) {
        const mahasiswaItems = document.querySelectorAll('.mahasiswa-item');
        let isValid = true;
        const errors = [];

        // Validasi setiap mahasiswa
        mahasiswaItems.forEach((item, index) => {
            const nim = item.querySelector('.nim-input').value.trim();
            const nama = item.querySelector('.nama-input').value.trim();
            const semester = item.querySelector('input[name*="semester"]').value.trim();
            const namaOrangTua = item.querySelector('input[name*="nama_orang_tua"]').value.trim();
            const nimError = item.querySelector('.nim-error');

            if (!nim || !nama || nimError.classList.contains('text-danger')) {
                isValid = false;
                errors.push(`Mahasiswa ${index + 1}: Harap isi NIM dengan benar dan pastikan data mahasiswa ditemukan`);
            }
            
            if (!semester || semester < 1 || semester > 14) {
                isValid = false;
                errors.push(`Mahasiswa ${index + 1}: Semester harus antara 1-14`);
            }
            
            if (!namaOrangTua) {
                isValid = false;
                errors.push(`Mahasiswa ${index + 1}: Harap lengkapi nama orang tua`);
            }
        });

        // Validasi data pelanggaran
        const pelanggaran = document.querySelector('select[name="pelanggaran_id"]').value;
        const sanksi = document.querySelector('select[name="sanksi_id"]').value;
        const deskripsi = document.querySelector('textarea[name="deskripsi"]').value.trim();

        if (!pelanggaran) {
            isValid = false;
            errors.push('Harap pilih jenis pelanggaran');
        }
        
        if (!sanksi) {
            isValid = false;
            errors.push('Harap pilih sanksi yang sesuai');
        }
        
        if (!deskripsi || deskripsi.length < 10) {
            isValid = false;
            errors.push('Harap isi deskripsi kejadian dengan lengkap (minimal 10 karakter)');
        }

        if (!isValid) {
            e.preventDefault();
            
            // Tampilkan pesan error dengan lebih baik
            let errorMessage = 'Terjadi kesalahan:\n\n';
            errors.forEach(error => {
                errorMessage += `• ${error}\n`;
            });
            errorMessage += '\nSilakan perbaiki data tersebut sebelum melanjutkan.';
            
            alert(errorMessage);
        } else {
            // Tampilkan konfirmasi sebelum submit
            const mahasiswaCount = mahasiswaItems.length;
            const mahasiswaText = mahasiswaCount > 1 ? `${mahasiswaCount} mahasiswa` : '1 mahasiswa';
            
            if (!confirm(`Anda akan menyimpan data untuk ${mahasiswaText} dengan pelanggaran yang sama. Lanjutkan?`)) {
                e.preventDefault();
            }
        }
    });

    // Event listener untuk input jumlah (Enter untuk submit)
    jumlahTambahInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            btnTambahBanyak.click();
        }
    });
    
    // Inisialisasi counter dan tombol hapus
    updateCounter();
    updateRemoveButtons();
});
</script>
@endsection