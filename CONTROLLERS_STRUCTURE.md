# ⚙️ CONTROLLERS_STRUCTURE.md — Struktur Controllers

> Struktur folder `app/Http/Controllers` proyek **ULFAMUZA**, dengan pemisahan namespace **Admin** dan **Customer**. Mencakup seluruh MVP berdasarkan dokumen use-case revisi.

---

## ✅ Cakupan MVP

### 👤 Pengguna (Customer)

| UC | Use-Case | Controller |
|---|---|---|
| UC-1 | Melihat Layanan Katalog | `Customer/KatalogController` |
| UC-2 | Melihat Pricelist | `Customer/PricelistController` |
| UC-3 | Melihat Galeri Vendor | `Customer/GaleriController` |
| UC-4 | Melihat Testimoni Katalog | `Customer/TestimoniController` |
| UC-5 | Melakukan Booking Layanan | `Customer/BookingController` |
| UC-6 | Redirect ke WhatsApp | `Customer/BookingController` |
| UC-7 | Memberikan Rating & Komentar | `Customer/RatingController` |

### 🛠️ Admin

| UC | Use-Case | Controller |
|---|---|---|
| UC-8 | Login & Logout | `Auth/AdminLoginController` |
| UC-9 | Melihat Laporan & Statistik Booking | `Admin/DashboardController` · `Admin/LaporanController` |
| UC-10 | Moderasi Rating & Komentar | `Admin/ModerasiController` |
| UC-11 | Mengelola Layanan Katalog | `Admin/LayananController` |
| UC-12 | Mengelola Data Layanan Pengguna | `Admin/PelangganController` |
| UC-13 | Mengelola Status Booking | `Admin/BookingController` |
| UC-14 | Mengelola Galeri Katalog | `Admin/GaleriController` |

---

## Arsitektur Controller

```bash
app/Http/Controllers/
├── Auth/           # Login & Logout Admin
├── Admin/          # Panel Admin
└── Customer/       # Halaman Customer/Publik
```

Setiap controller mengikuti konvensi **Resource Controller Laravel** (`index`, `create`, `store`, `show`, `edit`, `update`, `destroy`) di mana relevan.

---

# 📂 Struktur Lengkap

```bash
app/Http/Controllers/
│
├── Auth/
│   └── AdminLoginController.php         # [UC-8] Login & Logout Admin
│
├── Admin/
│   ├── DashboardController.php          # [UC-9] Dashboard admin
│   ├── BookingController.php            # [UC-13] Kelola status booking
│   ├── LayananController.php            # [UC-11] Kelola layanan katalog
│   ├── GaleriController.php             # [UC-14] Kelola galeri katalog
│   ├── PelangganController.php          # [UC-12] Kelola data layanan pengguna
│   ├── ModerasiController.php           # [UC-10] Moderasi rating & komentar
│   └── LaporanController.php            # [UC-9] Statistik & laporan booking
│
└── Customer/
    ├── HomeController.php               # Landing page
    ├── KatalogController.php            # [UC-1] Lihat katalog layanan
    ├── PricelistController.php          # [UC-2] Lihat pricelist layanan
    ├── GaleriController.php             # [UC-3] Lihat galeri vendor
    ├── TestimoniController.php          # [UC-4] Lihat testimoni katalog
    ├── BookingController.php            # [UC-5][UC-6] Booking & WhatsApp
    └── RatingController.php             # [UC-7] Rating & komentar
```

---

# 👥 Pembagian Tugas — Backend (Controllers)

---

## 🔐 Yushril Huda Ramadhany S

**Area:** Login Admin · Dashboard · Statistik Booking

| File | UC | Method Utama | Keterangan |
|---|---|---|---|
| `Auth/AdminLoginController.php` | UC-8 | `showLogin`, `login`, `logout` | Login & logout admin |
| `Admin/DashboardController.php` | UC-9 | `index` | Dashboard admin |
| `Admin/LaporanController.php` | UC-9 | `index`, `export` | Statistik & laporan booking |

---

## 🗄️ Nicko Sugiarto

**Area:** Konten Admin & Galeri

| File | UC | Method Utama | Keterangan |
|---|---|---|---|
| `Admin/LayananController.php` | UC-11 | `index`, `create`, `store`, `edit`, `update`, `destroy` | CRUD layanan katalog |
| `Admin/GaleriController.php` | UC-14 | `index`, `create`, `store`, `edit`, `update`, `destroy` | CRUD galeri layanan |

