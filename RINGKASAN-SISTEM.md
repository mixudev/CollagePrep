# 📚 RINGKASAN SISTEM - PLATFORM TRYOUT UTBK/SBMPTN

## 🎯 Deskripsi Sistem

Platform E-Learning Tryout UTBK/SBMPTN adalah sistem web berbasis Laravel yang dirancang untuk membantu siswa mempersiapkan diri menghadapi Ujian Tulis Berbasis Komputer (UTBK) dan Seleksi Bersama Masuk Perguruan Tinggi Negeri (SBMPTN). Sistem ini menyediakan bank soal lengkap, sistem ranking kompetitif, analisis performa mendalam, dan berbagai fitur pendukung untuk meningkatkan efektivitas belajar siswa.

---

## 👥 Pengguna Sistem

### 1. **Admin**
- Mengelola seluruh konten dan pengguna sistem
- Membuat dan mengatur modul tryout
- Mengelola bank soal dan kategori
- Melihat statistik dan laporan aktivitas
- Mengatur pengaturan sistem

### 2. **Student (Siswa)**
- Mengikuti tryout/ujian online
- Melihat hasil dan pembahasan
- Melacak progress belajar
- Melihat ranking dan pencapaian
- Menganalisis performa per kategori

---

## 🏗️ Arsitektur Sistem

### **Backend Framework**
- **Laravel** (PHP Framework)
- **Database**: MySQL/PostgreSQL
- **Authentication**: Laravel Sanctum
- **File Storage**: Laravel Storage

### **Frontend**
- **TailwindCSS** untuk styling
- **Blade Templates** untuk rendering
- **Chart.js** untuk visualisasi data
- **SweetAlert2** untuk notifikasi
- **JavaScript (Vanilla)** untuk interaktivitas

---

## 📊 Struktur Database

### **Tabel Utama (14 Tabel)**

1. **users** - Data pengguna (Admin & Student)
2. **categories** - Kategori mata pelajaran (TPS, Matematika, Fisika, dll)
3. **modules** - Paket tryout/ujian
4. **questions** - Bank soal
5. **question_options** - Pilihan jawaban (A, B, C, D, E)
6. **student_modules** - Progress pengerjaan tryout per siswa
7. **student_answers** - Jawaban siswa per soal
8. **rankings** - Sistem peringkat (per modul & global)
9. **student_analytics** - Analisis performa per kategori
10. **learning_progress** - Progress belajar harian
11. **achievements** - Master pencapaian/badge
12. **student_achievements** - Pencapaian yang telah diraih siswa
13. **notifications** - Notifikasi untuk pengguna
14. **activity_logs** - Log aktivitas sistem
15. **settings** - Pengaturan sistem (site name, icon, warna, dll)

---

## ⚙️ Fitur Utama

### **1. Manajemen Konten (Admin)**

#### **Manajemen Kategori**
- CRUD kategori mata pelajaran
- Kode unik kategori (TPS, MAT, FIS, dll)
- Icon dan warna untuk identifikasi visual
- Urutan tampilan yang dapat diatur

#### **Manajemen Modul**
- Membuat paket tryout dengan berbagai konfigurasi:
  - Durasi ujian (dalam menit)
  - Jumlah soal
  - Passing grade (nilai minimum)
  - Periode aktif (start date & end date)
  - Maksimal percobaan
  - Tampilkan ranking (ya/tidak)
  - Tampilkan pembahasan setelah submit (ya/tidak)
- Status publish/unpublish
- Soft delete untuk data integrity

#### **Manajemen Soal**
- CRUD soal dengan berbagai tipe:
  - Multiple Choice (Pilihan Ganda)
  - True/False
  - Essay
- Tingkat kesulitan (Easy, Medium, Hard)
- Bobot nilai (points) per soal
- Upload gambar untuk soal
- Pembahasan lengkap per soal
- Multiple options (A, B, C, D, E) dengan gambar opsional

#### **Manajemen User**
- CRUD user (Admin & Student)
- Role management
- Status aktif/nonaktif
- Upload avatar
- Informasi sekolah untuk siswa

