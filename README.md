# 💄 ULFAMUZA — Sistem Informasi Pemesanan MUA & Vendor Acara

> Sistem informasi berbasis web untuk pemesanan layanan **Make Up Artist (MUA)** dan **Vendor Acara** milik Ulfa Muzayyina, Banyuwangi.

---

## 📋 Tentang Proyek

**ULFAMUZA** adalah sistem informasi berbasis web yang dirancang untuk membantu proses promosi dan pemesanan layanan Make Up Artist (MUA) serta vendor acara milik Ulfa Muzayyina di Banyuwangi.

Sistem ini memungkinkan pelanggan untuk melihat katalog layanan, pricelist, galeri hasil makeup, hingga melakukan booking layanan secara online dengan lebih mudah dan efisien. Selain itu, pelanggan juga dapat memberikan rating dan komentar sebagai bentuk testimoni terhadap layanan yang telah digunakan.

Di sisi admin, sistem menyediakan fitur pengelolaan data layanan, galeri katalog, status booking pelanggan, serta moderasi komentar dan rating agar informasi yang ditampilkan tetap terorganisir dengan baik.

Dengan adanya sistem ini, proses pemesanan layanan MUA yang sebelumnya dilakukan secara manual melalui chat dapat menjadi lebih terstruktur, cepat, dan mudah diakses oleh pelanggan kapan saja.

Sistem ini dikembangkan oleh **Tim FiveStarTeam** kelas TRPL-2D di bawah bimbingan **Lutfi Hakim, S.Pd., M.T.** untuk client **Ulfa Muzayyina**.

### Tim Pengembang

| No | Nama | Pembagian Tugas |
|---|---|---|
| 1 | Yushril Huda Ramadhany S | Melihat Laporan & Statistik Booking, Login & Logout |
| 2 | Nicko Sugiarto | Mengelola Layanan Katalog, Mengelola Galeri Katalog |
| 3 | Ahmad Maulidin | Mengelola Data Layanan Pengguna, Mengelola Status Booking, Moderasi Rating & Komentar |
| 4 | Danish Naisyila Azka | Melakukan Booking Layanan, Redirect ke WhatsApp |
| 5 | Adelia Fioren Zety | Melihat Layanan Katalog, Melihat Pricelist, Melihat Galeri Vendor, Melihat Testimoni Katalog |

---

## 🗺️ Cakupan MVP

Sistem memiliki **2 aktor** dan **11 use-case** inti:

### 👤 Pengguna (Customer)

- Melihat Layanan Katalog
- Melihat Pricelist
- Melihat Galeri Vendor
- Melihat Testimoni Katalog
- Melakukan Booking Layanan
- Redirect ke WhatsApp
- Memberikan Rating & Komentar

### 🛠️ Admin

- Login & Logout
- Melihat Laporan & Statistik Booking
- Moderasi Rating & Komentar
- Mengelola Layanan Katalog
- Mengelola Data Layanan Pengguna
- Mengelola Status Booking
- Mengelola Galeri Katalog

---

## 🧰 Tech Stack

| Layer | Teknologi |
|---|---|
| Backend Framework | Laravel 11 |
| Language | PHP 8.2 |
| Frontend Styling | Tailwind CSS v3 |
| Template Engine | Blade (Laravel) |
| Icons | Lucide Icons |
| Font | Poppins, Poly (Google Fonts) |
| Web Server | Nginx |
| Database | MySQL 8 |
| Package Manager | Composer, NPM |

### Palet Warna UI

| Nama | HEX | Kegunaan |
|---|---|---|
| `pearly` | `#F9F6F1` | Background utama |
| `blush` | `#E1C1B6` | Aksen / highlight / card |
| `dark` | `#5A4A42` | Teks utama |
| `warm-taupe` | `#8E7E73` | Footer & elemen sekunder |

---

## 🚀 Cara Instalasi

### Prasyarat

- PHP >= 8.2
- Composer >= 2.x
- Node.js >= 18.x & NPM
- MySQL >= 8.0
- Nginx (production) atau `php artisan serve` (development)

---

### Langkah Instalasi

**1. Clone repositori**
```bash
git clone https://github.com/fivestarteampbl/mua-vendor-booking-system.git
cd ulfamuza
```

**2. Install dependensi PHP**
```bash
composer install
```

**3. Install dependensi Node / Tailwind**
```bash
npm install
```

**4. Salin dan konfigurasi environment**
```bash
cp .env.example .env
```

Edit `.env` sesuai konfigurasi lokal:
```env
APP_NAME="ULFAMUZA"
APP_ENV=local
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ulfamuza_db
DB_USERNAME=root
DB_PASSWORD=

MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
```

**5. Generate application key**
```bash
php artisan key:generate
```

**6. Jalankan migrasi & seeder**
```bash
php artisan migrate --seed
```

**7. Buat symbolic link storage (foto galeri)**
```bash
php artisan storage:link
```

**8. Build aset Tailwind**
```bash
# Development (watch mode)
npm run dev

# Production
npm run build
```

**9. Jalankan server development**
```bash
php artisan serve
```

Akses di: `http://localhost:8000`

---

### Konfigurasi Nginx (Production)

```nginx
server {
    listen 80;
    server_name ulfamuza.com www.ulfamuza.com;
    root /var/www/ulfamuza/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    index index.php;
    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

---

## 🔐 Role & Akses

| Role | Deskripsi Akses |
|---|---|
| **Pengguna / Customer** | Lihat katalog, galeri, testimoni, pricelist; booking & pembayaran, memberikan Rating & Komentar |
| **Admin** | Kelola booking, layanan, galeri, pelanggan; moderasi rating & komentar; notifikasi; kalender |

---

## 📁 Struktur Direktori Utama

```
ulfamuza/
├── app/
│   ├── Http/
│   │   ├── Controllers/        # Lihat CONTROLLERS_STRUCTURE.md
│   │   ├── Middleware/
│   │   └── Requests/
│   ├── Models/
│   └── ...
├── resources/
│   └── views/                  # Lihat VIEWS_STRUCTURE.md
├── routes/
│   └── web.php
├── database/
│   ├── migrations/
│   └── seeders/
├── public/
│   └── assets/images/
└── storage/
    └── app/public/             # Foto galeri (via storage:link)
```

---

## 📄 Dokumentasi Lainnya

- [`VIEWS_STRUCTURE.md`](./VIEWS_STRUCTURE.md) — Struktur Blade views & pembagian tugas frontend
- [`CONTROLLERS_STRUCTURE.md`](./CONTROLLERS_STRUCTURE.md) — Struktur Controllers & pembagian tugas backend

---

*Copyright © 2026 ULFAMUZA MUA — Banyuwangi, Jawa Timur*
