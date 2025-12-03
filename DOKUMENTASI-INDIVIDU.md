# 📚 DOKUMENTASI IMPLEMENTASI INDIVIDU
## Platform E-Learning Tryout UTBK/SBMPTN

**Mata Kuliah:** E-Learning  
**Dosen:** Syams Kurniawan Hidayat  
**Semester/Kelas:** 5/F, 5/G, 5/H, 5/I  
**Nama:** [NAMA ANDA]  
**NIM:** [NIM ANDA]  
**Tanggal:** [TANGGAL]

---

## 1. DESKRIPSI SINGKAT SISTEM (1 Halaman)

### 1.1. Gambaran Umum
Platform E-Learning Tryout UTBK/SBMPTN adalah sistem web berbasis Laravel yang dirancang untuk membantu siswa mempersiapkan diri menghadapi Ujian Tulis Berbasis Komputer (UTBK) dan Seleksi Bersama Masuk Perguruan Tinggi Negeri (SBMPTN). Sistem ini menyediakan bank soal lengkap, sistem ranking kompetitif, analisis performa mendalam, dan berbagai fitur pendukung untuk meningkatkan efektivitas belajar siswa.

### 1.2. Tujuan Sistem
Sistem ini bertujuan untuk:
- ✅ Membantu siswa mempersiapkan diri menghadapi UTBK/SBMPTN
- ✅ Menyediakan bank soal yang lengkap dan berkualitas
- ✅ Memberikan analisis performa yang mendalam
- ✅ Menciptakan kompetisi sehat melalui sistem ranking
- ✅ Memotivasi siswa melalui achievement system
- ✅ Memudahkan admin dalam mengelola konten dan pengguna

### 1.3. Teknologi yang Digunakan
- **Backend:** PHP 8.2, Laravel Framework 12.0
- **Frontend:** HTML5, CSS3 (TailwindCSS), JavaScript (Vanilla)
- **Database:** MySQL/PostgreSQL
- **Authentication:** Laravel Session-based Authentication
- **Libraries:** Chart.js (untuk grafik), SweetAlert2 (untuk notifikasi)

### 1.4. Pengguna Sistem
1. **Admin:** Mengelola konten, soal, modul, dan pengguna
2. **Student:** Mengikuti tryout, melihat hasil, dan melacak progress

---

## 2. PENJELASAN BAGIAN YANG DIIMPLEMENTASIKAN

### 2.1. Implementasi Antarmuka (Frontend)

#### 2.1.1. Halaman Login
**Lokasi:** `resources/views/Auth/login.blade.php`

**Fitur yang diimplementasikan:**
- Form login dengan validasi
- Tampilan responsif menggunakan TailwindCSS
- Integrasi dengan Laravel Authentication
- Redirect berdasarkan role (admin/student)

**Teknologi:**
- Blade Template Engine
- TailwindCSS untuk styling
- Laravel Form Validation

#### 2.1.2. Halaman Dashboard
**Lokasi:** 
- Admin: `resources/views/Dashboard/admin/index.blade.php`
- Student: `resources/views/Dashboard/student/index.blade.php`

**Fitur yang diimplementasikan:**
- **Dashboard Admin:**
  - Statistik ringkas (total modul, soal, siswa, ujian selesai)
  - Grafik completion by month (Chart.js)
  - Grafik distribusi skor
  - Grafik performa per kategori
  - Grafik aktivitas harian

- **Dashboard Student:**
  - Modul yang tersedia
  - Progress terbaru
  - Ranking pribadi
  - Grafik progress skor
  - Grafik performa per kategori
  - Grafik aktivitas mingguan

**Menu yang tersedia:**
- **Admin:** Dashboard, Modules, Questions, Categories, Users, Settings, Roles, Activity Logs
- **Student:** Dashboard, Tryout, History, Rankings, Achievements, Profile

#### 2.1.3. Halaman Fitur Utama
**Halaman yang diimplementasikan:**
1. **Manajemen Modul** (`admin/modules`)
   - List modul dengan pagination
   - Create, Edit, Delete modul
   - Detail modul dengan daftar soal

2. **Manajemen Soal** (`admin/questions`)
   - Create soal dengan multiple choice atau true/false
   - Upload gambar untuk soal
   - Edit dan delete soal

