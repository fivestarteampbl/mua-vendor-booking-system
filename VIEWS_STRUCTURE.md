# 🖼️ VIEWS_STRUCTURE.md — Struktur Blade Views

> Struktur folder `resources/views` proyek **ULFAMUZA**, menggunakan arsitektur **Blade Layouts + Components + Pages**. Mencakup seluruh MVP berdasarkan dokumen use-case (Laporan Class & Objek TRPL-2D).

---

## ✅ Cakupan MVP (Berdasarkan Dokumen Use-Case PDF)

### 👤 Pengguna (Customer)
| UC | Use-Case | Covered |
|---|---|---|
| UC-1 | Melihat Layanan Katalog & Pricelist | ✅ |
| UC-2 | Melihat Galeri Vendor | ✅ |
| UC-3 | Melakukan Booking (form → pembayaran → konfirmasi) | ✅ |
| UC-4 | Login & Register Customer | ✅ |

### 🛠️ Admin
| UC | Use-Case | Covered |
|---|---|---|
| UC-5 | Melihat Laporan & Statistik Booking | ✅ |
| UC-6 | Moderasi Rating & Komentar | ✅ |
| UC-7 | Mengelola Layanan Katalog | ✅ |
| UC-8 | Mengelola Data Pelanggan | ✅ |
| UC-9 | Mengelola Status Booking | ✅ |
| UC-10 | Mengelola Galeri Layanan | ✅ |
| UC-11 | Notifikasi Admin | ✅ |
| UC-12 | Kalender Jadwal Booking | ✅ |

### 👑 Super Admin
| UC | Use-Case | Covered |
|---|---|---|
| UC-13 | Melihat Log Aktivitas | ✅ |
| UC-14 | Mengatur Konfigurasi Website | ✅ |
| UC-15 | Mengelola Akun Admin | ✅ |
| UC-16 | Mengatur Hak Akses & Role | ✅ |

---

## Arsitektur Blade

```
resources/views/
├── layouts/        # Master template
├── components/     # Komponen UI reusable
├── customer/       # Halaman Customer/Publik
├── admin/          # Halaman Admin
└── superadmin/     # Halaman Super Admin
```

---

## 📂 Struktur Lengkap

