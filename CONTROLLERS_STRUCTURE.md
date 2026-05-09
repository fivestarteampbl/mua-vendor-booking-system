# ⚙️ CONTROLLERS_STRUCTURE.md — Struktur Controllers

> Struktur folder `app/Http/Controllers` proyek **ULFAMUZA**, dengan pemisahan namespace **Admin**, **SuperAdmin**, dan **Customer**. Mencakup seluruh MVP berdasarkan dokumen use-case (Laporan Class & Objek TRPL-2D).

---

## ✅ Cakupan MVP (Berdasarkan Dokumen Use-Case PDF)

### 👤 Pengguna (Customer)
| UC | Use-Case | Controller |
|---|---|---|
| UC-1 | Melihat Layanan Katalog & Pricelist | `Customer/KatalogController` · `Customer/PricelistController` |
| UC-2 | Melihat Galeri Vendor | `Customer/GaleriController` |
| UC-3 | Melakukan Booking | `Customer/BookingController` |
| UC-4 | Login & Register Customer | `Auth/CustomerAuthController` |

### 🛠️ Admin
| UC | Use-Case | Controller |
|---|---|---|
| UC-5 | Melihat Laporan & Statistik Booking | `Admin/DashboardController` · `Admin/LaporanController` |
| UC-6 | Moderasi Rating & Komentar | `Admin/ModerasiController` |
| UC-7 | Mengelola Layanan Katalog | `Admin/LayananController` |
| UC-8 | Mengelola Data Pelanggan | `Admin/PelangganController` |
| UC-9 | Mengelola Status Booking | `Admin/BookingController` |
| UC-10 | Mengelola Galeri Layanan | `Admin/GaleriController` |
| UC-11 | Notifikasi Admin | `Admin/NotifikasiController` |
| UC-12 | Kalender Jadwal Booking | `Admin/KalenderController` |

### 👑 Super Admin
| UC | Use-Case | Controller |
|---|---|---|
| UC-13 | Melihat Log Aktivitas | `SuperAdmin/LogAktivitasController` |
| UC-14 | Mengatur Konfigurasi Website | `SuperAdmin/KonfigurasiController` |
| UC-15 | Mengelola Akun Admin | `SuperAdmin/AdminController` |
| UC-16 | Mengatur Hak Akses & Role | `SuperAdmin/HakAksesController` |

---

## Arsitektur Controller

```
app/Http/Controllers/
├── Auth/           # Autentikasi (login, logout, register)
├── Admin/          # Panel Admin
├── SuperAdmin/     # Panel Super Admin
└── Customer/       # Halaman Customer/Publik
```

Setiap controller mengikuti konvensi **Resource Controller** Laravel (`index`, `create`, `store`, `show`, `edit`, `update`, `destroy`) di mana relevan.

---

## 📂 Struktur Lengkap

```
app/Http/Controllers/
│
├── Auth/
│   ├── AdminLoginController.php            # Login/Logout admin & super admin
│   └── CustomerAuthController.php          # Login/Register/Logout customer
│
├── Admin/
│   ├── DashboardController.php             # [UC-5]  Dashboard admin
│   ├── BookingController.php               # [UC-9]  Kelola status booking
│   ├── LayananController.php               # [UC-7]  Kelola layanan katalog (CRUD)
│   ├── GaleriController.php                # [UC-10] Kelola galeri layanan (CRUD + upload)
│   ├── PelangganController.php             # [UC-8]  Kelola data pelanggan
│   ├── ModerasiController.php              # [UC-6]  Moderasi rating & komentar
│   ├── LaporanController.php               # [UC-5]  Laporan & statistik booking
│   ├── NotifikasiController.php            # [UC-11] Kelola notifikasi admin
│   └── KalenderController.php              # [UC-12] Kalender jadwal booking
│
├── SuperAdmin/
│   ├── DashboardController.php             # Dashboard super admin
│   ├── AdminController.php                 # [UC-15] Kelola akun admin (CRUD)
│   ├── HakAksesController.php              # [UC-16] Atur hak akses & role
│   ├── KonfigurasiController.php           # [UC-14] Konfigurasi website
│   └── LogAktivitasController.php          # [UC-13] Log aktivitas sistem
│
└── Customer/
    ├── HomeController.php                  # Landing page / beranda
    ├── KatalogController.php               # [UC-1] Lihat katalog & detail layanan
    ├── PricelistController.php             # [UC-1] Lihat pricelist layanan
    ├── GaleriController.php                # [UC-2] Lihat galeri vendor
    └── BookingController.php               # [UC-3] Proses booking, pembayaran, konfirmasi
```

