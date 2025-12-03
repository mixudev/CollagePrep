# 📚 Database Documentation - Tryout UTBK System

## 🎯 Overview
Sistem database untuk platform Tryout UTBK/SBMPTN yang komprehensif dengan fitur:
- ✅ Manajemen User (Admin & Student)
- ✅ Kategori & Modul Soal
- ✅ Bank Soal dengan Multiple Choice
- ✅ Sistem Ranking (Per Modul & Global)
- ✅ Analytics & Progress Tracking
- ✅ Achievement System
- ✅ Notification System
- ✅ Activity Logging

---

## 📊 Database Tables

### 1. **users** - Tabel Pengguna
Menyimpan data user (admin dan siswa)

**Kolom Penting:**
- `role`: enum('admin', 'student')
- `status`: enum('active', 'inactive')
- `school`: Asal sekolah siswa
- `avatar`: Path foto profil

**Relasi:**
- Has Many: student_modules, rankings, analytics, learning_progress, notifications
- Belongs To Many: achievements (melalui student_achievements)

---

### 2. **categories** - Kategori Mata Pelajaran
Menyimpan kategori soal (TPS, Matematika, Fisika, dll)

**Kolom Penting:**
- `code`: Kode unik kategori (TPS, MAT, FIS)
- `icon`: Nama icon untuk UI
- `color`: Warna hex untuk UI
- `order`: Urutan tampilan

**Relasi:**
- Has Many: modules, questions, student_analytics

---

### 3. **modules** - Modul Tryout
Menyimpan paket tryout/ujian

**Kolom Penting:**
- `duration`: Durasi dalam menit
- `total_questions`: Jumlah soal
- `passing_grade`: Nilai minimum kelulusan
- `start_date` & `end_date`: Periode aktif
- `max_attempts`: Maksimal percobaan
- `show_ranking`: Tampilkan ranking atau tidak
- `show_answer_after_submit`: Tampilkan pembahasan setelah submit

**Relasi:**
- Belongs To: category
- Has Many: questions, student_modules, rankings

---

### 4. **questions** - Bank Soal
Menyimpan soal-soal ujian

**Kolom Penting:**
- `type`: enum('multiple_choice', 'true_false', 'essay')
- `difficulty`: enum('easy', 'medium', 'hard')
- `points`: Bobot nilai
- `explanation`: Pembahasan jawaban
- `question_image`: Path gambar soal (opsional)

**Relasi:**
- Belongs To: module, category
- Has Many: options, student_answers

---

### 5. **question_options** - Pilihan Jawaban
Menyimpan opsi jawaban (A, B, C, D, E)

**Kolom Penting:**
- `option_label`: A, B, C, D, E
- `is_correct`: Boolean penanda jawaban benar
- `option_image`: Path gambar opsi (opsional)

**Relasi:**
- Belongs To: question
- Has Many: student_answers (sebagai selected_option)

---

### 6. **student_modules** - Progress Pengerjaan
Menyimpan data pengerjaan tryout per siswa

**Kolom Penting:**
- `status`: enum('not_started', 'in_progress', 'completed', 'abandoned')
- `attempt_number`: Percobaan ke berapa
- `score`: Nilai akhir
- `correct_answers`, `wrong_answers`, `unanswered`: Statistik jawaban
- `duration_seconds`: Waktu yang digunakan

**Relasi:**
- Belongs To: user, module
- Has Many: student_answers

---

### 7. **student_answers** - Jawaban Siswa
Menyimpan jawaban per soal

**Kolom Penting:**
- `is_correct`: Apakah jawaban benar
- `points_earned`: Poin yang didapat
- `time_spent_seconds`: Waktu per soal
- `is_marked`: Ragu-ragu flag
- `essay_answer`: Untuk tipe essay

**Relasi:**
- Belongs To: student_module, question, selected_option

---

### 8. **rankings** - Peringkat
Menyimpan peringkat siswa

**Kolom Penting:**
- `ranking_type`: enum('module', 'global')
- `rank`: Peringkat
- `average_score`: Rata-rata nilai
- `total_modules_completed`: Total modul selesai (untuk global)

**Relasi:**
- Belongs To: user, module (nullable untuk global ranking)

---

### 9. **student_analytics** - Analisis per Kategori
Menyimpan statistik performa per kategori

**Kolom Penting:**
- `accuracy_percentage`: Persentase akurasi
- `average_score`: Rata-rata nilai
- `average_time_per_question`: Rata-rata waktu per soal
- `strong_topics` & `weak_topics`: Counter topik kuat/lemah

**Relasi:**
- Belongs To: user, category

---

### 10. **learning_progress** - Progress Harian
Menyimpan aktivitas belajar per hari

**Kolom Penting:**
- `date`: Tanggal belajar (unique per user)
- `modules_completed`: Jumlah modul selesai hari ini
- `study_time_minutes`: Total waktu belajar
- `average_score`: Rata-rata nilai hari ini

**Relasi:**
- Belongs To: user

---

### 11. **achievements** - Master Achievement
Menyimpan daftar pencapaian yang tersedia

**Kolom Penting:**
- `type`: enum('completion', 'streak', 'score', 'speed', 'accuracy')
- `requirement_value`: Syarat nilai (misal: 100 untuk perfect score)
- `points`: Poin reward

**Relasi:**
- Belongs To Many: users (melalui student_achievements)

---

### 12. **notifications** - Notifikasi
Menyimpan notifikasi per user

**Kolom Penting:**
- `type`: enum('info', 'success', 'warning', 'achievement', 'module')
- `is_read`: Status dibaca
- `read_at`: Waktu dibaca

---

### 13. **settings** - Pengaturan Sistem
Menyimpan konfigurasi aplikasi

