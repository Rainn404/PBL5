# 📊 Visual Diagram - Sistem Pendaftaran HIMA-TI

## 1. Halaman-Halaman & Routing

```
┌─────────────────────────────────────────────────────────────────┐
│                    PENDAFTARAN ANGGOTA HIMA-TI                  │
└─────────────────────────────────────────────────────────────────┘

┌──────────────────────────────────────────────────────────────────────┐
│ KONDISI AWAL (Cek Pengaturan di checkPendaftaranStatus())           │
├──────────────────────────────────────────────────────────────────────┤
│                                                                      │
│  Pendaftaran Aktif?                                                 │
│    ├─ NO & Belum Dibuka → /pendaftaran/coming-soon                │
│    ├─ NO & Sudah Ditutup → /pendaftaran/closed                    │
│    ├─ NO & Sudah Berakhir → /pendaftaran/ended                    │
│    └─ YES ─┐                                                       │
│            │                                                       │
│  Kuota Penuh?                                                       │
│    ├─ YES → /pendaftaran/quota-full                               │
│    └─ NO → /pendaftaran/create ✅ (HALAMAN FORM AKTIF)           │
│                                                                      │
└──────────────────────────────────────────────────────────────────────┘

┌──────────────────────────────────────────────────────────────────────┐
│ HALAMAN FORM (create.blade.php)                                     │
├──────────────────────────────────────────────────────────────────────┤
│                                                                      │
│  ┌─────────────────────────────────────────────────────────────┐  │
│  │ Info Cards (Real-time Updated)                              │  │
│  │ • Periode Pendaftaran                                       │  │
│  │ • Kuota Tersedia: <span id="kuotaTersisa">5</span> dari 50  │  │
│  │ • Status: Pendaftaran Dibuka                                │  │
│  └─────────────────────────────────────────────────────────────┘  │
│                                                                      │
│  ┌─────────────────────────────────────────────────────────────┐  │
│  │ FORM (action="/pendaftaran/", method="POST")                │  │
│  │ ├─ Data Pribadi                                             │  │
│  │ │  ├─ Nama Lengkap *                                        │  │
│  │ │  ├─ NIM *                                                 │  │
│  │ │  ├─ Semester *                                            │  │
│  │ │  └─ Nomor HP/WhatsApp *                                   │  │
│  │ ├─ Alasan Mendaftar * (min. 50 karakter)                    │  │
│  │ ├─ Pengalaman Organisasi                                    │  │
│  │ ├─ Kemampuan/Keterampilan                                   │  │
│  │ ├─ Upload CV/Portofolio (opsional)                          │  │
│  │ ├─ Checkbox Persetujuan *                                   │  │
│  │ └─ [KIRIM PENDAFTARAN] [KEMBALI]                           │  │
│  └─────────────────────────────────────────────────────────────┘  │
│                                                                      │
│  JAVASCRIPT BEHAVIOR:                                               │
│  • Validation: Cek semua field, alasan min 50 karakter            │
│  • Loading State: Button disabled + spinner saat submit            │
│  • Prevent Double Submit: isSubmitting flag                        │
│  • Real-time Polling: Update kuota setiap 5 detik (SKIP jika      │
│    form disubmit)                                                   │
│  • Auto-redirect: Jika kuota habis SEBELUM submit                  │
│                                                                      │
└──────────────────────────────────────────────────────────────────────┘

                    Form Submit
                        ↓
            POST /pendaftaran/ (store)
                        ↓
        ┌───────────────────────────────┐
        │  Server Validation & Save     │
        └───────────────────────────────┘
                        ↓
            ┌──────────────────────┐
            │ Pendaftaran Valid?   │
            └──────────────────────┘
                   ↙         ↘
                 YES         NO
                  ↓          ↓
          ┌─────────────┐  Redirect Back
          │ Create DB   │  with Errors
          │ Record      │
          └─────────────┘
                  ↓
    Redirect to /pendaftaran/success
                  ↓
    ┌────────────────────────────────────┐
    │   SUCCESS PAGE (success.blade.php)  │
    │   ✓ Sukses! Pendaftaran diterima   │
    │   • ID Pendaftaran                 │
    │   • Nama                           │
    │   • NIM                            │
    │   • Semester                       │
    │   • Tanggal Daftar                 │
    │   • Next steps                     │
    │   [CEK STATUS PENDAFTARAN]         │
    └────────────────────────────────────┘
                  ↓
        User Menunggu Konfirmasi
                  ↓
    GET /pendaftaran/check-status
                  ↓
    ┌──────────────────────────────────────┐
    │  CHECK STATUS PAGE                   │
    │  Input: Email atau Nomor Registrasi  │
    │  [CARI]                              │
    └──────────────────────────────────────┘
                  ↓
        POST /pendaftaran/check-status
                  ↓
    GET /pendaftaran/status/{id}
                  ↓
    ┌──────────────────────────────────────┐
    │    STATUS TRACKING PAGE              │
    │    Thank You!                        │
    │    ──────────────────────────────────│
    │    Tahapan:                          │
    │    [✓] Submitted                     │
    │    [?] Under Review                  │
    │    [ ] Interview                     │
    │    [ ] Results Announcement          │
    │                                      │
    │    Nomor Registrasi: REG123...       │
    │    Tanggal Daftar: 2 Dec 2025        │
    └──────────────────────────────────────┘
```