---

## 📊 Ahmad Maulidin

**Area:** Booking, Pelanggan & Moderasi

| File | UC | Method Utama | Keterangan |
|---|---|---|---|
| `Admin/BookingController.php` | UC-13 | `index`, `show`, `updateStatus` | Kelola status booking |
| `Admin/PelangganController.php` | UC-12 | `index`, `show` | Kelola data layanan pengguna |
| `Admin/ModerasiController.php` | UC-10 | `index`, `approve`, `reject` | Moderasi rating & komentar |

---

## 🛒 Danish Naisyila Azka

**Area:** Booking Customer

| File | UC | Method Utama | Keterangan |
|---|---|---|---|
| `Customer/BookingController.php` | UC-5 | `create`, `store`, `konfirmasi` | Form & proses booking |
| `Customer/BookingController.php` | UC-6 | `redirectWhatsApp` | Redirect customer ke WhatsApp admin |
| `Customer/PricelistController.php` | UC-2 | `index` | Menampilkan pricelist layanan |

---

## 🌐 Adelia Fioren Zety

**Area:** Halaman Publik Customer

| File | UC | Method Utama | Keterangan |
|---|---|---|---|
| `Customer/HomeController.php` | - | `index` | Landing page |
| `Customer/KatalogController.php` | UC-1 | `index`, `show` | Lihat katalog layanan |
| `Customer/GaleriController.php` | UC-3 | `index` | Lihat galeri vendor |
| `Customer/TestimoniController.php` | UC-4 | `index` | Lihat testimoni katalog |
| `Customer/RatingController.php` | UC-7 | `store` | Memberikan rating & komentar |

---

# 🔗 Konvensi & Standar Kode

## Penamaan

- Controller: **PascalCase** + suffix `Controller`
- Method: **camelCase**
- Validasi: gunakan **Form Request** di `app/Http/Requests/`

---

## Middleware

| Middleware | Berlaku Pada |
|---|---|
| `auth:admin` | Semua route Admin |

---

# Contoh routes/web.php

```php
// Customer Routes
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/katalog', [KatalogController::class, 'index'])->name('katalog.index');
Route::get('/katalog/{id}', [KatalogController::class, 'show'])->name('katalog.show');

Route::get('/pricelist', [PricelistController::class, 'index'])->name('pricelist.index');

Route::get('/galeri', [GaleriController::class, 'index'])->name('galeri.index');

Route::get('/testimoni', [TestimoniController::class, 'index'])->name('testimoni.index');

Route::get('/booking/create', [CustomerBookingController::class, 'create'])->name('booking.create');
Route::post('/booking/store', [CustomerBookingController::class, 'store'])->name('booking.store');

Route::get('/booking/{id}/whatsapp', [CustomerBookingController::class, 'redirectWhatsApp'])->name('booking.whatsapp');

Route::post('/rating/store', [RatingController::class, 'store'])->name('rating.store');


// Admin Routes
Route::prefix('admin')->middleware('auth:admin')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    Route::resource('/layanan', LayananController::class);

    Route::resource('/galeri', GaleriController::class);

    Route::resource('/booking', BookingController::class)->only([
        'index',
        'show'
    ]);

    Route::patch('/booking/{id}/status',
        [BookingController::class, 'updateStatus']
    );

    Route::get('/pelanggan',
        [PelangganController::class, 'index']
    );

    Route::get('/pelanggan/{id}',
        [PelangganController::class, 'show']
    );

    Route::get('/moderasi',
        [ModerasiController::class, 'index']
    );

    Route::patch('/moderasi/{id}/approve',
        [ModerasiController::class, 'approve']
    );

    Route::patch('/moderasi/{id}/reject',
        [ModerasiController::class, 'reject']
    );

    Route::get('/laporan',
        [LaporanController::class, 'index']
    );
});
```

---

# 📦 Model & Tabel

| Model | Tabel | Use-Case |
|---|---|---|
| `LayananKatalog` | `layanan_katalogs` | UC-1, UC-11 |
| `Pricelist` | `pricelists` | UC-2 |
| `Galeri` | `galeris` | UC-3, UC-14 |
| `Booking` | `bookings` | UC-5, UC-13 |
| `Rating` | `ratings` | UC-7, UC-10 |
| `Komentar` | `komentars` | UC-7, UC-10 |
| `Pelanggan` | `pelanggans` | UC-12 |
| `Laporan` | `laporans` | UC-9 |
