# 🖼️ VIEWS_STRUCTURE.md — Struktur Blade Views

> Struktur folder `resources/views` proyek **ULFAMUZA**, menggunakan arsitektur **Blade Layouts + Components + Pages**. Mencakup seluruh MVP berdasarkan use-case revisi tanpa Super Admin.

---

# ✅ Cakupan MVP

## 👤 Pengguna (Customer)

| UC | Use-Case | Covered |
|---|---|---|
| UC-1 | Melihat Layanan Katalog | ✅ |
| UC-2 | Melihat Pricelist | ✅ |
| UC-3 | Melihat Galeri Vendor | ✅ |
| UC-4 | Melihat Testimoni Katalog | ✅ |
| UC-5 | Melakukan Booking Layanan | ✅ |
| UC-6 | Redirect ke WhatsApp | ✅ |
| UC-7 | Memberikan Rating & Komentar | ✅ |

## 🛠️ Admin

| UC | Use-Case | Covered |
|---|---|---|
| UC-8 | Login & Logout | ✅ |
| UC-9 | Melihat Laporan & Statistik Booking | ✅ |
| UC-10 | Moderasi Rating & Komentar | ✅ |
| UC-11 | Mengelola Layanan Katalog | ✅ |
| UC-12 | Mengelola Data Layanan Pengguna | ✅ |
| UC-13 | Mengelola Status Booking | ✅ |
| UC-14 | Mengelola Galeri Katalog | ✅ |

---

# Arsitektur Blade

```bash
resources/views/
├── layouts/        # Master template
├── components/     # Komponen reusable
├── customer/       # Halaman customer/publik
└── admin/          # Halaman admin
```

---

# 📂 Struktur Lengkap

```bash
resources/views/
│
├── layouts/
│   ├── app.blade.php                    # Layout customer
│   └── admin.blade.php                  # Layout admin
│
├── components/
│   ├── navbar.blade.php                 # Navbar publik
│   ├── footer.blade.php                 # Footer publik
│   ├── sidebar-admin.blade.php          # Sidebar admin
│   ├── card-layanan.blade.php           # Card katalog layanan
│   ├── card-paket.blade.php             # Card pricelist/paket
│   ├── card-galeri.blade.php            # Card galeri
│   ├── badge-status.blade.php           # Badge status booking
│   ├── stat-card.blade.php              # Card statistik dashboard
│   └── rating-item.blade.php            # Item rating & komentar
│
├── customer/
│   │
│   ├── home/
│   │   └── index.blade.php              # Landing page
│   │
│   ├── katalog/
│   │   ├── index.blade.php              # [UC-1] Daftar layanan katalog
│   │   └── show.blade.php               # [UC-1] Detail layanan
│   │
│   ├── pricelist/
│   │   └── index.blade.php              # [UC-2] Halaman pricelist
│   │
│   ├── galeri/
│   │   └── index.blade.php              # [UC-3] Galeri vendor
│   │
│   ├── testimoni/
│   │   └── index.blade.php              # [UC-4] Testimoni katalog
│   │
│   ├── booking/
│   │   ├── form.blade.php               # [UC-5] Form booking
│   │   ├── konfirmasi.blade.php         # [UC-5] Konfirmasi booking
│   │   └── whatsapp.blade.php           # [UC-6] Redirect WhatsApp
│   │
│   └── rating/
│       └── form.blade.php               # [UC-7] Form rating & komentar
│
└── admin/
    │
    ├── auth/
    │   └── login.blade.php              # [UC-8] Login admin
    │
    ├── dashboard.blade.php              # [UC-9] Dashboard statistik
    │
    ├── booking/
    │   ├── index.blade.php              # [UC-13] Daftar booking
    │   └── show.blade.php               # [UC-13] Detail booking
    │
    ├── layanan/
    │   ├── index.blade.php              # [UC-11] Daftar layanan
    │   └── form.blade.php               # [UC-11] Form layanan
    │
    ├── galeri/
    │   ├── index.blade.php              # [UC-14] Daftar galeri
    │   └── form.blade.php               # [UC-14] Form galeri
    │
    ├── pelanggan/
    │   ├── index.blade.php              # [UC-12] Data pelanggan
    │   └── show.blade.php               # [UC-12] Detail pelanggan
    │
    ├── moderasi/
    │   └── index.blade.php              # [UC-10] Moderasi komentar
    │
    └── laporan/
        └── index.blade.php              # [UC-9] Statistik & laporan
```

