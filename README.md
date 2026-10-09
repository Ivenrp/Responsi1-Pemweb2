# PustakaKu
> Sistem Informasi Perpustakaan (Web + RESTful API)

---

## 📌 Informasi Kelompok
- **Nomor Kelompok:** [3]
- **Shift Praktikum:** [C]

---

## 👥 Anggota Kelompok

| No | Nama Lengkap | NIM | Shift Awal | Shift Akhir | Jobdesk / Kontribusi | Link Video Penjelasan |
|---|---|---|---|---|---|---|
| 1 | Iven Rival Pangestu | H1H024013 | A | C | Setup + Auth + CRUD Buku & Kategori + API Books & Categories | https://youtu.be/isCqwNeAPhw |
| 2 | Javier Anthonio Justiansah | [H1H024026] | A | C | Backend API (CRUD Anggota & Suspend Logic) + Middleware IsAdmin + Role Management | https://youtu.be/8vjm3727pw8 |
| 3 | Pandu Adi Utama | [Isi NIM] | A | C | Frontend Integration (Role UI & Routing) + Dashboard + CRUD Anggota | https://drive.google.com/drive/folders/1e1aPEms229LGfnEJxuzHONP4IlHfDyDg?usp=drive_link |

---

## 📖 Deskripsi Aplikasi
PustakaKu adalah aplikasi manajemen perpustakaan yang dibangun untuk mendigitalisasi sistem perpustakaan tradisional. Aplikasi ini bertujuan mengatasi masalah pencatatan manual yang lambat, perhitungan denda manual yang rawan salah, dan tidak adanya pemantauan ketersediaan buku secara *real-time*. Dengan PustakaKu, admin dan petugas dapat memonitor sirkulasi buku secara terpusat, sementara sistem API (RESTful) yang disediakan memungkinkan integrasi yang mudah dengan *platform* lain di masa mendatang.

---

## ⚙️ Penjelasan Teknis

### 1. Teknologi (Tech Stack)
- **Backend:** Laravel 13 (PHP 8.2+)
- **Frontend:** Blade / Tailwind CSS / Alpine.js
- **Database:** MySQL / MariaDB
- **Library / Package:** Laravel Breeze (Auth Web), Laravel Sanctum (Auth API Bearer Token)

### 2. Fitur Utama & Modul
- **Autentikasi & Otorisasi:** Sistem otentikasi web & API dengan *role-based access* (Admin, Staff, User).
- **Modul Katalog (Buku & Kategori):** CRUD data kategori dan buku dengan validasi (*Form Request*), fitur *upload* gambar, serta fungsi *Search & Filter*.
- **Modul Anggota & Sirkulasi (Peminjaman):** Manajemen data anggota dan transaksi peminjaman (termasuk fitur *Suspend* anggota). Dilengkapi algoritma **perhitungan denda otomatis** (Rp 1.000/hari) saat buku dikembalikan.

### 3. Skema Data Singkat
- `categories` (1 : N) `books`
- `members` (1 : N) `loans`
- `books` (1 : N) `loans`

---

## 🚀 Panduan Instalasi Lokal

```bash
# Clone repository
git clone https://github.com/Ivenrp/Responsi1-Pemweb2.git
cd Responsi1-Pemweb2

# Install dependensi PHP & Node
composer install
npm install

# Konfigurasi Environment
cp .env.example .env
php artisan key:generate

# Konfigurasi database di file .env, lalu migrasi & seed
# Pastikan sudah membuat database "pustakaku" di MySQL
php artisan migrate --seed

# Jalankan development server (Buka 2 Terminal)
php artisan serve
npm run dev
```
