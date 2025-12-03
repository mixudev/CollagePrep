# 📋 README - TUGAS UTS E-LEARNING

## Informasi Tugas

**Mata Kuliah:** E-Learning  
**Dosen:** Syams Kurniawan Hidayat  
**Semester/Kelas:** 5/F, 5/G, 5/H, 5/I  
**Tugas:** Implementasi Sistem Setelah Desain UI/UX dan Perancangan Database

---

## 📁 Struktur File Tugas

### File yang Harus Dikumpulkan

1. **Dokumentasi API**
   - `DOKUMENTASI-API.postman_collection.json` - Postman Collection untuk testing API
   - Dapat diimport ke Postman untuk testing endpoint

2. **Dokumentasi Individu**
   - `DOKUMENTASI-INDIVIDU.md` - Dokumentasi lengkap 3-5 halaman
   - Berisi: deskripsi sistem, implementasi, flowchart, tantangan, kesimpulan

3. **Panduan Screenshot**
   - `PANDUAN-SCREENSHOT.md` - Panduan untuk mengambil screenshot
   - Daftar screenshot yang diperlukan beserta penjelasan

4. **Folder Screenshots**
   - `screenshots/` - Folder berisi semua screenshot
   - Minimal 3 screenshot halaman utama
   - Screenshot fitur individu tambahan

5. **Source Code**
   - Folder project Laravel lengkap
   - Semua file source code backend dan frontend

6. **Database Script**
   - File SQL untuk struktur database (jika ada perubahan)
   - Atau gunakan Laravel migrations yang sudah ada

---

## 🚀 Cara Menjalankan Project

### Prerequisites
- PHP 8.2 atau lebih tinggi
- Composer
- MySQL/PostgreSQL
- Node.js dan NPM

### Installation

1. **Clone atau download project**
   ```bash
   cd APPS
   ```

2. **Install dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Setup environment**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Konfigurasi database di `.env`**
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=elearning_db
   DB_USERNAME=root
   DB_PASSWORD=
   ```

5. **Run migrations dan seeders**
   ```bash
   php artisan migrate
   php artisan db:seed
   ```

6. **Link storage**
   ```bash
   php artisan storage:link
   ```

7. **Build assets**
   ```bash
   npm run build
   ```

8. **Jalankan server**
   ```bash
   php artisan serve
   ```

9. **Akses aplikasi**
   - URL: `http://localhost:8000`
   - Login Admin: (cek di `database/seeders/UserSeeder.php`)
   - Login Student: (cek di `database/seeders/UserSeeder.php`)

---

## 📊 Struktur Database

Database menggunakan MySQL/PostgreSQL dengan struktur:

- **users** - Data pengguna (admin & student)
- **categories** - Kategori mata pelajaran
- **modules** - Paket tryout/ujian
- **questions** - Bank soal
- **question_options** - Pilihan jawaban
- **student_modules** - Progress pengerjaan
- **student_answers** - Jawaban siswa
- **rankings** - Sistem peringkat
- **student_analytics** - Analisis performa
- **learning_progress** - Progress belajar harian
- **achievements** - Master pencapaian
- **notifications** - Notifikasi
- **activity_logs** - Log aktivitas
- **settings** - Pengaturan sistem

Lihat file `DOCS-DATABASE.md` untuk dokumentasi database lengkap.

---

## 🔌 API Endpoints

### Base URL
```
http://localhost:8000
```

### Authentication
Sistem menggunakan Laravel Session-based Authentication.

### Endpoints Utama

#### Modules (CRUD)
- `GET /admin/modules` - List modules
- `POST /admin/modules` - Create module
- `GET /admin/modules/{id}` - Show module
- `PUT /admin/modules/{id}` - Update module
- `DELETE /admin/modules/{id}` - Delete module

#### Questions (CRUD)
- `GET /admin/questions/create?module_id={id}` - Form create
- `POST /admin/questions` - Create question
- `PUT /admin/questions/{id}` - Update question
- `DELETE /admin/questions/{id}` - Delete question

#### Categories (CRUD)
- `GET /admin/categories` - List categories
- `POST /admin/categories` - Create category
- `PUT /admin/categories/{id}` - Update category
- `DELETE /admin/categories/{id}` - Delete category

#### Users (CRUD)
- `GET /admin/users` - List users
- `POST /admin/users` - Create user
- `PUT /admin/users/{id}` - Update user
- `DELETE /admin/users/{id}` - Delete user

#### Exam
- `GET /modules/{module}/exam` - Start exam
- `POST /exam/{studentModule}/answer` - Save answer
- `POST /exam/{studentModule}/submit` - Submit exam
- `GET /exam/{studentModule}/result` - Get result

**Dokumentasi lengkap:** Import file `DOKUMENTASI-API.postman_collection.json` ke Postman.

---

## 🎯 Fitur yang Diimplementasikan

### 1. Implementasi Antarmuka (Frontend)
✅ Halaman login  
✅ Halaman dashboard (Admin & Student) dengan menu lengkap  
✅ Halaman fitur utama (Modules, Questions, Exam, dll)  
✅ UI responsif dengan TailwindCSS  
✅ Integrasi Chart.js untuk grafik  