---

# 👥 Pembagian Tugas — Frontend (Views)

---

## 🎨 Adelia Fioren Zety

**Area:** Halaman Publik Customer

| File | UC | Keterangan |
|---|---|---|
| `layouts/app.blade.php` | - | Layout customer |
| `components/navbar.blade.php` | - | Navbar publik |
| `components/footer.blade.php` | - | Footer publik |
| `components/card-layanan.blade.php` | UC-1 | Card layanan |
| `components/card-paket.blade.php` | UC-2 | Card pricelist/paket |
| `components/card-galeri.blade.php` | UC-3 | Card galeri |
| `customer/home/index.blade.php` | - | Landing page |
| `customer/katalog/index.blade.php` | UC-1 | Daftar layanan |
| `customer/katalog/show.blade.php` | UC-1 | Detail layanan |
| `customer/pricelist/index.blade.php` | UC-2 | Halaman pricelist |
| `customer/galeri/index.blade.php` | UC-3 | Galeri vendor |
| `customer/testimoni/index.blade.php` | UC-4 | Testimoni katalog |

---

## 📋 Danish Naisyila Azka

**Area:** Booking Customer

| File | UC | Keterangan |
|---|---|---|
| `customer/booking/form.blade.php` | UC-5 | Form booking layanan |
| `customer/booking/konfirmasi.blade.php` | UC-5 | Konfirmasi booking |
| `customer/booking/whatsapp.blade.php` | UC-6 | Redirect WhatsApp |
| `customer/rating/form.blade.php` | UC-7 | Form rating & komentar |
| `components/badge-status.blade.php` | UC-5, UC-13 | Badge status booking |
| `components/rating-item.blade.php` | UC-7 | Item rating & komentar |

---

## 🖥️ Ahmad Maulidin

**Area:** Dashboard, Booking & Statistik Admin

| File | UC | Keterangan |
|---|---|---|
| `layouts/admin.blade.php` | - | Layout admin |
| `components/sidebar-admin.blade.php` | - | Sidebar admin |
| `components/stat-card.blade.php` | UC-9 | Card statistik |
| `admin/auth/login.blade.php` | UC-8 | Login admin |
| `admin/dashboard.blade.php` | UC-9 | Dashboard admin |
| `admin/booking/index.blade.php` | UC-13 | Daftar booking |
| `admin/booking/show.blade.php` | UC-13 | Detail booking |
| `admin/laporan/index.blade.php` | UC-9 | Statistik booking |

---

## 🗂️ Nicko Sugiarto

**Area:** Kelola Konten Admin

| File | UC | Keterangan |
|---|---|---|
| `admin/layanan/index.blade.php` | UC-11 | Daftar layanan |
| `admin/layanan/form.blade.php` | UC-11 | Form layanan |
| `admin/galeri/index.blade.php` | UC-14 | Daftar galeri |
| `admin/galeri/form.blade.php` | UC-14 | Form galeri |
| `admin/pelanggan/index.blade.php` | UC-12 | Data pelanggan |
| `admin/pelanggan/show.blade.php` | UC-12 | Detail pelanggan |
| `admin/moderasi/index.blade.php` | UC-10 | Moderasi rating & komentar |

---

# 🔗 Konvensi

- File views menggunakan **kebab-case**
- Layout customer:
```blade
@extends('layouts.app')
```

- Layout admin:
```blade
@extends('layouts.admin')
```

- Komponen:
```blade
<x-card-layanan />
```

- Section content:
```blade
@section('content')
@endsection
```

---

# 📐 Contoh Blade

```blade
{{-- customer/katalog/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Katalog Layanan')

@section('content')
<div class="max-w-6xl mx-auto py-10">
    <h1 class="text-2xl font-bold mb-6">
        Katalog Layanan
    </h1>

    <div class="grid md:grid-cols-3 gap-6">
        @foreach ($layanans as $layanan)
            <x-card-layanan :layanan="$layanan" />
        @endforeach
    </div>
</div>
@endsection
```

```blade
{{-- admin/dashboard.blade.php --}}
@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')
<div class="grid grid-cols-2 lg:grid-cols-4 gap-6">

    <x-stat-card
        label="Total Booking"
        :value="$totalBooking"
    />

    <x-stat-card
        label="Booking Pending"
        :value="$pendingBooking"
    />

    <x-stat-card
        label="Booking Selesai"
        :value="$doneBooking"
    />

</div>
@endsection
```