**Kolom Penting:**
- `key`: Unique key setting
- `value`: Nilai setting
- `type`: Tipe data (text, number, boolean, json)
- `group`: Grup setting (general, exam, ranking, dll)

---

### 14. **activity_logs** - Log Aktivitas
Menyimpan history aktivitas user

**Kolom Penting:**
- `action`: Jenis aksi (login, start_exam, submit_exam, dll)
- `model_type` & `model_id`: Polymorphic relation
- `properties`: JSON data tambahan
- `ip_address` & `user_agent`: Info request

---

## 🔗 Key Relationships

### User Flow
```
User → Student_Modules → Student_Answers → Questions → Question_Options
```

### Ranking Flow
```
Student_Modules (completed) → Rankings (calculated) → Display
```

### Analytics Flow
```
Student_Answers → Student_Analytics (aggregated by category)
Student_Modules → Learning_Progress (aggregated by date)
```

---

## 🚀 Installation Steps

### 1. Copy Semua Migration
Copy semua migration ke folder `database/migrations/` dengan format nama:
- `2024_01_01_000001_create_users_table.php`
- `2024_01_01_000002_create_categories_table.php`
- dst...

### 2. Copy Semua Model
Copy semua model ke folder `app/Models/`

### 3. Copy Semua Seeder
Copy semua seeder ke folder `database/seeders/`

### 4. Copy Factory
Copy `UserFactory.php` ke `database/factories/`

### 5. Jalankan Migration & Seeder
```bash
php artisan migrate:fresh --seed
```

---

## 📝 Sample Queries

### Get Student's Completed Modules with Score
```php
$student = User::find(1);
$completedModules = $student->studentModules()
    ->with('module')
    ->completed()
    ->orderBy('score', 'desc')
    ->get();
```

### Get Module Ranking
```php
$rankings = Ranking::module()
    ->byModule($moduleId)
    ->topRanks(10)
    ->with('user')
    ->get();
```

### Get Student Analytics by Category
```php
$analytics = StudentAnalytic::with('category')
    ->where('user_id', $userId)
    ->get();
```

### Get Learning Progress This Week
```php
$progress = LearningProgress::where('user_id', $userId)
    ->thisWeek()
    ->orderBy('date')
    ->get();
```

### Get Available Modules
```php
$modules = Module::active()
    ->with('category')
    ->get();
```

### Calculate Student's Global Ranking
```php
// Jalankan setelah student menyelesaikan module
Ranking::updateOrCreate(
    [
        'user_id' => $userId,
        'ranking_type' => 'global'
    ],
    [
        'average_score' => $avgScore,
        'total_modules_completed' => $totalCompleted,
        'rank' => 0 // Will be calculated by job
    ]
);
```

---

## 🎨 Features Implemented

### ✅ Core Features
- [x] User Management (Admin & Student)
- [x] Category & Module Management
- [x] Question Bank with Options
- [x] Student Exam Taking
- [x] Answer Recording

### ✅ Ranking System
- [x] Module-based Ranking
- [x] Global Ranking
- [x] Real-time Score Calculation

### ✅ Analytics & Progress
- [x] Per-Category Analytics
- [x] Daily Learning Progress
- [x] Time Tracking
- [x] Accuracy Calculation

### ✅ Gamification
- [x] Achievement System
- [x] Points & Rewards
- [x] Badges

### ✅ Supporting Features
- [x] Notifications
- [x] Activity Logging
- [x] System Settings
- [x] Soft Deletes

---

## 💡 Tips & Best Practices

### 1. Index Optimization
Sudah diterapkan index pada:
- Foreign keys
- Frequently queried columns (ranking_type, rank, date, is_read, dll)
- Unique constraints

### 2. Eager Loading
Selalu gunakan `with()` untuk menghindari N+1 query:
```php
Module::with(['category', 'questions.options'])->get();
```

### 3. Scope Usage
Gunakan scope untuk query yang sering dipakai:
```php
Module::active()->get();
User::students()->active()->get();
```

### 4. Soft Deletes
User dan Module menggunakan soft deletes untuk data integrity

### 5. Caching
Implementasikan caching untuk:
- Rankings (update setiap 5 menit)
- Analytics (update setiap jam)
- Settings (cache selamanya, clear on update)

---

## 🔐 Security Notes

1. **Password**: Otomatis di-hash menggunakan `'password' => 'hashed'` cast
2. **Hidden Fields**: Password & remember_token di-hide dari JSON response
3. **Unique Constraints**: Email, username, module code, dll
4. **Foreign Key Constraints**: Cascade delete untuk data integrity
5. **Activity Logging**: Track semua aktivitas penting

---

## 🎯 Next Steps

Untuk implementasi UTS, fokuskan pada:

### Frontend (React/Vue)
1. Login Page
2. Dashboard (tampilkan available modules, ranking preview)
3. Module Detail & Start Exam
4. Exam Taking Interface (timer, question navigation)
5. Result & Review Page

### Backend (Laravel API)
1. Authentication (JWT/Sanctum)
2. Module CRUD
3. Question CRUD
4. Exam Taking Endpoints
5. Ranking Calculation
6. Analytics API

### Fitur Individu (Pilih Salah Satu)
1. Real-time Ranking Update (WebSocket)
2. Advanced Analytics Dashboard (Chart.js)
3. Export Report (PDF/Excel)
4. Achievement Notification System
5. Intelligent Question Randomization

---

## 📞 Support

Jika ada pertanyaan tentang struktur database:
1. Lihat kembali ERD diagram
2. Check model relationships
3. Baca comment di migration files
4. Test dengan seeder data

**Good luck dengan UTS Anda! 🚀**