```
resources/views/
│
├── layouts/
│   ├── app.blade.php                       # Layout customer (Navbar + Footer)
│   └── admin.blade.php                     # Layout admin/superadmin (Sidebar + Header)
│
├── components/
│   ├── navbar.blade.php                    # Navbar publik (Logo, Menu, Login)
│   ├── footer.blade.php                    # Footer publik (copyright, kontak)
│   ├── sidebar-admin.blade.php             # Sidebar navigasi admin
│   ├── card-layanan.blade.php              # Card katalog layanan
│   ├── card-paket.blade.php                # Card pilihan paket
│   ├── card-galeri.blade.php               # Card foto galeri
│   ├── badge-status.blade.php              # Badge status booking
│   ├── stat-card.blade.php                 # Card statistik dashboard
│   └── notification-item.blade.php         # Item notifikasi
│
├── customer/
│   ├── auth/
│   │   ├── login.blade.php                 # [UC-4] Login customer
│   │   └── register.blade.php              # [UC-4] Registrasi customer
│   │
│   ├── home/
│   │   └── index.blade.php                 # Landing page / Beranda
│   │
│   ├── katalog/
│   │   ├── index.blade.php                 # [UC-1] Daftar katalog layanan
│   │   ├── show.blade.php                  # [UC-1] Detail layanan + pilihan paket
│   │   └── pricelist.blade.php             # [UC-1] Halaman daftar harga
│   │
│   ├── galeri/
│   │   └── index.blade.php                 # [UC-2] Galeri vendor
│   │
│   └── booking/
│       ├── form.blade.php                  # [UC-3] Form input booking
│       ├── pembayaran.blade.php            # [UC-3] Halaman pembayaran
│       └── konfirmasi.blade.php            # [UC-3] Halaman konfirmasi/status booking
│
├── admin/
│   ├── auth/
│   │   └── login.blade.php                 # Login admin
│   │
│   ├── dashboard.blade.php                 # [UC-5] Dashboard (statistik & activity)
│   │
│   ├── booking/
│   │   ├── index.blade.php                 # [UC-9] Daftar booking (HalamanStatusBooking)
│   │   └── show.blade.php                  # [UC-9] Detail booking (DetailBookingUI)
│   │
│   ├── layanan/
│   │   ├── index.blade.php                 # [UC-7] Daftar layanan katalog
│   │   └── form.blade.php                  # [UC-7] Form tambah/edit/hapus layanan
│   │
│   ├── galeri/
│   │   ├── index.blade.php                 # [UC-10] Daftar galeri layanan
│   │   └── form.blade.php                  # [UC-10] Form tambah/edit/hapus galeri
│   │
│   ├── pelanggan/
│   │   ├── index.blade.php                 # [UC-8] Daftar data pelanggan
│   │   └── show.blade.php                  # [UC-8] Detail + riwayat booking pelanggan
│   │
│   ├── moderasi/
│   │   └── index.blade.php                 # [UC-6] Moderasi rating & komentar
│   │
│   ├── laporan/
│   │   └── index.blade.php                 # [UC-5] Laporan & statistik booking
│   │
│   ├── notifikasi/
│   │   └── index.blade.php                 # [UC-11] Notifikasi admin
│   │
│   └── kalender/
│       └── index.blade.php                 # [UC-12] Kalender jadwal booking
│
└── superadmin/
    ├── dashboard.blade.php                 # Dashboard super admin
    │
    ├── admin/
    │   ├── index.blade.php                 # [UC-15] Daftar akun admin
    │   └── form.blade.php                  # [UC-15] Form tambah/edit admin
    │
    ├── hak-akses/
    │   └── form.blade.php                  # [UC-16] Form atur hak akses & role
    │
    ├── konfigurasi/
    │   └── form.blade.php                  # [UC-14] Form konfigurasi website
    │
    └── log/
        └── index.blade.php                 # [UC-13] Log aktivitas sistem
```

---

## 👥 Pembagian Tugas — Frontend (Views)

---

### 🎨 Adelia Fioren Zety
**Area:** UC-1 · UC-2 · UC-4 · Halaman Publik Customer

| File | UC | Keterangan |
|---|---|---|
| `layouts/app.blade.php` | - | Master layout customer |
| `components/navbar.blade.php` | - | Navbar publik |
| `components/footer.blade.php` | - | Footer publik |
| `components/card-layanan.blade.php` | UC-1 | Card katalog layanan |
| `components/card-paket.blade.php` | UC-1 | Card pilihan paket dalam detail layanan |
| `components/card-galeri.blade.php` | UC-2 | Card foto galeri |
| `customer/auth/login.blade.php` | UC-4 | Login customer |
| `customer/auth/register.blade.php` | UC-4 | Registrasi customer |
| `customer/home/index.blade.php` | - | Landing page / beranda |
| `customer/katalog/index.blade.php` | UC-1 | Daftar katalog layanan |
| `customer/katalog/show.blade.php` | UC-1 | Detail layanan + pilihan paket |
| `customer/katalog/pricelist.blade.php` | UC-1 | Halaman pricelist |
| `customer/galeri/index.blade.php` | UC-2 | Halaman galeri vendor |

---

### 📋 Danish Naisyila Azka
**Area:** UC-3 · Alur Booking Customer

| File | UC | Keterangan |
|---|---|---|
| `customer/booking/form.blade.php` | UC-3 | Form input data booking |
| `customer/booking/pembayaran.blade.php` | UC-3 | Halaman pembayaran & upload bukti |
| `customer/booking/konfirmasi.blade.php` | UC-3 | Halaman konfirmasi / status booking |
| `components/badge-status.blade.php` | UC-3, UC-9 | Badge status booking |

---

### 🖥️ Ahmad Maulidin
**Area:** UC-5 · UC-9 · UC-12 · Dashboard, Booking & Laporan Admin