#### **Pengaturan Sistem**
- Nama aplikasi
- Icon/Logo aplikasi
- Warna utama (primary color) - dapat dikustomisasi
- Pengaturan registrasi (enable/disable)
- Pengaturan ujian (timer, auto submit, review)
- Pengaturan ranking (public/private, update interval)
- Sistem poin (poin per jawaban benar, penalty jawaban salah)

#### **Activity Logs**
- Mencatat semua aktivitas penting
- Tracking login, start exam, submit exam, dll
- IP address dan user agent tracking

---

### **2. Fitur Ujian (Student)**

#### **Interface Ujian**
- ⏱️ **Timer Real-time**: Countdown timer yang akurat
- 📝 **Navigasi Soal**: Navigasi mudah antar soal dengan indikator
- 💾 **Auto-save**: Jawaban tersimpan otomatis
- ✅ **Mark Ragu-ragu**: Tandai soal yang masih ragu
- 📊 **Progress Bar**: Indikator progress pengerjaan
- 🔄 **Review Mode**: Mode review sebelum submit

#### **Sistem Penilaian**
- Perhitungan skor otomatis
- Poin per jawaban benar
- Penalty untuk jawaban salah (opsional)
- Akurasi per kategori
- Waktu pengerjaan per soal

#### **Hasil Ujian**
- Skor akhir
- Jumlah benar, salah, tidak dijawab
- Waktu yang digunakan
- Review jawaban dengan pembahasan
- Perbandingan dengan jawaban benar
- Analisis per kategori

---

### **3. Sistem Ranking**

#### **Ranking Per Modul**
- Peringkat siswa dalam modul tertentu
- Berdasarkan skor tertinggi
- Update real-time setelah submit

#### **Ranking Global**
- Peringkat keseluruhan semua siswa
- Berdasarkan rata-rata skor
- Total modul yang diselesaikan
- Update berkala (interval dapat diatur)

#### **Fitur Ranking**
- Tampilkan top 10, top 20, atau semua
- Filter per modul
- Pencarian siswa
- Statistik ranking (rata-rata skor, total peserta)

---

### **4. Analisis & Progress Tracking**

#### **Student Analytics (Per Kategori)**
- **Akurasi**: Persentase jawaban benar per kategori
- **Rata-rata Skor**: Skor rata-rata per kategori
- **Waktu Rata-rata**: Waktu pengerjaan per soal
- **Topik Kuat**: Identifikasi topik yang sudah dikuasai
- **Topik Lemah**: Identifikasi topik yang perlu diperbaiki
- **Total Soal**: Jumlah soal yang telah dikerjakan

#### **Learning Progress (Harian)**
- Progress belajar per hari
- Jumlah modul yang diselesaikan
- Total soal yang dijawab
- Rata-rata skor harian
- Total waktu belajar (dalam menit/jam)

#### **Dashboard Analytics**
- Grafik progress skor (line chart)
- Grafik distribusi skor (bar chart)
- Grafik performa per kategori (doughnut chart)
- Grafik aktivitas harian/mingguan (bar chart)
- Statistik ringkas (modul selesai, soal dijawab, dll)

---

### **5. Sistem Achievement (Gamification)**

#### **Tipe Achievement**
- **Completion**: Menyelesaikan sejumlah modul
- **Streak**: Belajar berturut-turut
- **Score**: Mencapai skor tertentu
- **Speed**: Menyelesaikan ujian dengan cepat
- **Accuracy**: Mencapai akurasi tinggi

#### **Fitur Achievement**
- Badge dengan icon dan warna
- Poin reward
- Notifikasi saat achievement diraih
- Halaman achievements untuk melihat semua pencapaian

---

### **6. Notifikasi Sistem**

#### **Tipe Notifikasi**
- **Info**: Informasi umum
- **Success**: Pencapaian/keberhasilan
- **Warning**: Peringatan
- **Achievement**: Achievement baru diraih
- **Module**: Update modul baru

#### **Fitur Notifikasi**
- Status read/unread
- Timestamp kapan dibaca
- Auto-dismiss setelah dibaca
- Badge counter untuk notifikasi belum dibaca

---

### **7. Fitur Pendukung**