3. **Interface Ujian** (`exam/take`)
   - Timer real-time countdown
   - Navigasi soal dengan indikator
   - Auto-save jawaban
   - Mark ragu-ragu
   - Progress bar

4. **Hasil Ujian** (`exam/result`)
   - Skor akhir
   - Review jawaban dengan pembahasan
   - Analisis per kategori

### 2.2. Implementasi Backend

#### 2.2.1. Koneksi Database
**Konfigurasi:** `config/database.php`

Sistem menggunakan MySQL/PostgreSQL dengan konfigurasi melalui file `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=elearning_db
DB_USERNAME=root
DB_PASSWORD=
```

**Migrations:** Semua tabel dibuat melalui Laravel Migrations di folder `database/migrations/`

#### 2.2.2. Operasi CRUD yang Diimplementasikan

**1. CRUD Modules (Modul Tryout)**
- **Controller:** `app/Http/Controllers/ModuleController.php`
- **Model:** `app/Models/Module.php`
- **Routes:**
  - `GET /admin/modules` - List semua modul
  - `GET /admin/modules/create` - Form create
  - `POST /admin/modules` - Store modul baru
  - `GET /admin/modules/{id}` - Show detail
  - `GET /admin/modules/{id}/edit` - Form edit
  - `PUT /admin/modules/{id}` - Update modul
  - `DELETE /admin/modules/{id}` - Delete modul

**Fitur:**
- Auto-generate code berdasarkan kategori
- Validasi data lengkap
- Activity logging
- Soft delete

**2. CRUD Questions (Soal)**
- **Controller:** `app/Http/Controllers/QuestionController.php`
- **Model:** `app/Models/Question.php`
- **Routes:**
  - `GET /admin/questions/create` - Form create
  - `POST /admin/questions` - Store soal baru
  - `GET /admin/questions/{id}/edit` - Form edit
  - `PUT /admin/questions/{id}` - Update soal
  - `DELETE /admin/questions/{id}` - Delete soal

**Fitur:**
- Support multiple choice dan true/false
- Upload gambar untuk soal
- Multiple options (A, B, C, D, E)
- Auto-update total_questions di modul
- Activity logging

**3. CRUD Categories (Kategori)**
- **Controller:** `app/Http/Controllers/CategoryController.php`
- **Model:** `app/Models/Category.php`
- **Routes:**
  - `GET /admin/categories` - List kategori
  - `POST /admin/categories` - Store kategori
  - `PUT /admin/categories/{id}` - Update kategori
  - `DELETE /admin/categories/{id}` - Delete kategori

**4. CRUD Users (Pengguna)**
- **Controller:** `app/Http/Controllers/UserController.php`
- **Model:** `app/Models/User.php`
- **Routes:**
  - `GET /admin/users` - List users
  - `GET /admin/users/create` - Form create
  - `POST /admin/users` - Store user
  - `GET /admin/users/{id}/edit` - Form edit
  - `PUT /admin/users/{id}` - Update user
  - `DELETE /admin/users/{id}` - Delete user

#### 2.2.3. REST API Endpoints

**Base URL:** `http://localhost:8000`

**Authentication:** Session-based (Laravel)

**Endpoints yang tersedia:**

1. **GET Data:**
   - `GET /admin/modules` - List modules
   - `GET /admin/modules/{id}` - Detail module
   - `GET /admin/questions/create?module_id={id}` - Form create question
   - `GET /admin/categories` - List categories
   - `GET /admin/users` - List users
   - `GET /dashboard` - Dashboard data

2. **POST Data:**
   - `POST /admin/modules` - Create module
   - `POST /admin/questions` - Create question
   - `POST /admin/categories` - Create category
   - `POST /admin/users` - Create user
   - `POST /exam/{studentModule}/answer` - Save answer

3. **PUT/UPDATE Data:**
   - `PUT /admin/modules/{id}` - Update module
   - `PUT /admin/questions/{id}` - Update question
   - `PUT /admin/categories/{id}` - Update category
   - `PUT /admin/users/{id}` - Update user

