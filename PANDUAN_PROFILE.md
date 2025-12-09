# Panduan Manajemen Profil & Akun

## Fitur yang Tersedia

### 1. **Lihat Profil** 
   - URL: `/profile`
   - Menampilkan informasi akun (nama, email, role)
   - Menampilkan foto profil

### 2. **Edit Profil**
   - URL: `/profile/edit`
   - Ubah nama dan email
   - Klik tombol "Edit Profil" di halaman profil

### 3. **Upload/Ubah Foto Profil**
   - Langsung dari halaman profil (`/profile`)
   - Pilih file (JPG, PNG, GIF - max 2MB)
   - Klik "Upload Foto"
   - Foto disimpan ke `public/storage/avatars/`

### 4. **Hapus Foto Profil**
   - Klik "Hapus Foto" (muncul jika sudah upload foto)
   - Foto lama akan dihapus dari storage

### 5. **Ubah Password**
   - URL: `/profile/password`
   - Masukkan password saat ini (verifikasi keamanan)
   - Masukkan password baru (minimal 8 karakter)
   - Konfirmasi password baru

### 6. **Lupa Password (Public)**
   - URL: `/password/forgot`
   - Masukkan email terdaftar
   - Sistem akan kirim link reset ke email (jika email relay dikonfigurasi)
   - Klik link di email untuk reset password

## Cara Akses

### Dari Dashboard Admin/User
1. **Klik avatar + nama di top-right navbar**
2. Pilih menu:
   - **Profil** → Lihat profil lengkap
   - **Edit Profil** → Ubah nama/email
   - **Ubah Password** → Ganti password
   - **Logout** → Keluar

### Atau Akses Langsung URL
- `/profile` → Halaman profil
- `/profile/edit` → Edit profil
- `/profile/password` → Ubah password
- `/password/forgot` → Reset password

## Setup Awal (First Time)

Jalankan migrasi untuk menambah kolom `avatar`:
```bash
php artisan migrate
```

Buat folder storage jika belum:
```bash
mkdir public/storage/avatars
chmod 755 public/storage/avatars
```

(Atau gunakan Laravel storage link jika menggunakan filesystem berbeda)

## Catatan Teknis

- **Avatar Storage**: `public/storage/avatars/`
- **File Size**: Max 2MB
- **Format**: JPG, PNG, GIF
- **Password Hash**: BCrypt (otomatis)
- **Password Reset**: Menggunakan Laravel Password Broker
  - Butuh email relay (SMTP) yang dikonfigurasi di `.env`
  - Untuk dev testing: set `MAIL_MAILER=log` di `.env`, maka email akan di-log ke `storage/logs/`

## Troubleshooting

### Avatar tidak upload
1. Pastikan folder `public/storage/avatars` exist dan writable
2. Check permission: `chmod 755 public/storage/avatars`
3. Pastikan file tidak lebih dari 2MB
4. Format harus JPG/PNG/GIF

### Password reset email tidak terkirim
1. Setup SMTP di `.env`:
   ```
   MAIL_MAILER=smtp
   MAIL_HOST=smtp.mailtrap.io  (atau SMTP provider lain)
   MAIL_PORT=587
   MAIL_USERNAME=xxx
   MAIL_PASSWORD=xxx
   ```
2. Atau gunakan `MAIL_MAILER=log` untuk dev (cek `storage/logs/`)

### Lupa password admin sebelum email setup
- Gunakan Laravel Tinker untuk reset:
  ```bash
  php artisan tinker
  >>> $user = User::where('email','admin@local.test')->first();
  >>> $user->password = Hash::make('newpassword');
  >>> $user->save();
  ```

## Routes (untuk developer)

```php
// Auth-protected routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/avatar', [ProfileController::class, 'uploadAvatar'])->name('profile.avatar.upload');
    Route::delete('/profile/avatar', [ProfileController::class, 'removeAvatar'])->name('profile.avatar.remove');
    Route::get('/profile/password', [ProfileController::class, 'showChangePassword'])->name('profile.password');
    Route::post('/profile/password', [ProfileController::class, 'changePassword'])->name('profile.password.change');
});

// Public password reset routes
Route::get('/password/forgot', [ProfileController::class, 'showResetRequestForm'])->name('password.request');
Route::post('/password/forgot', [ProfileController::class, 'sendResetLink'])->name('password.email');
Route::get('/password/reset/{token}', [ProfileController::class, 'showResetForm'])->name('password.reset');
Route::post('/password/reset', [ProfileController::class, 'resetPassword'])->name('password.update');
```

---
**Last Updated**: 2025-12-09