### 2. Implementasi Backend
✅ Koneksi database (MySQL/PostgreSQL)  
✅ CRUD Modules (Create, Read, Update, Delete)  
✅ CRUD Questions (Create, Read, Update, Delete)  
✅ CRUD Categories (Create, Read, Update, Delete)  
✅ CRUD Users (Create, Read, Update, Delete)  
✅ REST API endpoints (GET, POST, PUT, DELETE)  

### 3. Integrasi Frontend-Backend
✅ Menampilkan data real-time dari database  
✅ Input data dari web tersimpan di database  
✅ Auto-save jawaban saat ujian  
✅ Update ranking otomatis  

### 4. Fitur Individu Tambahan
✅ **Sistem Pencarian dan Filter Lanjutan**
   - Pencarian modul berdasarkan keyword
   - Filter berdasarkan kategori, status, tanggal
   - UI yang user-friendly

### 5. Dokumentasi
✅ Dokumentasi API (Postman Collection)  
✅ Dokumentasi Individu (3-5 halaman)  
✅ Screenshot implementasi  
✅ Panduan screenshot  

---

## 📸 Screenshot yang Diperlukan

Minimal 3 screenshot halaman utama:
1. Halaman Login
2. Halaman Dashboard (Admin atau Student)
3. Halaman Fitur Utama (Modules, Questions, atau Exam)

Screenshot fitur individu:
- Halaman dengan fitur pencarian dan filter

Lihat `PANDUAN-SCREENSHOT.md` untuk detail lengkap.

---

## 🎬 Video Demo

**Cara membuat video demo:**
1. Gunakan screen recorder (OBS, Bandicam, atau built-in Windows/Mac)
2. Rekam alur berikut (maks. 2 menit):
   - Login sebagai student
   - Pilih modul tryout
   - Mulai ujian dan jawab beberapa soal
   - Submit ujian
   - Lihat hasil
3. Upload ke YouTube atau platform lain
4. Masukkan URL dalam dokumentasi

**Atau buat GIF:**
- Gunakan tool seperti ScreenToGif
- Rekam alur yang sama
- Simpan sebagai GIF
- Masukkan dalam dokumentasi

---

## 📝 Format Pengumpulan

### File yang Dikumpulkan:

1. **Folder Project** (Source Code)
   - Semua file Laravel project
   - Folder `screenshots/` dengan screenshot

2. **Dokumentasi PDF**
   - Konversi `DOKUMENTASI-INDIVIDU.md` ke PDF
   - Tambahkan screenshot di dalamnya
   - Maksimal 5 halaman

3. **Postman Collection**
   - File `DOKUMENTASI-API.postman_collection.json`
   - Atau export sebagai PDF dari Postman

4. **Link Video Demo** (opsional)
   - URL video demo di YouTube atau platform lain
   - Atau file GIF

### Struktur Folder Pengumpulan:

```
TUGAS-UTS-ELEARNING-[NAMA]-[NIM]/
├── source-code/
│   └── [folder project Laravel]
├── dokumentasi/
│   ├── DOKUMENTASI-INDIVIDU.pdf
│   ├── DOKUMENTASI-API.postman_collection.json
│   └── screenshots/
│       ├── 01-login.png
│       ├── 02-dashboard-admin.png
│       ├── 03-dashboard-student.png
│       └── ...
├── README-UTS.md
└── [Link Video Demo] (jika ada)
```

---

## 🔍 Checklist Pengumpulan

Sebelum mengumpulkan, pastikan:

- [ ] Semua source code lengkap dan dapat dijalankan
- [ ] Database migrations sudah dijalankan
- [ ] Minimal 3 screenshot halaman utama tersedia
- [ ] Screenshot fitur individu tersedia
- [ ] Dokumentasi individu 3-5 halaman sudah dibuat
- [ ] Dokumentasi API (Postman Collection) sudah dibuat
- [ ] Video demo atau GIF sudah dibuat (opsional)
- [ ] Semua file sudah di-compress (ZIP/RAR)
- [ ] Nama file sesuai format: `TUGAS-UTS-ELEARNING-[NAMA]-[NIM].zip`

---

## 📚 Referensi

- **Laravel Documentation:** https://laravel.com/docs
- **TailwindCSS Documentation:** https://tailwindcss.com/docs
- **Chart.js Documentation:** https://www.chartjs.org/docs

---

## ⚠️ Catatan Penting

1. **Pastikan semua fitur berfungsi** sebelum screenshot
2. **Gunakan data dummy** yang jelas dan konsisten
3. **Screenshot dengan resolusi tinggi** (min 1920x1080)
4. **Dokumentasi harus jelas** dan mudah dipahami
5. **Source code harus rapi** dan terorganisir
6. **Test semua endpoint API** sebelum dokumentasi

---

## 🆘 Troubleshooting

### Error: Database connection failed
- Pastikan database sudah dibuat
- Cek konfigurasi di `.env`
- Pastikan MySQL/PostgreSQL service berjalan

### Error: Storage link not found
- Jalankan: `php artisan storage:link`

### Error: Assets not loading
- Jalankan: `npm run build` atau `npm run dev`

### Error: CSRF token mismatch
- Pastikan menggunakan `@csrf` di form
- Cek session configuration

---

## 📞 Kontak

Jika ada pertanyaan tentang tugas, hubungi:
- **Dosen:** Syams Kurniawan Hidayat
- **Email:** [email dosen]

---

**Selamat mengerjakan tugas! 🚀**

