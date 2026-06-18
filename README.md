# NEKOYA - Cosplay Rental

![Laravel](https://img.shields.io/badge/Laravel-10-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-3-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-Ready-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![Status](https://img.shields.io/badge/Status-Active-success?style=for-the-badge)

Sistem NEKOYA Cosplay Rental adalah platform penyewaan kostum cosplay berbasis web yang digunakan untuk mengelola proses pemesanan, pembayaran, dan manajemen kostum secara digital.

---

## Navigasi

- [NEKOYA - Cosplay Rental](#nekoya---cosplay-rental)
  - [Navigasi](#navigasi)
  - [Tautan Project](#tautan-project)
  - [Tentang Project](#tentang-project)
  - [Preview Singkat](#preview-singkat)
  - [Fitur](#fitur)
    - [Untuk Penyewa](#untuk-penyewa)
    - [Untuk Admin](#untuk-admin)
    - [Sistem](#sistem)
  - [Status Project](#status-project)
  - [Batasan](#batasan)
  - [Tech Stack](#tech-stack)
  - [Persyaratan](#persyaratan)
  - [Instalasi](#instalasi)
  - [Akun Demo](#akun-demo)
  - [Struktur Database](#struktur-database)
  - [Halaman Utama](#halaman-utama)
  - [Penutup](#penutup)

---

## Tautan Project

- Website: NEKOYA Cosplay Rental
- Laporan: Sistem Informasi
- Demo: Video Presentasi

---

## Tentang Project

NEKOYA dikembangkan untuk mempermudah proses penyewaan kostum cosplay dari sistem manual menjadi sistem berbasis web.

Pengguna dapat melakukan pemesanan kostum, mengelola keranjang, dan melakukan pembayaran secara online. Admin dapat mengelola data kostum, transaksi, serta verifikasi pembayaran.

---

## Preview Singkat

| Area | Fungsi |
|------|--------|
| Penyewa | Booking, checkout, pembayaran, riwayat |
| Admin | Manajemen kostum, transaksi, verifikasi |
| Sistem | Pengelolaan data terintegrasi |

---

## Fitur

### Untuk Penyewa

- Registrasi dan login
- Melihat katalog kostum
- Detail kostum
- Keranjang penyewaan
- Checkout pemesanan
- Upload bukti pembayaran
- Riwayat penyewaan
- Pengaturan profil dan preferensi

---

### Untuk Admin

- Dashboard admin
- CRUD kostum dan kategori
- Manajemen penyewaan
- Verifikasi pembayaran
- Update status penyewaan
- Manajemen pengguna

---

### Sistem

- Role admin dan user
- Sistem keranjang dan checkout
- Validasi stok kostum
- Upload bukti pembayaran
- Status transaksi terstruktur

---

## Status Project

| Modul | Status |
|-------|--------|
| Authentication |  Aktif |
| Katalog Kostum |  Aktif |
| Keranjang |  Aktif |
| Checkout |  Aktif |
| Pembayaran |  Aktif |
| Admin Panel |  Aktif |
| Riwayat Penyewaan |  Aktif |

---

## Batasan

- Tidak menggunakan payment gateway otomatis
- Pembayaran masih manual (upload bukti transfer)
- Tidak ada sistem pengiriman
- Notifikasi belum real time

---

## Tech Stack

| Layer | Teknologi |
|-------|-----------|
| Backend | Laravel 10 |
| Frontend | Blade + Tailwind CSS |
| UI | Alpine.js |
| Database | MySQL |
| Build Tool | Vite |
| Authentication | Laravel Breeze |
| Storage | Laravel Storage |
| Deployment | Railway atau VPS |

---

## Persyaratan

- PHP 8 atau lebih baru
- Composer
- Node.js dan npm
- MySQL
- Git

---

## Instalasi

### 1. Clone Project

```bash
git clone https://github.com/username/nekoya.git
cd nekoya
```

### 2. Install Dependency

```bash
composer install
npm install
```

### 3. Setup Environment

```bash
cp .env.example .env
php artisan key:generate
```

### 4. Database Setup

Edit file `.env` dan sesuaikan konfigurasi database:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nekoya
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Migration dan Seeder

```bash
php artisan migrate --seed
php artisan storage:link
```

### 6. Jalankan Aplikasi

```bash
php artisan serve
npm run dev
```

---

## Akun Demo

| Role | Username | Password |
|------|----------|----------|
| Admin | admin | admin123 |
| User | alli | 12345678 |

---

## Struktur Database

**Tabel:**

- users
- categories
- costumes
- costume_images
- carts
- cart_items
- orders
- order_items
- payments
- user_addresses

**Relasi:**

```
users       → orders
users       → carts
orders      → order_items
orders      → payments
costumes    → categories
carts       → cart_items
```

---

## Halaman Utama

| Halaman | Keterangan |
|---------|------------|
| `/` | Home |
| `/katalog` | Katalog kostum |
| `/cart` | Keranjang |
| `/checkout` | Checkout |
| `/payment` | Pembayaran |
| `/riwayat` | Riwayat penyewaan |
| `/profile` | Profil user |
| `/admin` | Dashboard admin |

---

## Penutup

NEKOYA Cosplay Rental adalah sistem penyewaan kostum berbasis web untuk mempermudah proses pemesanan, pembayaran, dan pengelolaan kostum secara digital.
