# Setup Instructions - Tryout UTBK System

## ✅ Yang Sudah Dibuat

### 1. **Controllers**
- ✅ AuthController (login, logout)
- ✅ DashboardController (admin & student dashboard)
- ✅ ModuleController (CRUD modul)
- ✅ QuestionController (CRUD soal)
- ✅ ExamController (ujian, save answer, submit, result)
- ✅ RankingController (ranking global & per modul)
- ✅ UserController (CRUD user)
- ✅ CategoryController (CRUD kategori)

### 2. **Views**
- ✅ Login page
- ✅ Admin Dashboard
- ✅ Student Dashboard
- ✅ Exam Taking Interface (dengan timer)
- ✅ Exam Result & Review
- ✅ Ranking Page
- ✅ Admin: Modules (index, create, edit, show)
- ✅ Admin: Questions (index, create, edit)
- ✅ Admin: Users (index, create, edit)
- ✅ Admin: Categories (index)

### 3. **Middleware & Routes**
- ✅ RoleMiddleware untuk proteksi route
- ✅ Routes lengkap untuk semua fitur
- ✅ Authentication routes

### 4. **Frontend**
- ✅ TailwindCSS sudah dikonfigurasi
- ✅ SweetAlert2 sudah ditambahkan ke package.json
- ✅ Layout dengan navbar & footer
- ✅ Responsive design

## 🚀 Langkah Setup

### 1. Install Dependencies
```bash
npm install
```

Jika SweetAlert2 belum terinstall, jalankan:
```bash
npm install sweetalert2
```

### 2. Build Assets
```bash
npm run build
# atau untuk development
npm run dev
```

### 3. Setup Database
Pastikan sudah menjalankan migration dan seeder:
```bash
php artisan migrate:fresh --seed
```

### 4. Setup Storage Link
```bash
php artisan storage:link
```

### 5. Jalankan Server
```bash
php artisan serve
```

## 📝 Catatan Penting

### Login Credentials
Gunakan credentials dari seeder untuk login. Biasanya:
- **Admin**: email dari UserSeeder dengan role 'admin'
- **Student**: email dari UserSeeder dengan role 'student'

### Fitur yang Tersedia

#### Untuk Admin:
1. Dashboard dengan statistik
2. Manajemen User (CRUD)
3. Manajemen Kategori (CRUD)
4. Manajemen Modul (CRUD)
5. Manajemen Soal (CRUD)
6. Lihat Ranking

#### Untuk Student:
1. Dashboard dengan statistik pribadi
2. Lihat modul tersedia
3. Mulai ujian dengan timer
4. Navigasi soal
5. Save jawaban otomatis
6. Submit ujian
7. Lihat hasil & review jawaban
8. Lihat ranking

### Fitur Exam Interface:
- ⏱ Timer countdown
- 📝 Navigasi soal dengan indikator
- 💾 Auto-save jawaban
- ✅ Mark ragu-ragu (prepared)
- 📊 Review jawaban setelah submit
- 🎯 Score calculation otomatis

## 🔧 Troubleshooting

### Jika SweetAlert tidak muncul:
1. Pastikan `npm install` sudah dijalankan
2. Pastikan `npm run build` atau `npm run dev` sudah dijalankan
3. Clear cache: `php artisan cache:clear`

### Jika gambar tidak muncul:
1. Pastikan `php artisan storage:link` sudah dijalankan
2. Pastikan folder `storage/app/public` ada dan writable

### Jika route tidak ditemukan:
1. Clear route cache: `php artisan route:clear`
2. Clear config cache: `php artisan config:clear`

## 📚 Struktur File Penting

```
app/Http/Controllers/
├── AuthController.php
├── DashboardController.php
├── ModuleController.php
├── QuestionController.php
├── ExamController.php
├── RankingController.php
├── UserController.php
└── CategoryController.php

resources/views/
├── auth/
│   └── login.blade.php
├── dashboard/
│   ├── admin/
│   │   ├── index.blade.php
│   │   ├── modules/
│   │   ├── questions/
│   │   ├── users/
│   │   └── categories/
│   ├── student/
│   │   └── index.blade.php
│   └── rankings/
│       └── index.blade.php
├── exam/
│   ├── take.blade.php
│   └── result.blade.php
└── layouts/
    └── app.blade.php
```

## 🎨 Design Features

- ✅ Modern & Minimalis
- ✅ Responsive (mobile-friendly)
- ✅ TailwindCSS styling
- ✅ SweetAlert2 untuk notifications
- ✅ Color-coded status indicators
- ✅ Clean dashboard layout

## ⚠️ Yang Perlu Diperhatikan

1. **Question Options**: Form create/edit soal menggunakan radio button untuk memilih jawaban benar. Pastikan form dikirim dengan benar.

2. **Available Modules**: Query untuk modul tersedia sudah disederhanakan. Jika ada issue, bisa disesuaikan sesuai kebutuhan.

3. **Ranking Calculation**: Ranking dihitung saat submit ujian. Untuk performa lebih baik, bisa dipindah ke job/queue.

4. **File Upload**: Pastikan folder `storage/app/public/questions` ada dan writable untuk upload gambar soal.

5. **Timer**: Timer menggunakan JavaScript. Pastikan browser support JavaScript.

## 🎯 Next Steps (Opsional)

1. Tambahkan pagination di beberapa halaman
2. Implementasi real-time ranking update
3. Export report (PDF/Excel)
4. Advanced analytics dashboard
5. Achievement notification system
6. Email notifications

---

**Sistem sudah siap digunakan!** 🚀

Jika ada pertanyaan atau issue, silakan cek dokumentasi Laravel atau file-file yang sudah dibuat.