#### **History**
- Riwayat semua ujian yang telah dikerjakan
- Filter berdasarkan status (completed, in progress, abandoned)
- Sort berdasarkan tanggal, skor, dll

#### **Profile Management**
- Edit profil pribadi
- Update password
- Upload avatar
- Update informasi sekolah

#### **Role Management (Admin)**
- Ubah role user (admin/student)
- Bulk update role
- Manajemen akses

---

## 🎨 Desain & User Experience

### **Tema & Styling**
- **Desain**: Minimalis, profesional, dan elegan
- **Warna**: Dapat dikustomisasi melalui pengaturan sistem
  - Primary Color: Untuk tombol, border, fokus, dll
- **Chart Colors**: Kombinasi warna cerah (turquoise, blue, purple, pink, emerald, cyan, indigo, rose)
- **Typography**: Clean dan readable
- **Icons**: SVG icons untuk fitur-fitur

### **Responsive Design**
- Mobile-friendly
- Tablet-optimized
- Desktop-optimized
- Breakpoints: sm, md, lg, xl

### **Komponen UI**
- Cards dengan shadow dan border
- Tables dengan hover effects
- Forms dengan validation
- Buttons dengan hover states
- Pagination yang konsisten
- Badges untuk status
- Modals untuk konfirmasi

---

## 🔐 Keamanan

### **Authentication & Authorization**
- Laravel Authentication
- Role-based access control (RBAC)
- Middleware untuk proteksi route
- Password hashing otomatis

### **Data Protection**
- CSRF protection
- SQL injection prevention (Eloquent ORM)
- XSS protection
- Soft deletes untuk data integrity
- Foreign key constraints

### **Activity Tracking**
- Activity logs untuk audit trail
- IP address tracking
- User agent tracking
- Timestamp untuk semua aktivitas penting

---

## 📈 Statistik & Laporan

### **Dashboard Admin**
- Total modul tryout
- Total soal tersedia
- Total siswa aktif
- Total ujian diselesaikan
- Grafik completion by month
- Grafik distribusi skor
- Grafik performa per kategori
- Grafik aktivitas harian

### **Dashboard Student**
- Modul yang tersedia
- Progress terbaru
- Ranking pribadi
- Grafik progress skor
- Grafik performa per kategori
- Grafik aktivitas mingguan
- Grafik trend akurasi

---

## 🚀 Teknologi yang Digunakan

### **Backend**
- PHP 8.x
- Laravel Framework
- MySQL/PostgreSQL
- Laravel Sanctum (API Authentication)

### **Frontend**
- HTML5
- CSS3 (TailwindCSS)
- JavaScript (Vanilla)
- Chart.js (untuk grafik)
- SweetAlert2 (untuk notifikasi)

### **Tools & Libraries**
- Composer (PHP dependency manager)
- NPM (Node package manager)
- Vite (Asset bundler)
- Git (Version control)

---

## 📁 Struktur File Penting

```
app/
├── Http/
│   └── Controllers/
│       ├── AuthController.php
│       ├── DashboardController.php
│       ├── ModuleController.php
│       ├── QuestionController.php
│       ├── ExamController.php
│       ├── RankingController.php
│       ├── UserController.php
│       ├── CategoryController.php
│       ├── SettingController.php
│       ├── AchievementController.php
│       ├── HistoryController.php
│       ├── ProfileController.php
│       ├── RoleController.php
│       └── ActivityLogController.php
├── Models/
│   ├── User.php
│   ├── Module.php
│   ├── Question.php
│   ├── Category.php
│   ├── StudentModule.php
│   ├── StudentAnswer.php
│   ├── Ranking.php
│   ├── StudentAnalytic.php
│   ├── LearningProgress.php
│   ├── Achievement.php
│   ├── Notification.php
│   ├── ActivityLog.php
│   └── Setting.php
└── Middleware/
    └── RoleMiddleware.php

resources/
├── views/
│   ├── auth/ (login, register)
│   ├── dashboard/
│   │   ├── admin/ (dashboard, modules, questions, users, categories, settings, roles, activity-logs)
│   │   └── student/ (dashboard)
│   ├── exam/ (take, result)
│   ├── rankings/
│   ├── history/
│   ├── achievements/
│   ├── profile/
│   ├── layouts/ (app.blade.php)
│   └── partials/ (navbar.blade.php)
└── js/
    ├── app.js
    └── color-sync.js

database/
├── migrations/ (14+ migration files)
└── seeders/
    ├── UserSeeder.php
    ├── CategorySeeder.php
    ├── ModuleSeeder.php
    ├── QuestionSeeder.php
    ├── SettingSeeder.php
    └── AchievementSeeder.php
```