---

## 👥 Pembagian Tugas — Backend (Controllers)

---

### 🔐 Yushril Huda Ramadhany S
**Area:** UC-13 · UC-14 · UC-15 · UC-16 · Auth · Super Admin

| File | UC | Method Utama | Keterangan |
|---|---|---|---|
| `Auth/AdminLoginController.php` | - | `showLogin`, `login`, `logout` | Auth admin & super admin |
| `Auth/CustomerAuthController.php` | UC-4 | `showLogin`, `login`, `showRegister`, `register`, `logout` | Auth customer |
| `SuperAdmin/DashboardController.php` | - | `index` | Dashboard super admin |
| `SuperAdmin/AdminController.php` | UC-15 | `index`, `create`, `store`, `edit`, `update`, `destroy` | CRUD akun admin |
| `SuperAdmin/HakAksesController.php` | UC-16 | `index`, `edit`, `update` | Atur role & permission user |
| `SuperAdmin/KonfigurasiController.php` | UC-14 | `edit`, `update` | Update konfigurasi website (nama, email, WA, kontak) |
| `SuperAdmin/LogAktivitasController.php` | UC-13 | `index` | Tampilkan log aktivitas sistem |

---

### 🗄️ Nicko Sugiarto
**Area:** UC-6 · UC-7 · UC-8 · UC-10 · UC-11 · Konten Admin

| File | UC | Method Utama | Keterangan |
|---|---|---|---|
| `Admin/LayananController.php` | UC-7 | `index`, `create`, `store`, `edit`, `update`, `destroy` | CRUD layanan katalog |
| `Admin/GaleriController.php` | UC-10 | `index`, `create`, `store`, `edit`, `update`, `destroy` | CRUD galeri + upload foto ke storage |
| `Admin/PelangganController.php` | UC-8 | `index`, `show` | Lihat data & riwayat booking pelanggan |
| `Admin/ModerasiController.php` | UC-6 | `index`, `approve`, `reject`, `destroy` | Moderasi rating & komentar |
| `Admin/NotifikasiController.php` | UC-11 | `index`, `markRead`, `markAllRead` | Kelola notifikasi admin |

---

### 📊 Ahmad Maulidin
**Area:** UC-5 · UC-9 · UC-12 · Dashboard, Booking & Laporan

| File | UC | Method Utama | Keterangan |
|---|---|---|---|
| `Admin/DashboardController.php` | UC-5 | `index` | Hitung & tampilkan statistik (total, hari ini, pending, selesai) |
| `Admin/BookingController.php` | UC-9 | `index`, `show`, `updateStatus` | Daftar booking, detail, ubah status |
| `Admin/LaporanController.php` | UC-5 | `index`, `export` | Laporan statistik booking; export PDF/Excel |
| `Admin/KalenderController.php` | UC-12 | `index`, `getEvents` | Kalender jadwal booking (format JSON untuk kalender) |

---

### 🛒 Danish Naisyila Azka
**Area:** UC-1 (Pricelist) · UC-3 · Alur Booking Customer

| File | UC | Method Utama | Keterangan |
|---|---|---|---|
| `Customer/BookingController.php` | UC-3 | `create`, `store`, `pembayaran`, `uploadBukti`, `konfirmasi` | Form booking → pembayaran → upload bukti → status konfirmasi |
| `Customer/PricelistController.php` | UC-1 | `index` | Tampilkan halaman pricelist layanan |

