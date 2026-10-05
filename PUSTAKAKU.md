# 📚 PustakaKu — Sistem Informasi Perpustakaan

Aplikasi manajemen perpustakaan berbasis web + RESTful API untuk digitalisasi katalog buku, sirkulasi peminjaman, dan pelaporan otomatis.

---

## 📋 Daftar Isi

1. [Permasalahan yang Diangkat](#-permasalahan-yang-diangkat)
2. [Solusi yang Ditawarkan](#-solusi-yang-ditawarkan)
3. [Fitur](#-fitur)
4. [Teknologi](#-teknologi)
5. [Anggota Kelompok](#-anggota-kelompok)
6. [Cara Menjalankan Aplikasi](#-cara-menjalankan-aplikasi)
7. [Akun Pengujian](#-akun-pengujian)
8. [Struktur Database](#-struktur-database)
9. [API Documentation](#-api-documentation)
10. [HTTP Status Codes](#-http-status-codes)
11. [Testing API dengan Postman](#-testing-api-dengan-postman)
12. [Link Deployment](#-link-deployment)
13. [Video Dokumentasi](#-video-dokumentasi)
14. [Catatan Penting](#-catatan-penting)
15. [Lisensi](#-lisensi)

---

## 🎯 Permasalahan yang Diangkat

Perpustakaan sekolah/kampus masih menggunakan pencatatan manual yang:
- **Lambat** dan rawan kehilangan data
- **Sulit dipantau** ketersediaan buku secara real-time
- **Tidak ada reminder** pengembalian
- **Perhitungan denda manual** (rawan salah)
- **Tidak ada sistem terpusat** untuk anggota dan petugas

---

## 💡 Solusi yang Ditawarkan

**PustakaKu** menyelesaikan semua itu dengan:

- ✅ Sistem digital terpusat (Web + RESTful API)
- ✅ CRUD lengkap: Buku, Kategori, Anggota, Peminjaman
- ✅ Perhitungan **denda otomatis** (Rp 1.000/hari)
- ✅ **Search & Filter** untuk pencarian cepat
- ✅ **Role-based access**: admin, staff, user
- ✅ **RESTful API** dengan Sanctum untuk integrasi aplikasi lain (mobile/SPA)
- ✅ **Validasi Form Request** + **API Resource** untuk response konsisten
- ✅ **Pagination** di semua endpoint list

---

## ✨ Fitur

### 🌐 Web (Blade + Tailwind)

- 🔐 **Auth** — Login & Register (Breeze)
- 📊 **Dashboard** — 4 stat card (Buku, Anggota, Peminjaman Aktif, Terlambat) + tabel peminjaman terbaru
- 📁 **CRUD Kategori** — tambah, edit, hapus, list
- 📖 **CRUD Buku** — dengan upload cover, search, filter by kategori
- 👥 **CRUD Anggota** — data lengkap (NIS/NIM, email, telepon, alamat, status)
- 🔄 **CRUD Peminjaman** — catat pinjam + tombol "Kembalikan" otomatis hitung denda
- 💰 **Denda Otomatis** — Rp 1.000 × hari terlambat
- 📱 **Responsive** — desktop & mobile

### 📡 API (RESTful + Sanctum Bearer Token)

- 🔑 **Auth** — register, login, logout, me (return JSON + token)
- 📚 **CRUD Books, Categories, Members, Loans**
- 🔄 **Endpoint pengembalian** — `POST /api/loans/{id}/return` (hitung denda otomatis)
- 📄 **API Resource** — response JSON konsisten
- ✅ **Form Request** — validasi server-side
- 📊 **Pagination + Search/Filter** di semua list endpoint

---

## 🛠 Teknologi

| Layer | Teknologi |
|---|---|
| **Backend** | Laravel 13 |
| **Frontend** | Blade + Tailwind CSS + Alpine.js |
| **Database** | MySQL / MariaDB |
| **Auth Web** | Laravel Breeze |
| **Auth API** | Laravel Sanctum (Bearer Token) |
| **ORM** | Eloquent |
| **Build Tool** | Vite |
| **PHP** | >= 8.2 |

---

## 👥 Anggota Kelompok

| Nama | NIM | Job Desk |
|---|---|---|
| Iven Rival Pangestu | H1H024013 | Setup + Auth + CRUD Buku + API Books |
| Javier Anthonio Justiansah | xxxxx | CRUD Anggota + Dashboard + API Members |
| Pandu Adi Utama | xxxxx | CRUD Peminjaman + API Loans |
| (Anggota 4) | xxxxx | CRUD Kategori + API Categories |

---

## 🚀 Cara Menjalankan Aplikasi

### Prasyarat

- PHP >= 8.2
- Composer >= 2.7
- Node.js >= 18
- MySQL / MariaDB

### Langkah Instalasi

```bash
# 1. Clone repository
git clone https://github.com/Ivenrp/Responsi1-Pemweb2.git
cd Responsi1-Pemweb2

# 2. Install dependencies
composer install
npm install

# 3. Setup environment
cp .env.example .env
php artisan key:generate

# 4. Konfigurasi database di .env:
# DB_CONNECTION=mysql
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=pustakaku
# DB_USERNAME=root
# DB_PASSWORD=

# 5. Buat database "pustakaku" di MySQL/HeidiSQL

# 6. Migrate & seed (data dummy)
php artisan migrate --seed

# 7. Build frontend
npm run build

# 8. Jalankan server
php artisan serve
```

Buka `http://127.0.0.1:8000`

### Untuk Development (Hot Reload)

Buka **2 terminal**:

**Terminal 1:**
```bash
php artisan serve
```

**Terminal 2:**
```bash
npm run dev
```

> ⚠️ Untuk development, **DUA TERMINAL HARUS JALAN BARENG**. Kalau salah satu mati, CSS/JS tidak ke-load → halaman tampak blank.

---

## 🔑 Akun Pengujian

| Role | Email | Password |
|---|---|---|
| **Admin** | `admin@pustakaku.test` | `password123` |
| **Staff** | `staff@pustakaku.test` | `password123` |
| **User** | `user@pustakaku.test` | `password123` |

---

## 📁 Struktur Database

| Tabel | Deskripsi | Relationship |
|---|---|---|
| `users` | User login (admin/staff/user) | — |
| `categories` | Kategori buku | `hasMany` → books |
| `books` | Data buku | `belongsTo` → categories; `hasMany` → loans |
| `members` | Data anggota | `hasMany` → loans |
| `loans` | Transaksi peminjaman | `belongsTo` → members, books |
| `personal_access_tokens` | Token API (Sanctum) | — |

**Relasi Utama (2 relationship):**
1. **One-to-Many**: `Category hasMany Books` / `Book belongsTo Category`
2. **One-to-Many**: `Member hasMany Loans` / `Loan belongsTo Member`
3. **One-to-Many**: `Book hasMany Loans` / `Loan belongsTo Book`

---

## 📡 API Documentation

**Base URL:**
- **Local:** `http://127.0.0.1:8000/api`
- **Production:** `https://pustakaku.up.railway.app/api` _(update setelah deploy)_

**Authentication:** Bearer Token (Laravel Sanctum)

```
Accept: application/json
Authorization: Bearer <token>
```

### 🔐 Autentikasi

| Method | Endpoint | Keterangan | Auth |
|---|---|---|---|
| POST | `/auth/register` | Register user baru | ❌ No |
| POST | `/auth/login` | Login, dapat Bearer Token | ❌ No |
| POST | `/auth/logout` | Logout (hapus token) | ✅ Yes |
| GET | `/auth/me` | Get user yang login | ✅ Yes |

**Contoh Login:**
```http
POST /api/auth/login
Content-Type: application/json

{
  "email": "admin@pustakaku.test",
  "password": "password123"
}
```

**Response (200):**
```json
{
  "message": "Login berhasil",
  "user": {
    "id": 1,
    "name": "Admin PustakaKu",
    "email": "admin@pustakaku.test",
    "role": "admin"
  },
  "token": "1|abc123xyz..."
}
```

### 📚 Books

| Method | Endpoint | Keterangan | Auth |
|---|---|---|---|
| GET | `/books` | List buku + pagination | ✅ |
| GET | `/books?search=laskar` | Cari buku | ✅ |
| GET | `/books?category_id=1` | Filter kategori | ✅ |
| GET | `/books/{id}` | Detail buku | ✅ |
| POST | `/books` | Tambah buku | ✅ |
| PUT | `/books/{id}` | Update buku | ✅ |
| DELETE | `/books/{id}` | Hapus buku | ✅ |

### 📁 Categories

| Method | Endpoint | Keterangan | Auth |
|---|---|---|---|
| GET | `/categories` | List kategori | ✅ |
| POST | `/categories` | Tambah kategori | ✅ |
| PUT | `/categories/{id}` | Update | ✅ |
| DELETE | `/categories/{id}` | Hapus | ✅ |

### 👥 Members

| Method | Endpoint | Keterangan | Auth |
|---|---|---|---|
| GET | `/members` | List anggota | ✅ |
| POST | `/members` | Tambah anggota | ✅ |
| PUT | `/members/{id}` | Update | ✅ |
| DELETE | `/members/{id}` | Hapus | ✅ |

### 🔄 Loans

| Method | Endpoint | Keterangan | Auth |
|---|---|---|---|
| GET | `/loans` | List peminjaman | ✅ |
| POST | `/loans` | Catat peminjaman | ✅ |
| POST | `/loans/{id}/return` | **Kembalikan** (hitung denda) | ✅ |
| PUT | `/loans/{id}` | Update | ✅ |
| DELETE | `/loans/{id}` | Hapus | ✅ |

---

## 🚨 HTTP Status Codes

| Code | Keterangan |
|---|---|
| 200 | OK — Request berhasil |
| 201 | Created — Data berhasil dibuat |
| 401 | Unauthorized — Token tidak valid |
| 403 | Forbidden — Tidak punya akses |
| 404 | Not Found — Data tidak ditemukan |
| 422 | Unprocessable Entity — Validasi gagal |
| 500 | Internal Server Error |

---

## 🧪 Testing API dengan Postman

**Step 1 — Login:**
- Method: `POST`
- URL: `http://127.0.0.1:8000/api/auth/login`
- Headers: `Accept: application/json`, `Content-Type: application/json`
- Body: `{"email":"admin@pustakaku.test","password":"password123"}`
- Copy token dari response

**Step 2 — Setup Auth:**
- Tab **Authorization** → **Bearer Token**
- Paste token

**Step 3 — Test:**
- Method: `GET`
- URL: `http://127.0.0.1:8000/api/books`
- Send

### Testing dengan PowerShell

```powershell
$body = @{ email = 'admin@pustakaku.test'; password = 'password123' } | ConvertTo-Json
$login = Invoke-RestMethod -Uri 'http://127.0.0.1:8000/api/auth/login' -Method POST -Body $body -ContentType 'application/json' -Headers @{ 'Accept' = 'application/json' }
$headers = @{ 'Accept' = 'application/json'; 'Authorization' = "Bearer $($login.token)" }
Invoke-RestMethod -Uri 'http://127.0.0.1:8000/api/books' -Headers $headers | ConvertTo-Json -Depth 5
```

---

## 🌐 Link Deployment

- **Production:** `https://pustakaku.up.railway.app` _(update setelah deploy)_
- **GitHub:** [Ivenrp/Responsi1-Pemweb2](https://github.com/Ivenrp/Responsi1-Pemweb2)

---

## 🎬 Video Dokumentasi

| Nama | Fitur | Link |
|---|---|---|
| Iven Rival Pangestu | Buku + API Books | [YouTube](https://youtu.be/xxxxx) |
| Javier Anthonio Justiansah | Anggota + API Members | [YouTube](https://youtu.be/xxxxx) |
| Pandu Adi Utama | Peminjaman + API Loans | [YouTube](https://youtu.be/xxxxx) |
| (Anggota 4) | Kategori + API Categories | [YouTube](https://youtu.be/xxxxx) |

---

## 📌 Catatan Penting

1. **Web vs API:**
   - Web (`/books`, `/categories`) → untuk browser (Blade + session)
   - API (`/api/books`, `/api/categories`) → untuk aplikasi lain (Bearer Token)

2. **JANGAN akses `/api/...` di browser** tanpa token → dapat `{"message":"Unauthenticated."}`

3. **Setup development:** buka **2 terminal**:
   - `php artisan serve` (port 8000)
   - `npm run dev` (port 5173)

4. **Denda** otomatis dihitung saat buku dikembalikan (Rp 1.000/hari terlambat).

5. **Pagination** default 10 item/halaman. Custom: `?per_page=20`.

---

## 📝 Lisensi

MIT License — Praktikum Pemrograman Web II 2026