---

## 🎯 Alur Penggunaan Sistem

### **Alur Admin**
1. Login sebagai admin
2. Buat kategori mata pelajaran
3. Buat modul tryout
4. Tambahkan soal ke modul
5. Publish modul
6. Monitor statistik dan aktivitas siswa
7. Kelola user dan pengaturan sistem

### **Alur Student**
1. Register/Login
2. Lihat dashboard dengan statistik pribadi
3. Pilih modul tryout yang tersedia
4. Mulai ujian dengan timer
5. Jawab soal dengan navigasi yang mudah
6. Submit ujian
7. Lihat hasil dan pembahasan
8. Review analisis performa
9. Lihat ranking dan achievements
10. Lanjutkan ke modul berikutnya

---

## 📊 Data & Statistik yang Tersedia

### **Data Real-time**
- Jumlah modul aktif
- Jumlah soal tersedia
- Jumlah siswa aktif
- Jumlah ujian diselesaikan
- Rata-rata akurasi siswa
- Total waktu belajar
- Topik yang dikuasai

### **Analisis yang Tersedia**
- Progress skor dari waktu ke waktu
- Distribusi skor siswa
- Performa per kategori mata pelajaran
- Aktivitas belajar harian/mingguan
- Trend akurasi
- Identifikasi topik kuat dan lemah

---

## 🌟 Keunggulan Sistem

1. **Komprehensif**: Mencakup semua aspek persiapan UTBK
2. **User-friendly**: Interface yang mudah digunakan
3. **Real-time**: Update data secara real-time
4. **Analitik**: Analisis performa yang mendalam
5. **Gamifikasi**: Achievement system untuk motivasi
6. **Kustomisasi**: Pengaturan yang fleksibel
7. **Responsif**: Dapat diakses dari berbagai perangkat
8. **Profesional**: Desain yang elegan dan modern
9. **Scalable**: Dapat menampung banyak pengguna
10. **Secure**: Keamanan data yang terjamin

---

## 🔄 Workflow Sistem

```
1. Admin Setup
   └─> Buat Kategori → Buat Modul → Tambah Soal → Publish

2. Student Registration
   └─> Register → Login → Dashboard

3. Exam Taking
   └─> Pilih Modul → Start Exam → Jawab Soal → Submit → Review

4. Analytics & Ranking
   └─> Calculate Score → Update Analytics → Update Ranking → Display

5. Achievement
   └─> Check Criteria → Award Achievement → Send Notification
```

---

## 📝 Catatan Penting

- Sistem menggunakan **Soft Deletes** untuk User dan Module
- **Activity Logging** mencatat semua aktivitas penting
- **Settings** dapat dikustomisasi melalui admin panel
- **Ranking** dihitung otomatis setelah submit ujian
- **Analytics** diupdate secara berkala
- **File Upload** untuk gambar soal dan avatar
- **Timer** menggunakan JavaScript untuk akurasi
- **Auto-save** jawaban untuk mencegah kehilangan data

---

## 🎓 Tujuan Sistem

Sistem ini dirancang untuk:
- ✅ Membantu siswa mempersiapkan diri menghadapi UTBK/SBMPTN
- ✅ Menyediakan bank soal yang lengkap dan berkualitas
- ✅ Memberikan analisis performa yang mendalam
- ✅ Menciptakan kompetisi sehat melalui sistem ranking
- ✅ Memotivasi siswa melalui achievement system
- ✅ Memudahkan admin dalam mengelola konten dan pengguna
- ✅ Menyediakan platform yang profesional dan mudah digunakan

---

**Sistem ini siap digunakan dan dapat dikembangkan lebih lanjut sesuai kebutuhan!** 🚀