---

## 2. State Flow Diagram

```
┌──────────────────────┐
│  USER STARTS HERE    │
│ (Klik Daftar)        │
└──────────────────────┘
          │
          ↓
    ┌──────────────────────────────────┐
    │ checkPendaftaranStatus()          │
    │ Cek: aktif? kuota? periode?      │
    └──────────────────────────────────┘
          │
          ├─ Pendaftaran BELUM DIBUKA
          │  └──→ coming-soon.blade.php
          │
          ├─ Pendaftaran DITUTUP
          │  └──→ closed.blade.php
          │
          ├─ Pendaftaran BERAKHIR
          │  └──→ ended.blade.php
          │
          ├─ KUOTA PENUH
          │  └──→ quota-full.blade.php
          │
          └─ SEMUANYA OK ✓
             └──→ create.blade.php
                    │
                    │ User Isi Form
                    ↓
             [ SUBMIT FORM ]
                    │
                    ├─ JavaScript Validation GAGAL
                    │  └──→ Alert + Focus Error
                    │       └──→ Form Tetap di Halaman Sama
                    │
                    └─ Validation BERHASIL
                       └──→ Set isSubmitting = true
                           Set formSubmitted = true
                           Disable button + Show spinner
                           └──→ POST /pendaftaran/
                               │
                               ├─ Server Validation GAGAL
                               │  └──→ Redirect Back dengan Errors
                               │       └──→ Form Tetap (dengan error msg)
                               │
                               └─ Server Validation BERHASIL
                                  └──→ Create Pendaftaran record
                                      └──→ Log activity
                                          └──→ Redirect to /pendaftaran/success
                                              └──→ success.blade.php ✓
                                                  │
                                                  └──→ User Lihat Detail
                                                      & Langkah Berikutnya
```

---

## 3. Data Flow: Form Submit