---

### 🌐 Adelia Fioren Zety
**Area:** UC-1 · UC-2 · Halaman Publik Customer

| File | UC | Method Utama | Keterangan |
|---|---|---|---|
| `Customer/HomeController.php` | - | `index` | Landing page — ambil layanan unggulan & galeri terbaru |
| `Customer/KatalogController.php` | UC-1 | `index`, `show` | Daftar katalog layanan; detail layanan + paket |
| `Customer/GaleriController.php` | UC-2 | `index` | Tampilkan galeri vendor |

---

## 🔗 Konvensi & Standar Kode

### Penamaan
- Controller: **PascalCase** + suffix `Controller`
- Method: **camelCase**, ikuti konvensi resource Laravel
- Validasi: gunakan **Form Request** di `app/Http/Requests/`

### Middleware

| Middleware | Berlaku Pada |
|---|---|
| `auth:customer` | Route Customer yang butuh login (booking) |
| `auth:admin` | Semua route Admin |
| `auth:superadmin` | Semua route Super Admin |

### Contoh routes/web.php

```php
// Customer Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/katalog', [KatalogController::class, 'index'])->name('katalog.index');
Route::get('/katalog/{id}', [KatalogController::class, 'show'])->name('katalog.show');
Route::get('/pricelist', [PricelistController::class, 'index'])->name('pricelist');
Route::get('/galeri', [GaleriController::class, 'index'])->name('galeri');

Route::middleware('auth:customer')->group(function () {
    Route::get('/booking/create', [CustomerBookingController::class, 'create'])->name('booking.create');
    Route::post('/booking', [CustomerBookingController::class, 'store'])->name('booking.store');
    Route::get('/booking/{id}/pembayaran', [CustomerBookingController::class, 'pembayaran']);
    Route::post('/booking/{id}/bukti', [CustomerBookingController::class, 'uploadBukti']);
    Route::get('/booking/{id}/konfirmasi', [CustomerBookingController::class, 'konfirmasi']);
});

// Admin Routes
Route::middleware('auth:admin')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('booking', BookingController::class)->only(['index', 'show']);
    Route::patch('booking/{id}/status', [BookingController::class, 'updateStatus'])->name('booking.status');
    Route::resource('layanan', LayananController::class);
    Route::resource('galeri', GaleriController::class);
    Route::get('pelanggan', [PelangganController::class, 'index'])->name('pelanggan.index');
    Route::get('pelanggan/{id}', [PelangganController::class, 'show'])->name('pelanggan.show');
    Route::get('moderasi', [ModerasiController::class, 'index'])->name('moderasi.index');
    Route::patch('moderasi/{id}/approve', [ModerasiController::class, 'approve']);
    Route::patch('moderasi/{id}/reject', [ModerasiController::class, 'reject']);
    Route::get('laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('laporan/export', [LaporanController::class, 'export'])->name('laporan.export');
    Route::get('notifikasi', [NotifikasiController::class, 'index'])->name('notifikasi.index');
    Route::get('kalender', [KalenderController::class, 'index'])->name('kalender.index');
});

// Super Admin Routes
Route::middleware('auth:superadmin')->prefix('superadmin')->name('superadmin.')->group(function () {
    Route::get('/dashboard', [SuperAdmin\DashboardController::class, 'index'])->name('dashboard');
    Route::resource('admin', SuperAdmin\AdminController::class);
    Route::get('hak-akses', [HakAksesController::class, 'index'])->name('hak-akses.index');
    Route::patch('hak-akses/{id}', [HakAksesController::class, 'update'])->name('hak-akses.update');
    Route::get('konfigurasi', [KonfigurasiController::class, 'edit'])->name('konfigurasi.edit');
    Route::patch('konfigurasi', [KonfigurasiController::class, 'update'])->name('konfigurasi.update');
    Route::get('log', [LogAktivitasController::class, 'index'])->name('log.index');
});
```

