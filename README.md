# 📔 Reception - Sistem Buku Tamu & Dashboard Prioritas

Sistem Manajemen Buku Tamu Digital yang dirancang dengan estetika premium dan fitur deteksi kepentingan cerdas. Proyek ini dibangun menggunakan **Laravel 11**, **Tailwind CSS**, dan **Vite** untuk memberikan pengalaman pengguna yang modern dan responsif.

---

## 🚀 Fitur Utama

### 👤 Untuk Pengunjung
- **Formulir Kunjungan Elegan**: Antarmuka bersih dengan transisi halus.
- **Fitur "Welcome Back"**: Deteksi otomatis nomor HP untuk mengisi nama dan institusi secara instan bagi tamu yang pernah berkunjung sebelumnya.
- **Status Checkout**: Tamu dapat melakukan checkout mandiri hanya dengan menggunakan nomor HP.

### 🛡️ Untuk Administrator
- **Dashboard Statistik Real-time**: Visualisasi data kunjungan 7 hari terakhir dan statistik domisili institusi menggunakan **Chart.js**.
- **Smart Priority Detection**: Sistem secara otomatis mendeteksi kata kunci sensitif (seperti: *Mendesak, VIP, Masalah, Darurat*) dan mengirimkan notifikasi ke panel admin.
- **Notification Drawer (Papan Pin)**: Panel samping untuk melihat tugas/tamu penting secara real-time tanpa berpindah halaman.
- **Laporan Kunjungan**: Filter laporan berdasarkan periode (Minggu, Bulan, Tahun).
- **Export to CSV (Excel Friendly)**: Fitur ekspor data yang sudah dioptimasi agar langsung rapi saat dibuka di Microsoft Excel (mendukung UTF-8 dan pemisah kolom otomatis).
- **Autentikasi Aman**: Menggunakan Laravel Breeze untuk sistem login dan registrasi admin.

---

## 🛠️ Teknologi yang Digunakan

- **Framework**: [Laravel 11](https://laravel.com)
- **Styling**: [Tailwind CSS](https://tailwindcss.com)
- **Frontend Logic**: [Alpine.js](https://alpinejs.dev)
- **Charting**: [Chart.js](https://www.chartjs.org/)
- **Build Tool**: [Vite](https://vitejs.dev)
- **Database**: MySQL / MariaDB

---

## 📦 Langkah-langkah Instalasi

Ikuti langkah berikut untuk menjalankan project ini di komputer lokal Anda (disarankan menggunakan **Laragon** atau **XAMPP**):

### 1. Clone Repository
```bash
git clone https://github.com/alvindeo/Buku_Tamu.git
cd Buku_Tamu
```

### 2. Instalasi Dependency (Composer & NPM)
```bash
composer install
npm install
```

### 3. Konfigurasi Environment
Salin file `.env.example` menjadi `.env`:
```bash
cp .env.example .env
```
Buka file `.env` dan sesuaikan pengaturan database Anda:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_database_anda
DB_USERNAME=root
DB_PASSWORD=

# Pastikan Timezone sudah Asia/Jakarta
APP_TIMEZONE=Asia/Jakarta
```

### 4. Generate Key & Migration
```bash
php artisan key:generate
php artisan migrate
```

### 5. Compile Aset & Jalankan Server
Buka dua terminal berbeda:

**Terminal 1 (Vite):**
```bash
npm run dev
```

**Terminal 2 (Laravel):**
```bash
php artisan serve
```

Aplikasi dapat diakses melalui: `http://127.0.0.1:8000`

---

## 📸 Tampilan Dashboard
Proyek ini mengusung palet warna premium:
- **Primary Red**: `#A31D1D`
- **Deep Maroon**: `#6D2323`
- **Tan/Gold**: `#E5D0AC`
- **Cream**: `#FEF9E1`

---

## 📄 Lisensi
Proyek ini dibuat untuk keperluan magang/internship dan penggunaan edukasi.

---
*Dibuat dengan ❤️ oleh [Alvindeo](https://github.com/alvindeo)*