```
USER INTERFACE (Browser)
────────────────────────────────────

┌─────────────────────────────────────────┐
│ Form create.blade.php                   │
│ action="/pendaftaran/"                  │
│ method="POST"                           │
│ enctype="multipart/form-data"           │
└─────────────────────────────────────────┘
          │
          │ Collect Form Data:
          │ • nama, nim, semester, no_hp
          │ • alasan_mendaftar (min 50 char)
          │ • pengalaman, skill
          │ • dokumen (file upload)
          │ • agree (checkbox)
          │
          │ JavaScript Validation:
          │ • Check all required fields
          │ • Check alasan >= 50 chars
          │ • Disable double submission
          │ • Show loading spinner
          │
          ↓
NETWORK REQUEST
────────────────

POST /pendaftaran/
Host: localhost:8000
Content-Type: multipart/form-data
X-CSRF-TOKEN: {{ csrf_token() }}

Payload:
{
  _token: "xxxxx",
  nama: "John Doe",
  nim: "12345678",
  semester: 3,
  no_hp: "081234567890",
  alasan_mendaftar: "Saya ingin bergabung dengan HIMA-TI karena...",
  pengalaman: "...",
  skill: "...",
  dokumen: [File],
  agree: "on"
}

          │
          ↓
SERVER PROCESSING (PendaftaranController@store)
──────────────────────────────────────────────

1. CSRF Validation
   └─ Check X-CSRF-TOKEN

2. Input Validation
   ├─ Validate nama, nim, semester, no_hp
   ├─ Validate alasan_mendaftar (required, min:50)
   ├─ Validate dokumen (file, max:2MB)
   └─ Validate agree (required)

3. IF Validation FAILS
   └─ Return redirect()->back()
      ├─ withErrors($validator)
      ├─ withInput()
      └─ with('error', 'Terjadi kesalahan...')

4. IF Validation PASSES
   ├─ DB::beginTransaction()
   │
   ├─ Get/Create User
   │  └─ $user = auth()->user()
   │     OR Create new User with default email
   │
   ├─ Handle File Upload
   │  └─ Store file to storage/dokumen_pendaftaran/
   │
   ├─ Create Pendaftaran Record
   │  ├─ id_user: $user->id
   │  ├─ nim, nama, semester, no_hp
   │  ├─ alasan_mendaftar, pengalaman, skill
   │  ├─ dokumen: $dokumenPath
   │  ├─ status_pendaftaran: "pending"
   │  └─ submitted_at: now()
   │
   ├─ DB::commit()
   │
   ├─ Log Activity (spatie/activity-log)
   │  └─ "Mendaftar sebagai anggota HIMA TI"
   │
   ├─ Session Data
   │  └─ session([
   │      'success' => 'Pendaftaran berhasil dikirim!',
   │      'pendaftaran_id' => $pendaftaran->id_pendaftaran,
   │      'nama' => $pendaftaran->nama,
   │      'nim' => $pendaftaran->nim,
   │      'semester' => $pendaftaran->semester,
   │      'submitted_at' => $pendaftaran->submitted_at
   │    ])
   │
   └─ redirect()->route('pendaftaran.success')

          │
          ↓
RESPONSE
────────

HTTP/1.1 302 Found
Location: http://localhost:8000/pendaftaran/success
Set-Cookie: LARAVEL_SESSION=xxxxx

          │
          ↓
BROWSER
──────

1. Navigate to /pendaftaran/success
   
2. GET /pendaftaran/success
   └─ PendaftaranController@success()
      ├─ Check session('success')
      │  └─ if (NOT isset) → redirect to /pendaftaran/create
      │
      ├─ Get data from session:
      │  ├─ pendaftaran_id
      │  ├─ nama
      │  ├─ nim
      │  ├─ semester
      │  └─ submitted_at
      │
      └─ Return view('users.pendaftaran.success', $data)

3. Render success.blade.php
   ├─ Success Icon (✓)
   ├─ "Pendaftaran Anda Berhasil!"
   ├─ Detail Pendaftaran
   │  ├─ ID Pendaftaran: 12345
   │  ├─ Nama: John Doe
   │  ├─ NIM: 12345678
   │  ├─ Semester: 3
   │  └─ Tanggal Daftar: 2 Dec 2025 14:30
   │
   ├─ Next Steps
   │  ├─ Pantau email secara berkala
   │  ├─ Pastikan nomor HP aktif
   │  └─ Tunggu informasi verifikasi (1-3 hari kerja)
   │
   └─ [CEK STATUS PENDAFTARAN] button

          │
          ↓
SUCCESS ✓
────────
User melihat halaman sukses
```