4. **DELETE Data:**
   - `DELETE /admin/modules/{id}` - Delete module
   - `DELETE /admin/questions/{id}` - Delete question
   - `DELETE /admin/categories/{id}` - Delete category
   - `DELETE /admin/users/{id}` - Delete user

**Dokumentasi lengkap:** Lihat file `DOKUMENTASI-API.postman_collection.json` untuk Postman Collection

### 2.3. Integrasi Frontend-Backend

#### 2.3.1. Menampilkan Data Realtime dari Database
**Contoh Implementasi:**

1. **Dashboard dengan Data Real-time:**
   - Data statistik diambil langsung dari database
   - Grafik menggunakan Chart.js dengan data dari controller
   - Update otomatis saat data berubah

2. **List Modul:**
   ```php
   // Controller
   $modules = Module::with('category')
       ->latest()
       ->paginate(15);
   ```
   - Data ditampilkan dengan pagination
   - Real-time update saat modul ditambah/diubah

3. **Interface Ujian:**
   - Soal diambil dari database saat halaman dimuat
   - Jawaban tersimpan otomatis ke database
   - Timer menggunakan JavaScript dengan data dari server

#### 2.3.2. Input Data dari Web ke Database
**Contoh Implementasi:**

1. **Create Module:**
   ```php
   // Form di frontend
   <form action="{{ route('admin.modules.store') }}" method="POST">
       @csrf
       <!-- Form fields -->
   </form>
   
   // Controller
   public function store(Request $request) {
       $validated = $request->validate([...]);
       $module = Module::create($validated);
       return redirect()->route('admin.modules.index');
   }
   ```

2. **Save Answer (Auto-save):**
   ```javascript
   // JavaScript
   fetch('/exam/' + studentModuleId + '/answer', {
       method: 'POST',
       headers: {
           'Content-Type': 'application/json',
           'X-CSRF-TOKEN': csrfToken
       },
       body: JSON.stringify({
           question_id: questionId,
           selected_option_id: optionId
       })
   });
   ```

**Alur Data:**
1. User mengisi form di frontend
2. Data dikirim via POST request ke backend
3. Backend melakukan validasi
4. Data disimpan ke database
5. Response dikembalikan ke frontend
6. Frontend menampilkan feedback (success/error)

---

## 3. FLOWCHART ATAU DIAGRAM ARSITEKTUR

### 3.1. Arsitektur Sistem

```
┌─────────────────┐
│   Web Browser   │
│   (Frontend)    │
└────────┬────────┘
         │ HTTP Request
         ▼
┌─────────────────┐
│   Laravel App   │
│   (Backend)     │
│                 │
│  - Routes       │
│  - Controllers  │
│  - Middleware   │
│  - Models       │
└────────┬────────┘
         │ Query
         ▼
┌─────────────────┐
│    Database     │
│   (MySQL/       │
│  PostgreSQL)    │
└─────────────────┘
```

### 3.2. Flow Autentikasi

```
Start
  │
  ▼
Login Form
  │
  ▼
Submit Credentials
  │
  ▼
Laravel Auth
  │
  ├─ Valid ──► Set Session ──► Redirect Dashboard
  │
  └─ Invalid ──► Show Error ──► Back to Login
```

### 3.3. Flow Ujian (Student)

```
Start
  │
  ▼
Pilih Modul
  │
  ▼
Start Exam
  │
  ▼
Load Questions from DB
  │
  ▼
Jawab Soal
  │
  ├─ Auto-save Answer ──► Save to DB
  │
  └─ Continue
  │
  ▼
Submit Exam
  │
  ▼
Calculate Score
  │
  ▼
Update Ranking
  │
  ▼
Show Result
```

### 3.4. Flow CRUD Module (Admin)

```
Start
  │
  ▼
List Modules
  │
  ├─ Create ──► Form ──► Validate ──► Save DB ──► Redirect
  │
  ├─ Edit ──► Form ──► Validate ──► Update DB ──► Redirect
  │
  └─ Delete ──► Confirm ──► Soft Delete ──► Redirect
```

---

## 4. TANTANGAN YANG DIHADAPI + SOLUSI

### 4.1. Tantangan 1: Auto-save Jawaban saat Ujian
**Masalah:**
- Perlu menyimpan jawaban secara real-time tanpa mengganggu user
- Mencegah kehilangan data jika browser crash