---

### Contoh Implementasi Controller

```php
<?php
// app/Http/Controllers/Admin/BookingController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    // [UC-9] Daftar semua booking — Maulidin
    public function index()
    {
        $bookings = Booking::with('pelanggan', 'layanan')
            ->latest()->paginate(15);
        return view('admin.booking.index', compact('bookings'));
    }

    // [UC-9] Detail booking — Maulidin
    public function show(Booking $booking)
    {
        return view('admin.booking.show', compact('booking'));
    }

    // [UC-9] Update status booking — Maulidin
    public function updateStatus(Request $request, Booking $booking)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,completed,rejected',
        ]);
        $booking->update(['status' => $request->status]);
        return redirect()->back()->with('success', 'Status booking berhasil diperbarui.');
    }
}
```

```php
<?php
// app/Http/Controllers/Customer/BookingController.php
namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    // [UC-3] Form booking — Azka
    public function create()
    {
        return view('customer.booking.form');
    }

    // [UC-3] Simpan booking — Azka
    public function store(Request $request)
    {
        $request->validate([
            'email'           => 'required|email',
            'tanggal_booking' => 'required|date|after:today',
            'layanan_id'      => 'required|exists:layanan_katalogs,id',
            'pricelist_id'    => 'required|exists:pricelists,id',
        ]);

        $booking = Booking::create([
            ...$request->only('email', 'tanggal_booking', 'layanan_id', 'pricelist_id'),
            'user_id' => auth()->id(),
            'status'  => 'pending',
        ]);

        return redirect()->route('booking.pembayaran', $booking->id);
    }

    // [UC-3] Halaman pembayaran — Azka
    public function pembayaran(Booking $booking)
    {
        return view('customer.booking.pembayaran', compact('booking'));
    }

    // [UC-3] Upload bukti pembayaran — Azka
    public function uploadBukti(Request $request, Booking $booking)
    {
        $request->validate(['bukti' => 'required|image|max:2048']);
        $path = $request->file('bukti')->store('bukti-pembayaran', 'public');
        $booking->pembayaran()->update(['bukti_transfer' => $path]);
        return redirect()->route('booking.konfirmasi', $booking->id);
    }

    // [UC-3] Halaman konfirmasi — Azka
    public function konfirmasi(Booking $booking)
    {
        return view('customer.booking.konfirmasi', compact('booking'));
    }
}
```

---

## 📦 Model & Tabel (Berdasarkan Entity dari PDF)

| Model | Tabel | Stereotype | Use-Case |
|---|---|---|---|
| `User` | `users` | Entity | UC-4, UC-16 |
| `Admin` | `admins` | Entity | UC-15 |
| `Role` | `roles` | Entity | UC-16 |
| `HakAkses` | `hak_akses` | Entity | UC-16 |
| `LayananKatalog` | `layanan_katalogs` | Entity | UC-1, UC-7 |
| `DetailLayanan` | `detail_layanans` | Entity | UC-1, UC-7 |
| `Pricelist` | `pricelists` | Entity | UC-1 |
| `Booking` | `bookings` | Entity | UC-3, UC-5, UC-9 |
| `Pembayaran` | `pembayarans` | Entity | UC-3 |
| `Galeri` | `galeris` | Entity | UC-2, UC-10 |
| `Foto` | `fotos` | Entity | UC-10 |
| `Rating` | `ratings` | Entity | UC-6 |
| `Komentar` | `komentars` | Entity | UC-6 |
| `Laporan` | `laporans` | Entity | UC-5 |
| `StatistikBooking` | `statistik_bookings` | Entity | UC-5 |
| `LogAktivitas` | `log_aktivitas` | Entity | UC-13 |
| `KonfigurasiWebsite` | `konfigurasi_websites` | Entity | UC-14 |
| `Notifikasi` | `notifikasis` | Entity | UC-11 |