| File | UC | Keterangan |
|---|---|---|
| `layouts/admin.blade.php` | - | Master layout admin |
| `components/sidebar-admin.blade.php` | - | Sidebar navigasi admin |
| `components/stat-card.blade.php` | UC-5 | Card statistik dashboard |
| `components/notification-item.blade.php` | UC-11 | Item list notifikasi |
| `admin/auth/login.blade.php` | - | Login admin |
| `admin/dashboard.blade.php` | UC-5 | Dashboard admin (statistik & activity) |
| `admin/booking/index.blade.php` | UC-9 | Daftar semua booking |
| `admin/booking/show.blade.php` | UC-9 | Detail booking + update status |
| `admin/laporan/index.blade.php` | UC-5 | Laporan & statistik booking |
| `admin/kalender/index.blade.php` | UC-12 | Kalender jadwal booking |

---

### 🗂️ Nicko Sugiarto
**Area:** UC-6 · UC-7 · UC-8 · UC-10 · UC-11 · Kelola Konten Admin

| File | UC | Keterangan |
|---|---|---|
| `admin/layanan/index.blade.php` | UC-7 | Daftar layanan katalog |
| `admin/layanan/form.blade.php` | UC-7 | Form tambah/edit/hapus layanan |
| `admin/galeri/index.blade.php` | UC-10 | Daftar galeri layanan |
| `admin/galeri/form.blade.php` | UC-10 | Form tambah/edit/hapus galeri + upload foto |
| `admin/pelanggan/index.blade.php` | UC-8 | Daftar data pelanggan |
| `admin/pelanggan/show.blade.php` | UC-8 | Detail pelanggan + riwayat booking |
| `admin/moderasi/index.blade.php` | UC-6 | Moderasi rating & komentar |
| `admin/notifikasi/index.blade.php` | UC-11 | Halaman notifikasi admin |

---

### 🔐 Yushril Huda Ramadhany S
**Area:** UC-13 · UC-14 · UC-15 · UC-16 · Panel Super Admin

| File | UC | Keterangan |
|---|---|---|
| `superadmin/dashboard.blade.php` | - | Dashboard super admin |
| `superadmin/admin/index.blade.php` | UC-15 | Daftar akun admin |
| `superadmin/admin/form.blade.php` | UC-15 | Form tambah/edit akun admin |
| `superadmin/hak-akses/form.blade.php` | UC-16 | Form atur hak akses (Role, User, Permission) |
| `superadmin/konfigurasi/form.blade.php` | UC-14 | Form konfigurasi website (nama, email, WA, kontak) |
| `superadmin/log/index.blade.php` | UC-13 | Halaman log aktivitas sistem |

---

## 🔗 Konvensi

- File views: **lowercase + hyphen** (`kebab-case`)
- Komponen: `<x-nama-komponen />` atau `@include('components.nama')`
- Customer: `@extends('layouts.app')`
- Admin & Super Admin: `@extends('layouts.admin')`
- Isi konten: `@section('content') ... @endsection`

---

## 📐 Contoh Blade

```blade
{{-- customer/katalog/index.blade.php --}}
@extends('layouts.app')
@section('title', 'Katalog Layanan - ULFAMUZA')
@section('content')
    <div class="max-w-4xl mx-auto px-6 py-10">
        <h2 class="font-poly text-2xl text-dark-brown mb-6">Pilih Layanan Kami</h2>
        @foreach ($layananList as $layanan)
            <x-card-layanan :layanan="$layanan" />
        @endforeach
    </div>
@endsection
```

```blade
{{-- admin/dashboard.blade.php --}}
@extends('layouts.admin')
@section('title', 'Dashboard Admin - ULFAMUZA')
@section('content')
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <x-stat-card label="Booking Terbaru"  :value="$statTotal"   icon="calendar-plus" />
        <x-stat-card label="Booking Hari Ini" :value="$statToday"   icon="clock"         />
        <x-stat-card label="Booking Pending"  :value="$statPending" icon="alert-circle"  />
        <x-stat-card label="Booking Selesai"  :value="$statDone"    icon="check-circle"  />
    </div>
@endsection
```
