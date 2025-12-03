<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ \App\Models\Setting::getValue('site_name', 'Tryout UTBK') }} - Platform Tryout UTBK/SBMPTN Terpercaya</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* Smooth scroll */
        html {
            scroll-behavior: smooth;
        }
        
        /* Fade in animation */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .fade-in-up {
            animation: fadeInUp 0.6s ease-out;
        }
        
        /* Gradient text */
        .gradient-text {
            background: linear-gradient(135deg, #111827 0%, #4b5563 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        /* Feature card hover */
        .feature-card {
            transition: all 0.3s ease;
        }
        
        .feature-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        
        /* Review card */
        .review-card {
            transition: all 0.3s ease;
        }
        
        .review-card:hover {
            transform: translateY(-4px);
        }
        
        /* Stats counter animation */
        @keyframes countUp {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="fixed top-0 left-0 right-0 bg-white/80 backdrop-blur-md border-b border-gray-200 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <div class="flex items-center space-x-3">
                    @php
                        $siteIcon = \App\Models\Setting::getValue('site_icon');
                    @endphp
                    @if($siteIcon && file_exists(public_path('storage/' . $siteIcon)))
                        <img src="{{ asset('storage/' . $siteIcon) }}" alt="Logo" class="h-10 w-10">
                    @else
                        <div class="h-10 w-10 bg-gray-900 rounded-lg flex items-center justify-center">
                            <span class="text-white font-bold text-lg">T</span>
                        </div>
                    @endif
                    <span class="text-xl font-bold text-gray-900">{{ \App\Models\Setting::getValue('site_name', 'Tryout UTBK') }}</span>
                </div>
                <div class="flex items-center space-x-4">
                    @auth
                        <a href="{{ route('dashboard') }}" class="px-4 py-2 text-sm font-medium text-gray-700 hover:text-gray-900 transition-colors">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="px-4 py-2 text-sm font-medium text-gray-700 hover:text-gray-900 transition-colors">
                            Masuk
                        </a>
                        @if(\App\Models\Setting::getValue('registration_enabled', true))
                            <a href="{{ route('register') }}" class="px-6 py-2.5 bg-gray-900 text-white rounded-lg hover:bg-gray-800 transition-colors text-sm font-medium">
                            Daftar
                        </a>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="pt-32 pb-20 px-4 sm:px-6 lg:px-8 bg-gradient-to-b from-white to-gray-50">
        <div class="max-w-7xl mx-auto">
            <div class="text-center fade-in-up">
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-gray-900 mb-6">
                    Siapkan Diri untuk
                    <span class="gradient-text">UTBK/SBMPTN</span>
                    dengan Platform Tryout Terbaik
                </h1>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto mb-10 leading-relaxed">
                    Latih kemampuan Anda dengan ribuan soal berkualitas tinggi, analisis performa mendalam, 
                    dan sistem ranking yang kompetitif. Raih impian kuliah di PTN favorit Anda.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                    @if(\App\Models\Setting::getValue('registration_enabled', true))
                        <a href="{{ route('register') }}" class="px-8 py-4 bg-gray-900 text-white rounded-lg hover:bg-gray-800 transition-all transform hover:scale-105 text-lg font-semibold shadow-lg">
                            Mulai Sekarang - Gratis
                        </a>
                    @endif
                    <a href="{{ route('login') }}" class="px-8 py-4 bg-white text-gray-900 border-2 border-gray-900 rounded-lg hover:bg-gray-50 transition-all transform hover:scale-105 text-lg font-semibold">
                        Masuk ke Akun
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-16 px-4 sm:px-6 lg:px-8 bg-white">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                @php
                    $totalModules = \App\Models\Module::count();
                    $totalQuestions = \App\Models\Question::count();
                    $totalStudents = \App\Models\User::students()->active()->count();
                    $totalCompleted = \App\Models\StudentModule::completed()->count();
                @endphp
                <div class="text-center">
                    <div class="text-4xl font-bold text-gray-900 mb-2">{{ $totalModules }}</div>
                    <div class="text-sm text-gray-600">Modul Tryout</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl font-bold text-gray-900 mb-2">{{ $totalQuestions }}</div>
                    <div class="text-sm text-gray-600">Soal Tersedia</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl font-bold text-gray-900 mb-2">{{ $totalStudents }}</div>
                    <div class="text-sm text-gray-600">Siswa Aktif</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl font-bold text-gray-900 mb-2">{{ $totalCompleted }}</div>
                    <div class="text-sm text-gray-600">Ujian Diselesaikan</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-20 px-4 sm:px-6 lg:px-8 bg-gray-50" id="features">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16 fade-in-up">
                <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4">Fitur Unggulan</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Platform lengkap dengan fitur-fitur canggih untuk membantu persiapan UTBK/SBMPTN Anda
                </p>
            </div>
            
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="feature-card bg-white rounded-xl p-8 border border-gray-200 shadow-sm">
                    <div class="w-14 h-14 bg-gray-100 rounded-lg flex items-center justify-center mb-6">
                        <svg class="w-7 h-7 text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Bank Soal Lengkap</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Ribuan soal berkualitas tinggi dari berbagai kategori mata pelajaran UTBK/SBMPTN dengan tingkat kesulitan yang bervariasi.
                    </p>
                </div>

                <!-- Feature 2 -->
                <div class="feature-card bg-white rounded-xl p-8 border border-gray-200 shadow-sm">
                    <div class="w-14 h-14 bg-gray-100 rounded-lg flex items-center justify-center mb-6">
                        <svg class="w-7 h-7 text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Analisis Performa</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Dashboard analitik lengkap dengan grafik performa, tracking progress, dan identifikasi kelemahan untuk perbaikan yang lebih terarah.
                    </p>
                </div>

                <!-- Feature 3 -->
                <div class="feature-card bg-white rounded-xl p-8 border border-gray-200 shadow-sm">
                    <div class="w-14 h-14 bg-gray-100 rounded-lg flex items-center justify-center mb-6">
                        <svg class="w-7 h-7 text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Sistem Ranking</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Kompetisi sehat dengan sistem ranking global dan per modul. Lihat posisi Anda dan motivasi untuk terus meningkatkan performa.
                    </p>
                </div>

                <!-- Feature 4 -->
                <div class="feature-card bg-white rounded-xl p-8 border border-gray-200 shadow-sm">
                    <div class="w-14 h-14 bg-gray-100 rounded-lg flex items-center justify-center mb-6">
                        <svg class="w-7 h-7 text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Timer Real-time</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Simulasi ujian dengan timer real-time yang membantu Anda mengelola waktu dengan efektif selama ujian.
                    </p>
                </div>

                <!-- Feature 5 -->
                <div class="feature-card bg-white rounded-xl p-8 border border-gray-200 shadow-sm">
                    <div class="w-14 h-14 bg-gray-100 rounded-lg flex items-center justify-center mb-6">
                        <svg class="w-7 h-7 text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Review Jawaban</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Setelah ujian, review jawaban Anda dengan pembahasan lengkap untuk setiap soal agar pemahaman semakin mendalam.
                    </p>
                </div>

                <!-- Feature 6 -->
                <div class="feature-card bg-white rounded-xl p-8 border border-gray-200 shadow-sm">
                    <div class="w-14 h-14 bg-gray-100 rounded-lg flex items-center justify-center mb-6">
                        <svg class="w-7 h-7 text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Akses Cepat</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Interface yang responsif dan user-friendly, dapat diakses dari berbagai perangkat untuk belajar kapan saja dan di mana saja.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Reviews Section -->
    <section class="py-20 px-4 sm:px-6 lg:px-8 bg-white" id="reviews">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16 fade-in-up">
                <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4">Apa Kata Mereka?</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Testimoni dari siswa yang telah menggunakan platform kami
                </p>
            </div>
            
            <div class="grid md:grid-cols-3 gap-8">
                <!-- Review 1 -->
                <div class="review-card bg-gray-50 rounded-xl p-8 border border-gray-200">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-gray-200 rounded-full flex items-center justify-center">
                            <span class="text-gray-700 font-semibold">AS</span>
                        </div>
                        <div class="ml-4">
                            <div class="font-semibold text-gray-900">Ahmad Surya</div>
                            <div class="text-sm text-gray-600">Siswa SMA</div>
                        </div>
                    </div>
                    <div class="flex mb-4">
                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                    </div>
                    <p class="text-gray-700 leading-relaxed">
                        "Platform ini sangat membantu persiapan UTBK saya. Soal-soalnya lengkap dan pembahasannya jelas. Ranking system juga memotivasi saya untuk terus belajar."
                    </p>
                </div>

                <!-- Review 2 -->
                <div class="review-card bg-gray-50 rounded-xl p-8 border border-gray-200">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-gray-200 rounded-full flex items-center justify-center">
                            <span class="text-gray-700 font-semibold">DR</span>
                        </div>
                        <div class="ml-4">
                            <div class="font-semibold text-gray-900">Dewi Rahayu</div>
                            <div class="text-sm text-gray-600">Siswa SMA</div>
                        </div>
                    </div>
                    <div class="flex mb-4">
                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                    </div>
                    <p class="text-gray-700 leading-relaxed">
                        "Analisis performa yang detail sangat membantu saya mengetahui kelemahan di setiap kategori. Interface-nya juga mudah digunakan dan responsif."
                    </p>
                </div>

                <!-- Review 3 -->
                <div class="review-card bg-gray-50 rounded-xl p-8 border border-gray-200">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-gray-200 rounded-full flex items-center justify-center">
                            <span class="text-gray-700 font-semibold">BP</span>
                        </div>
                        <div class="ml-4">
                            <div class="font-semibold text-gray-900">Budi Pratama</div>
                            <div class="text-sm text-gray-600">Siswa SMA</div>
                        </div>
                    </div>
                    <div class="flex mb-4">
                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                    </div>
                    <p class="text-gray-700 leading-relaxed">
                        "Timer yang real-time sangat membantu saya berlatih manajemen waktu. Sekarang saya lebih percaya diri menghadapi ujian UTBK yang sebenarnya."
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 px-4 sm:px-6 lg:px-8 bg-gray-900">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="text-3xl sm:text-4xl font-bold text-white mb-6">
                Siap Memulai Perjalanan Menuju PTN Impian?
            </h2>
            <p class="text-xl text-gray-300 mb-10 leading-relaxed">
                Bergabunglah dengan ribuan siswa lainnya dan mulai persiapan UTBK/SBMPTN Anda hari ini. 
                Gratis, mudah, dan efektif.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                @if(\App\Models\Setting::getValue('registration_enabled', true))
                    <a href="{{ route('register') }}" class="px-8 py-4 bg-white text-gray-900 rounded-lg hover:bg-gray-100 transition-all transform hover:scale-105 text-lg font-semibold shadow-lg">
                        Daftar Sekarang - Gratis
                    </a>
                @endif
                <a href="{{ route('login') }}" class="px-8 py-4 bg-transparent text-white border-2 border-white rounded-lg hover:bg-white hover:text-gray-900 transition-all transform hover:scale-105 text-lg font-semibold">
                    Masuk ke Akun
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-200 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="text-center">
                <div class="flex items-center justify-center space-x-3 mb-4">
                    @if($siteIcon && file_exists(public_path('storage/' . $siteIcon)))
                        <img src="{{ asset('storage/' . $siteIcon) }}" alt="Logo" class="h-8 w-8">
                    @else
                        <div class="h-8 w-8 bg-gray-900 rounded-lg flex items-center justify-center">
                            <span class="text-white font-bold">T</span>
                        </div>
                    @endif
                    <span class="text-lg font-semibold text-gray-900">{{ \App\Models\Setting::getValue('site_name', 'Tryout UTBK') }}</span>
                </div>
                <p class="text-gray-600 mb-6">
                    Platform tryout UTBK/SBMPTN terpercaya untuk membantu Anda meraih impian kuliah di PTN favorit.
                </p>
                <div class="text-sm text-gray-500">
                    © {{ date('Y') }} {{ \App\Models\Setting::getValue('site_name', 'Tryout UTBK') }}. All rights reserved.
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Smooth scroll animation on load
        document.addEventListener('DOMContentLoaded', function() {
            const elements = document.querySelectorAll('.fade-in-up');
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            }, { threshold: 0.1 });
            
            elements.forEach(el => {
                el.style.opacity = '0';
                el.style.transform = 'translateY(30px)';
                el.style.transition = 'opacity 0.6s ease-out, transform 0.6s ease-out';
                observer.observe(el);
            });
        });
    </script>
</body>
</html>