**Solusi:**
- Implementasi AJAX request untuk auto-save
- Menggunakan `updateOrCreate` di Laravel untuk mencegah duplikasi
- Menyimpan jawaban setiap kali user memilih option
- Menambahkan loading indicator yang tidak mengganggu

**Kode Implementasi:**
```javascript
// Auto-save function
function saveAnswer(questionId, optionId) {
    fetch('/exam/' + studentModuleId + '/answer', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({
            question_id: questionId,
            selected_option_id: optionId
        })
    });
}
```

### 4.2. Tantangan 2: Timer Real-time yang Akurat
**Masalah:**
- Timer harus sinkron dengan waktu server
- Mencegah manipulasi waktu di client-side

**Solusi:**
- Menggunakan JavaScript untuk countdown di client
- Menyimpan `started_at` timestamp di database
- Validasi waktu di server saat submit
- Auto-submit jika waktu habis

**Kode Implementasi:**
```javascript
// Timer implementation
const duration = {{ $module->duration }} * 60; // Convert to seconds
let timeLeft = duration;

const timer = setInterval(() => {
    timeLeft--;
    updateTimerDisplay(timeLeft);
    
    if (timeLeft <= 0) {
        clearInterval(timer);
        autoSubmit();
    }
}, 1000);
```

### 4.3. Tantangan 3: Perhitungan Ranking yang Efisien
**Masalah:**
- Ranking perlu diupdate setiap kali ada submit ujian
- Perhitungan bisa lambat jika banyak data

**Solusi:**
- Menggunakan database query yang dioptimasi
- Update ranking hanya untuk modul yang relevan
- Implementasi caching untuk ranking global
- Update ranking dalam transaction untuk konsistensi

**Kode Implementasi:**
```php
// Efficient ranking update
private function updateRanking(StudentModule $studentModule) {
    DB::transaction(function () use ($studentModule) {
        $moduleRankings = StudentModule::where('module_id', $studentModule->module_id)
            ->completed()
            ->orderBy('score', 'desc')
            ->get();
        
        $rank = 1;
        foreach ($moduleRankings as $sm) {
            Ranking::updateOrCreate([...], ['rank' => $rank++]);
        }
    });
}
```

### 4.4. Tantangan 4: Upload Gambar untuk Soal
**Masalah:**
- Validasi ukuran dan format file
- Penyimpanan file yang aman
- Menampilkan gambar di frontend

**Solusi:**
- Validasi di Laravel: `image|max:2048`
- Simpan di `storage/app/public/questions`
- Generate link public dengan `Storage::url()`
- Optimasi gambar sebelum disimpan

**Kode Implementasi:**
```php
if ($request->hasFile('question_image')) {
    $validated['question_image'] = $request->file('question_image')
        ->store('questions', 'public');
}
```

### 4.5. Tantangan 5: Integrasi Chart.js dengan Data Laravel
**Masalah:**
- Data dari Laravel perlu diformat untuk Chart.js
- Update chart secara real-time

**Solusi:**
- Pass data sebagai JSON dari controller ke view
- Format data di JavaScript sesuai format Chart.js
- Gunakan AJAX untuk update real-time jika diperlukan

**Kode Implementasi:**
```php
// Controller
$chartData = [
    'labels' => $labels,
    'data' => $values
];
return view('dashboard', compact('chartData'));

// JavaScript
const ctx = document.getElementById('myChart');
new Chart(ctx, {
    type: 'line',
    data: {
        labels: @json($chartData['labels']),
        datasets: [{
            data: @json($chartData['data'])
        }]
    }
});
```

---

## 5. FITUR INDIVIDU TAMBAHAN

### 5.1. Fitur yang Dipilih: **Sistem Pencarian Data dengan Filter Lanjutan**

**Lokasi Implementasi:**
- `app/Http/Controllers/ModuleController.php` (method `index`)
- `resources/views/Dashboard/admin/modules/index.blade.php`

**Deskripsi:**
Fitur pencarian dan filter lanjutan untuk modul yang memungkinkan admin mencari modul berdasarkan:
- Kata kunci (judul, kode, deskripsi)
- Kategori
- Status (published/unpublished)
- Tanggal (start date, end date)
- Range skor (passing grade)