---

## 4. Timeline: Sebelum vs Sesudah Fix

### ❌ SEBELUM (Ada Bug)
```
[User Isi Form] 
    ↓
[User Klik Submit]
    ↓
[Form Submit ke Server]
    ├─ Server: Processing...
    │
    ├─ Saat Form Diproses:
    │   └─ JavaScript Polling Setiap 5 Detik
    │      └─ Cek: is_quota_full?
    │      └─ IF YES → Redirect ke /pendaftaran/quota-full
    │      └─ ✗ MASALAH: Form Redirect SEBELUM Selesai Submit!
    │
    └─ Hasil: User Lihat Quota-Full Page
              BUKAN Success Page
              ✗ Pendaftaran TIDAK Masuk Database!
```

### ✅ SESUDAH (Fixed)
```
[User Isi Form]
    ↓
[User Klik Submit]
    ↓
[JavaScript Validation PASS]
    └─ Button Disabled + Show Spinner
    └─ formSubmitted = true (flag)
    └─ isSubmitting = true (flag)
    ↓
[Form POST /pendaftaran/]
    ├─ JavaScript Polling Setiap 5 Detik
    │  └─ if (formSubmitted) return; // SKIP checking!
    │  └─ ✓ Polling tidak mengganggu submission
    │
    └─ Server Processing (1-2 detik)
       ├─ Validation ✓
       ├─ Create Record ✓
       ├─ Log Activity ✓
       └─ Redirect to Success ✓
           ↓
       [SUCCESS PAGE]
       ✓ Pendaftaran Berhasil!
       ✓ Data Masuk Database
       ✓ User Lihat Konfirmasi
```

---

## 5. Perbandingan State

| Kondisi | Sebelum | Sesudah |
|---------|---------|---------|
| **Double Submit** | ✗ Bisa terjadi | ✓ Dicegah dengan flag |
| **Loading Feedback** | ✗ Tidak ada | ✓ Ada spinner |
| **Quota Polling** | ✗ Mengganggu submission | ✓ Skip saat submit |
| **Button State** | ✗ Tetap clickable | ✓ Disabled saat submit |
| **Redirect** | ✗ Bisa ke quota-full saat submit | ✓ Hanya ke success |
| **Console Log** | ✗ Tidak ada debug | ✓ Ada log untuk tracking |

---

## 6. Perubahan Kode

### Submit Button (create.blade.php)

**SEBELUM:**
```blade
<button type="submit" class="submit-button primary">
    <i class="fas fa-paper-plane button-icon"></i>
    <span class="button-text">Kirim Pendaftaran</span>
</button>
```

**SESUDAH:**
```blade
<button type="submit" class="submit-button primary" id="submitBtn">
    <i class="fas fa-paper-plane button-icon"></i>
    <span class="button-text">Kirim Pendaftaran</span>
</button>
```

### JavaScript Logic

**SEBELUM:**
```javascript
form.addEventListener('submit', function(e) {
    // ... validation ...
    if (!valid) e.preventDefault();
    // ✗ Tidak ada loading state
    // ✗ Bisa double submit
});

// Polling always active
setInterval(updateKuota, 5000);
```

**SESUDAH:**
```javascript
let isSubmitting = false;
let formSubmitted = false;

form.addEventListener('submit', function(e) {
    if (isSubmitting) {
        e.preventDefault();
        return; // ✓ Prevent double submit
    }
    
    // ... validation ...
    
    // ✓ Set flags & show loading
    isSubmitting = true;
    formSubmitted = true;
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin button-icon"></i>...';
});

// ✓ Polling aware of submission state
function updateKuota() {
    if (formSubmitted) return; // ✓ Skip if form submitted
    // ... fetch & update ...
}
```