**Alur Kerja (Flow):**
```
1. Admin membuka halaman Modules
2. Admin memasukkan keyword di search box
3. Admin memilih filter (kategori, status, dll)
4. Submit form search
5. Backend melakukan query dengan filter
6. Hasil ditampilkan dengan pagination
7. Admin dapat clear filter untuk reset
```

**Teknologi yang Digunakan:**
- Laravel Query Builder untuk dynamic filtering
- JavaScript untuk interaktivitas form
- TailwindCSS untuk UI

**Screenshot Fitur:**
*(Sertakan screenshot halaman modules dengan search dan filter)*

**Kode Implementasi:**
```php
// Controller
public function index(Request $request) {
    $query = Module::with('category');
    
    // Search by keyword
    if ($request->filled('search')) {
        $search = $request->search;
        $query->where(function($q) use ($search) {
            $q->where('title', 'like', "%{$search}%")
              ->orWhere('code', 'like', "%{$search}%")
              ->orWhere('description', 'like', "%{$search}%");
        });
    }
    
    // Filter by category
    if ($request->filled('category_id')) {
        $query->where('category_id', $request->category_id);
    }
    
    // Filter by status
    if ($request->filled('status')) {
        $query->where('is_published', $request->status === 'published');
    }
    
    $modules = $query->latest()->paginate(15);
    $categories = Category::active()->get();
    
    return view('dashboard.admin.modules.index', compact('modules', 'categories'));
}
```

**Keunggulan Fitur:**
- Meningkatkan efisiensi admin dalam mencari modul
- Filter yang fleksibel dan mudah digunakan
- Performa baik dengan query yang dioptimasi
- UI yang user-friendly

---

## 6. KESIMPULAN

### 6.1. Pencapaian Implementasi
Sistem E-Learning Tryout UTBK/SBMPTN telah berhasil diimplementasikan dengan fitur-fitur utama yang lengkap:

✅ **Frontend:**
- Halaman login dengan autentikasi
- Dashboard lengkap untuk admin dan student
- Interface ujian dengan timer real-time
- Halaman hasil dan review
- UI responsif dan modern

✅ **Backend:**
- Koneksi database yang stabil
- CRUD lengkap untuk Modules, Questions, Categories, dan Users
- REST API endpoints yang terstruktur
- Validasi data yang ketat
- Activity logging untuk audit trail

✅ **Integrasi:**
- Data real-time dari database ke frontend
- Input data dari web tersimpan dengan baik
- Auto-save untuk mencegah kehilangan data
- Sistem ranking yang otomatis

✅ **Fitur Tambahan:**
- Sistem pencarian dan filter lanjutan
- Upload gambar untuk soal
- Chart.js untuk visualisasi data
- Activity logs untuk tracking

### 6.2. Pelajaran yang Didapat
1. **Laravel Framework:** Memahami struktur MVC, routing, middleware, dan Eloquent ORM
2. **Database Design:** Merancang relasi antar tabel yang efisien
3. **Frontend Integration:** Mengintegrasikan JavaScript dengan Laravel Blade
4. **Real-time Features:** Implementasi auto-save dan timer
5. **Security:** Validasi input, CSRF protection, dan authentication

### 6.3. Pengembangan Selanjutnya
Beberapa fitur yang dapat dikembangkan lebih lanjut:
- API dengan JWT authentication untuk mobile app
- Real-time notifications menggunakan WebSocket
- Export laporan ke PDF/Excel
- Sistem diskusi/forum untuk siswa
- Video pembelajaran terintegrasi
- AI untuk rekomendasi soal berdasarkan performa

### 6.4. Penutup
Implementasi sistem E-Learning ini telah memenuhi semua requirement tugas UTS. Sistem dapat digunakan sebagai prototipe fungsional dengan fitur-fitur utama yang lengkap. Dengan struktur kode yang rapi dan dokumentasi yang lengkap, sistem ini siap untuk dikembangkan lebih lanjut sesuai kebutuhan.

---

**Dokumentasi ini dibuat sebagai bagian dari tugas UTS Mata Kuliah E-Learning.**

