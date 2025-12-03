<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Platform Tryout UTBK/SBMPTN - Raih Impianmu di PTN Favorit</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            scroll-behavior: smooth;
        }

        /* Orange Gradient Text */
        .gradient-orange {
            background: linear-gradient(135deg, #f97316 0%, #fb923c 50%, #ea580c 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .gradient-bg-orange {
            background: linear-gradient(135deg, #f97316 0%, #fb923c 100%);
        }

        .gradient-bg-orange-dark {
            background: linear-gradient(135deg, #ea580c 0%, #f97316 100%);
        }

        /* Card Hover Animation */
        .card-hover {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .card-hover:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 20px 25px -5px rgba(249, 115, 22, 0.2), 0 10px 10px -5px rgba(249, 115, 22, 0.1);
        }

        /* Nav Link Animation */
        .nav-link {
            position: relative;
            transition: color 0.3s ease;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -4px;
            left: 0;
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, #f97316, #fb923c);
            transition: width 0.3s ease;
        }

        .nav-link:hover::after {
            width: 100%;
        }

        /* Floating Animation */
        @keyframes float {
            0%, 100% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-20px);
            }
        }

        .float-animation {
            animation: float 6s ease-in-out infinite;
        }

        .float-animation-delay {
            animation: float 6s ease-in-out infinite;
            animation-delay: 2s;
        }

        /* Fade In Up Animation */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(40px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in-up {
            animation: fadeInUp 0.8s ease forwards;
        }

        .delay-1 { animation-delay: 0.1s; opacity: 0; }
        .delay-2 { animation-delay: 0.2s; opacity: 0; }
        .delay-3 { animation-delay: 0.3s; opacity: 0; }
        .delay-4 { animation-delay: 0.4s; opacity: 0; }
        .delay-5 { animation-delay: 0.5s; opacity: 0; }
        .delay-6 { animation-delay: 0.6s; opacity: 0; }

        /* Pulse Animation */
        @keyframes pulse-orange {
            0%, 100% {
                box-shadow: 0 0 0 0 rgba(249, 115, 22, 0.7);
            }
            50% {
                box-shadow: 0 0 0 20px rgba(249, 115, 22, 0);
            }
        }

        .pulse-orange {
            animation: pulse-orange 2s infinite;
        }

        /* Slide In Animation */
        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-50px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .slide-in-left {
            animation: slideInLeft 0.8s ease forwards;
        }

        /* Scale Animation */
        @keyframes scaleIn {
            from {
                opacity: 0;
                transform: scale(0.8);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .scale-in {
            animation: scaleIn 0.6s ease forwards;
        }

        /* Button Hover Effect */
        .btn-orange {
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .btn-orange::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.3);
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
        }

        .btn-orange:hover::before {
            width: 300px;
            height: 300px;
        }

        /* Number Counter Animation */
        @keyframes countUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .count-up {
            animation: countUp 1s ease forwards;
        }

        /* Shimmer Effect */
        @keyframes shimmer {
            0% {
                background-position: -1000px 0;
            }
            100% {
                background-position: 1000px 0;
            }
        }

        .shimmer {
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            background-size: 1000px 100%;
            animation: shimmer 3s infinite;
        }

        /* Scroll Reveal */
        .reveal {
            opacity: 0;
            transform: translateY(50px);
            transition: all 0.8s ease;
        }

        .reveal.active {
            opacity: 1;
            transform: translateY(0);
        }

        /* Gradient Border */
        .gradient-border {
            position: relative;
            background: white;
            border-radius: 12px;
        }

        .gradient-border::before {
            content: '';
            position: absolute;
            inset: 0;
            border-radius: 12px;
            padding: 2px;
            background: linear-gradient(135deg, #f97316, #fb923c);
            -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
            -webkit-mask-composite: xor;
            mask-composite: exclude;
        }

        /* Icon Bounce */
        @keyframes bounce-slow {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-10px);
            }
        }

        .bounce-slow {
            animation: bounce-slow 2s ease-in-out infinite;
        }

        /* Background Pattern */
        .bg-pattern {
            background-image: 
                radial-gradient(circle at 20% 50%, rgba(249, 115, 22, 0.05) 0%, transparent 50%),
                radial-gradient(circle at 80% 80%, rgba(251, 146, 60, 0.05) 0%, transparent 50%);
        }
    </style>
</head>
<body class="bg-white">
    <!-- Navigation -->
    <nav class="fixed w-full bg-white/95 backdrop-blur-md border-b border-orange-100 z-50 transition-all duration-300" id="navbar">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <div class="flex items-center space-x-3 group cursor-pointer">
                    <div class="w-10 h-10 gradient-bg-orange rounded-xl flex items-center justify-center shadow-lg transform transition-transform group-hover:scale-110">
                        <span class="text-white font-bold text-lg">PT</span>
                    </div>
                    <span class="text-xl font-bold text-gray-900">Platform Tryout</span>
                </div>
                
                <div class="hidden md:flex items-center space-x-10">
                    <a href="#features" class="nav-link text-gray-600 hover:text-orange-600 font-medium">Fitur</a>
                    <a href="#how-it-works" class="nav-link text-gray-600 hover:text-orange-600 font-medium">Cara Kerja</a>
                    <a href="#testimonials" class="nav-link text-gray-600 hover:text-orange-600 font-medium">Testimoni</a>
                    <a href="#faq" class="nav-link text-gray-600 hover:text-orange-600 font-medium">FAQ</a>
                </div>

                <div class="hidden md:flex items-center space-x-4">
                    <a href="/login" class="text-gray-700 hover:text-orange-600 px-4 py-2 transition font-medium">Masuk</a>
                    <a href="/register" class="gradient-bg-orange text-white px-6 py-3 rounded-xl hover:shadow-lg transition-all font-medium btn-orange">
                        Daftar Gratis
                    </a>
                </div>

                <!-- Mobile menu button -->
                <button id="mobile-menu-button" class="md:hidden p-2 rounded-lg text-gray-600 hover:text-orange-600 hover:bg-orange-50 transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>

            <!-- Mobile menu -->
            <div id="mobile-menu" class="hidden md:hidden pb-4 border-t border-orange-100 mt-4">
                <div class="flex flex-col space-y-4 pt-4">
                    <a href="#features" class="nav-link text-gray-600 hover:text-orange-600 font-medium px-2 py-2">Fitur</a>
                    <a href="#how-it-works" class="nav-link text-gray-600 hover:text-orange-600 font-medium px-2 py-2">Cara Kerja</a>
                    <a href="#testimonials" class="nav-link text-gray-600 hover:text-orange-600 font-medium px-2 py-2">Testimoni</a>
                    <a href="#faq" class="nav-link text-gray-600 hover:text-orange-600 font-medium px-2 py-2">FAQ</a>
                    <div class="flex flex-col space-y-2 pt-2">
                        <a href="/login" class="text-gray-700 hover:text-orange-600 px-4 py-2 transition font-medium text-center">Masuk</a>
                        <a href="/register" class="gradient-bg-orange text-white px-6 py-3 rounded-xl hover:shadow-lg transition-all font-medium btn-orange text-center">
                            Daftar Gratis
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="pt-32 pb-24 px-4 sm:px-6 lg:px-8 bg-pattern relative overflow-hidden">
        <div class="absolute top-0 right-0 w-96 h-96 bg-orange-100 rounded-full blur-3xl opacity-30"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-orange-200 rounded-full blur-3xl opacity-20"></div>
        
        <div class="max-w-7xl mx-auto relative z-10">
            <div class="grid md:grid-cols-2 gap-16 items-center">
                <div class="space-y-8">
                    <div class="space-y-6 fade-in-up delay-1">
                        <div class="inline-flex items-center px-4 py-2 bg-orange-50 border border-orange-200 rounded-full text-sm text-orange-700 font-medium">
                            <span class="w-2 h-2 bg-orange-500 rounded-full mr-2 pulse-orange"></span>
                            Platform Persiapan UTBK/SBMPTN Terpercaya
                        </div>
                        <h1 class="text-5xl md:text-6xl lg:text-7xl font-extrabold text-gray-900 leading-tight">
                            Raih Impianmu di<br/>
                            <span class="gradient-orange">PTN Favorit</span>
                        </h1>
                        <p class="text-xl text-gray-600 leading-relaxed max-w-xl">
                            Platform tryout online dengan sistem penilaian akurat, analisis mendalam, dan ribuan soal berkualitas untuk persiapan optimal UTBK/SBMPTN.
                        </p>
                    </div>

                    <div class="flex flex-col sm:flex-row gap-4 fade-in-up delay-2">
                        <a href="/register" class="gradient-bg-orange text-white px-8 py-4 rounded-xl hover:shadow-xl transition-all text-center font-semibold btn-orange transform hover:scale-105">
                            Mulai Belajar Sekarang →
                        </a>
                        <a href="#how-it-works" class="border-2 border-orange-500 text-orange-600 px-8 py-4 rounded-xl hover:bg-orange-50 transition text-center font-semibold">
                            Pelajari Lebih Lanjut
                        </a>
                    </div>

                    <div class="flex items-center space-x-8 pt-6 fade-in-up delay-3">
                        <div class="text-center">
                            <div class="text-4xl font-bold gradient-orange mb-1 count-up">10K+</div>
                            <div class="text-sm text-gray-600 font-medium">Siswa Aktif</div>
                        </div>
                        <div class="h-16 w-px bg-gradient-to-b from-transparent via-orange-300 to-transparent"></div>
                        <div class="text-center">
                            <div class="text-4xl font-bold gradient-orange mb-1 count-up">5K+</div>
                            <div class="text-sm text-gray-600 font-medium">Bank Soal</div>
                        </div>
                        <div class="h-16 w-px bg-gradient-to-b from-transparent via-orange-300 to-transparent"></div>
                        <div class="text-center">
                            <div class="text-4xl font-bold gradient-orange mb-1 count-up">95%</div>
                            <div class="text-sm text-gray-600 font-medium">Tingkat Kepuasan</div>
                        </div>
                    </div>
                </div>

                <div class="relative fade-in-up delay-4">
                    <div class="absolute inset-0 bg-gradient-to-r from-orange-400 to-orange-600 rounded-3xl transform rotate-6 opacity-20"></div>
                    <div class="relative bg-white rounded-3xl shadow-2xl p-8 float-animation border border-orange-100">
                        <div class="flex items-center justify-between pb-6 border-b border-gray-100">
                            <div class="flex items-center space-x-4">
                                <div class="w-12 h-12 gradient-bg-orange rounded-xl flex items-center justify-center shadow-lg">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                </div>
                                <div>
                                    <div class="font-bold text-gray-900 text-lg">Tryout UTBK #1</div>
                                    <div class="text-sm text-gray-500">150 Soal • 180 Menit</div>
                                </div>
                            </div>
                            <div class="text-right">
                                <div class="text-xs text-gray-500 uppercase tracking-wide">Passing Grade</div>
                                <div class="text-2xl font-bold gradient-orange">75%</div>
                            </div>
                        </div>
                        
                        <div class="space-y-3 mt-6">
                            <div class="flex items-center justify-between p-4 bg-orange-50 rounded-xl border border-orange-100 hover:bg-orange-100 transition">
                                <div class="flex items-center space-x-3">
                                    <div class="w-2 h-2 bg-orange-500 rounded-full"></div>
                                    <span class="text-gray-700 font-medium">TPS - Penalaran Umum</span>
                                </div>
                                <span class="text-orange-600 font-bold">20 Soal</span>
                            </div>
                            <div class="flex items-center justify-between p-4 bg-orange-50 rounded-xl border border-orange-100 hover:bg-orange-100 transition">
                                <div class="flex items-center space-x-3">
                                    <div class="w-2 h-2 bg-orange-500 rounded-full"></div>
                                    <span class="text-gray-700 font-medium">Matematika</span>
                                </div>
                                <span class="text-orange-600 font-bold">15 Soal</span>
                            </div>
                            <div class="flex items-center justify-between p-4 bg-orange-50 rounded-xl border border-orange-100 hover:bg-orange-100 transition">
                                <div class="flex items-center space-x-3">
                                    <div class="w-2 h-2 bg-orange-500 rounded-full"></div>
                                    <span class="text-gray-700 font-medium">Fisika</span>
                                </div>
                                <span class="text-orange-600 font-bold">15 Soal</span>
                            </div>
                        </div>

                        <a href="/register" class="block w-full gradient-bg-orange text-white py-4 rounded-xl font-bold hover:shadow-xl transition-all mt-6 btn-orange transform hover:scale-105 text-center">
                            Mulai Tryout
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-20 reveal">
                <h2 class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-4">
                    Fitur <span class="gradient-orange">Unggulan</span>
                </h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Dilengkapi dengan berbagai fitur canggih untuk memaksimalkan persiapan UTBK Anda
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="bg-white p-8 rounded-2xl shadow-lg card-hover border border-orange-100 reveal">
                    <div class="w-14 h-14 gradient-bg-orange rounded-xl flex items-center justify-center mb-6 shadow-lg bounce-slow">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">Bank Soal Lengkap</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Ribuan soal berkualitas dengan pembahasan detail untuk semua materi UTBK/SBMPTN yang selalu diperbarui.
                    </p>
                </div>

                <div class="bg-white p-8 rounded-2xl shadow-lg card-hover border border-orange-100 reveal">
                    <div class="w-14 h-14 gradient-bg-orange rounded-xl flex items-center justify-center mb-6 shadow-lg bounce-slow">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">Analisis Mendalam</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Analisis performa per kategori dengan visualisasi data interaktif untuk identifikasi kelemahan dan kekuatan.
                    </p>
                </div>

                <div class="bg-white p-8 rounded-2xl shadow-lg card-hover border border-orange-100 reveal">
                    <div class="w-14 h-14 gradient-bg-orange rounded-xl flex items-center justify-center mb-6 shadow-lg bounce-slow">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">Sistem Ranking</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Kompetisi sehat dengan sistem ranking real-time untuk memotivasi dan meningkatkan semangat belajar.
                    </p>
                </div>

                <div class="bg-white p-8 rounded-2xl shadow-lg card-hover border border-orange-100 reveal">
                    <div class="w-14 h-14 gradient-bg-orange rounded-xl flex items-center justify-center mb-6 shadow-lg bounce-slow">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">Timer Real-time</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Simulasi ujian dengan timer akurat dan auto-save untuk pengalaman ujian yang mirip dengan ujian sesungguhnya.
                    </p>
                </div>

                <div class="bg-white p-8 rounded-2xl shadow-lg card-hover border border-orange-100 reveal">
                    <div class="w-14 h-14 gradient-bg-orange rounded-xl flex items-center justify-center mb-6 shadow-lg bounce-slow">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">Progress Tracking</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Pantau perkembangan belajar harian dengan grafik dan statistik lengkap yang mudah dipahami.
                    </p>
                </div>

                <div class="bg-white p-8 rounded-2xl shadow-lg card-hover border border-orange-100 reveal">
                    <div class="w-14 h-14 gradient-bg-orange rounded-xl flex items-center justify-center mb-6 shadow-lg bounce-slow">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">Achievement System</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Raih badge dan pencapaian untuk meningkatkan motivasi belajar dan membuat proses belajar lebih menyenangkan.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works -->
    <section id="how-it-works" class="py-24 bg-gradient-to-b from-orange-50 to-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-20 reveal">
                <h2 class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-4">
                    Cara <span class="gradient-orange">Kerja</span>
                </h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Mulai persiapan UTBK Anda dalam 3 langkah sederhana
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-12">
                <div class="text-center reveal">
                    <div class="relative inline-block mb-8">
                        <div class="w-24 h-24 gradient-bg-orange rounded-2xl flex items-center justify-center mx-auto shadow-xl scale-in">
                            <span class="text-3xl font-bold text-white">1</span>
                        </div>
                        <div class="absolute -top-2 -right-2 w-8 h-8 bg-orange-200 rounded-full flex items-center justify-center">
                            <svg class="w-4 h-4 text-orange-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Daftar & Login</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Buat akun gratis dalam hitungan detik dan akses dashboard pribadi dengan fitur lengkap untuk memulai perjalanan belajar Anda.
                    </p>
                </div>

                <div class="text-center reveal">
                    <div class="relative inline-block mb-8">
                        <div class="w-24 h-24 gradient-bg-orange rounded-2xl flex items-center justify-center mx-auto shadow-xl scale-in">
                            <span class="text-3xl font-bold text-white">2</span>
                        </div>
                        <div class="absolute -top-2 -right-2 w-8 h-8 bg-orange-200 rounded-full flex items-center justify-center">
                            <svg class="w-4 h-4 text-orange-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Pilih Modul Tryout</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Pilih dari berbagai paket tryout yang tersedia sesuai kebutuhan dan tingkat kesulitan yang Anda inginkan.
                    </p>
                </div>

                <div class="text-center reveal">
                    <div class="relative inline-block mb-8">
                        <div class="w-24 h-24 gradient-bg-orange rounded-2xl flex items-center justify-center mx-auto shadow-xl scale-in">
                            <span class="text-3xl font-bold text-white">3</span>
                        </div>
                        <div class="absolute -top-2 -right-2 w-8 h-8 bg-orange-200 rounded-full flex items-center justify-center">
                            <svg class="w-4 h-4 text-orange-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Analisis & Tingkatkan</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Review hasil ujian, analisis kelemahan dan kekuatan, lalu tingkatkan performa Anda dengan latihan yang lebih fokus.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section id="stats" class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-4 gap-8 text-center">
                <div class="reveal">
                    <div class="text-6xl font-extrabold gradient-orange mb-3 count-up">10,000+</div>
                    <div class="text-gray-600 font-medium text-lg">Siswa Terdaftar</div>
                </div>
                <div class="reveal">
                    <div class="text-6xl font-extrabold gradient-orange mb-3 count-up">5,000+</div>
                    <div class="text-gray-600 font-medium text-lg">Bank Soal</div>
                </div>
                <div class="reveal">
                    <div class="text-6xl font-extrabold gradient-orange mb-3 count-up">50+</div>
                    <div class="text-gray-600 font-medium text-lg">Paket Tryout</div>
                </div>
                <div class="reveal">
                    <div class="text-6xl font-extrabold gradient-orange mb-3 count-up">95%</div>
                    <div class="text-gray-600 font-medium text-lg">Tingkat Kepuasan</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section id="testimonials" class="py-24 bg-gradient-to-b from-white to-orange-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-20 reveal">
                <h2 class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-4">
                    Kata <span class="gradient-orange">Mereka</span>
                </h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Testimoni dari siswa yang telah berhasil menggunakan platform kami
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <div class="bg-white p-8 rounded-2xl shadow-lg card-hover border border-orange-100 reveal">
                    <div class="flex items-center mb-6">
                        <div class="w-12 h-12 gradient-bg-orange rounded-full flex items-center justify-center text-white font-bold text-lg mr-4">
                            A
                        </div>
                        <div>
                            <div class="font-bold text-gray-900">Ahmad Rizki</div>
                            <div class="text-sm text-gray-500">Lulusan ITB 2024</div>
                        </div>
                    </div>
                    <div class="flex mb-4">
                        <svg class="w-5 h-5 text-orange-500" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                        <svg class="w-5 h-5 text-orange-500" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                        <svg class="w-5 h-5 text-orange-500" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                        <svg class="w-5 h-5 text-orange-500" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                        <svg class="w-5 h-5 text-orange-500" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                    </div>
                    <p class="text-gray-600 leading-relaxed italic">
                        "Platform ini sangat membantu persiapan UTBK saya. Analisis yang detail membuat saya tahu di mana kelemahan saya dan bisa fokus memperbaikinya."
                    </p>
                </div>

                <div class="bg-white p-8 rounded-2xl shadow-lg card-hover border border-orange-100 reveal">
                    <div class="flex items-center mb-6">
                        <div class="w-12 h-12 gradient-bg-orange rounded-full flex items-center justify-center text-white font-bold text-lg mr-4">
                            S
                        </div>
                        <div>
                            <div class="font-bold text-gray-900">Siti Nurhaliza</div>
                            <div class="text-sm text-gray-500">Lulusan UI 2024</div>
                        </div>
                    </div>
                    <div class="flex mb-4">
                        <svg class="w-5 h-5 text-orange-500" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                        <svg class="w-5 h-5 text-orange-500" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                        <svg class="w-5 h-5 text-orange-500" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                        <svg class="w-5 h-5 text-orange-500" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                        <svg class="w-5 h-5 text-orange-500" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                    </div>
                    <p class="text-gray-600 leading-relaxed italic">
                        "Sistem ranking membuat saya termotivasi untuk terus belajar. Fitur analisisnya sangat membantu untuk mengetahui progress belajar."
                    </p>
                </div>

                <div class="bg-white p-8 rounded-2xl shadow-lg card-hover border border-orange-100 reveal">
                    <div class="flex items-center mb-6">
                        <div class="w-12 h-12 gradient-bg-orange rounded-full flex items-center justify-center text-white font-bold text-lg mr-4">
                            B
                        </div>
                        <div>
                            <div class="font-bold text-gray-900">Budi Santoso</div>
                            <div class="text-sm text-gray-500">Lulusan UGM 2024</div>
                        </div>
                    </div>
                    <div class="flex mb-4">
                        <svg class="w-5 h-5 text-orange-500" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                        <svg class="w-5 h-5 text-orange-500" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                        <svg class="w-5 h-5 text-orange-500" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                        <svg class="w-5 h-5 text-orange-500" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                        <svg class="w-5 h-5 text-orange-500" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                    </div>
                    <p class="text-gray-600 leading-relaxed italic">
                        "Bank soalnya sangat lengkap dan pembahasannya jelas. Timer real-time membuat saya terbiasa dengan kondisi ujian yang sesungguhnya."
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section id="faq" class="py-24 bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-20 reveal">
                <h2 class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-4">
                    Pertanyaan <span class="gradient-orange">Umum</span>
                </h2>
                <p class="text-xl text-gray-600">
                    Jawaban untuk pertanyaan yang sering diajukan
                </p>
            </div>

            <div class="space-y-4">
                <div class="bg-white border-2 border-orange-100 rounded-xl p-6 reveal">
                    <div class="flex items-center justify-between cursor-pointer" onclick="toggleFAQ(this)">
                        <h3 class="text-lg font-bold text-gray-900">Apakah platform ini gratis?</h3>
                        <svg class="w-6 h-6 text-orange-600 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </div>
                    <div class="faq-content hidden mt-4 text-gray-600 leading-relaxed">
                        Ya, platform ini sepenuhnya gratis untuk digunakan. Anda dapat mengakses semua fitur termasuk bank soal, tryout, analisis, dan ranking tanpa biaya apapun.
                    </div>
                </div>

                <div class="bg-white border-2 border-orange-100 rounded-xl p-6 reveal">
                    <div class="flex items-center justify-between cursor-pointer" onclick="toggleFAQ(this)">
                        <h3 class="text-lg font-bold text-gray-900">Bagaimana cara mengikuti tryout?</h3>
                        <svg class="w-6 h-6 text-orange-600 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </div>
                    <div class="faq-content hidden mt-4 text-gray-600 leading-relaxed">
                        Setelah login, pilih modul tryout yang ingin Anda kerjakan, klik "Mulai Tryout", dan ikuti instruksi yang ada. Timer akan otomatis berjalan dan jawaban Anda akan tersimpan secara otomatis.
                    </div>
                </div>

                <div class="bg-white border-2 border-orange-100 rounded-xl p-6 reveal">
                    <div class="flex items-center justify-between cursor-pointer" onclick="toggleFAQ(this)">
                        <h3 class="text-lg font-bold text-gray-900">Apakah ada batasan jumlah tryout?</h3>
                        <svg class="w-6 h-6 text-orange-600 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </div>
                    <div class="faq-content hidden mt-4 text-gray-600 leading-relaxed">
                        Setiap modul tryout memiliki batasan maksimal percobaan yang dapat Anda lihat di detail modul. Namun, Anda dapat mengikuti tryout sebanyak yang Anda inginkan untuk modul yang berbeda.
                    </div>
                </div>

                <div class="bg-white border-2 border-orange-100 rounded-xl p-6 reveal">
                    <div class="flex items-center justify-between cursor-pointer" onclick="toggleFAQ(this)">
                        <h3 class="text-lg font-bold text-gray-900">Bagaimana sistem ranking bekerja?</h3>
                        <svg class="w-6 h-6 text-orange-600 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </div>
                    <div class="faq-content hidden mt-4 text-gray-600 leading-relaxed">
                        Sistem ranking dihitung berdasarkan skor yang Anda peroleh dalam setiap modul tryout. Semakin banyak modul yang dikerjakan dan semakin tinggi skor yang Anda peroleh, semakin baik posisi Anda dalam ranking global.
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section id="cta" class="py-24 bg-gradient-to-b from-orange-50 to-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center reveal">
                <h2 class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-4">
                    Siap Memulai Perjalanan Belajar?
                </h2>
                <p class="text-xl text-gray-600 mb-8 max-w-2xl mx-auto">
                    Daftar sekarang dan dapatkan akses ke ribuan soal berkualitas, analisis mendalam, dan fitur lengkap untuk persiapan UTBK terbaik Anda.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="/register" class="gradient-bg-orange text-white px-8 py-4 rounded-xl hover:shadow-xl transition-all text-center font-semibold btn-orange transform hover:scale-105">
                        Daftar Gratis Sekarang →
                    </a>
                    <a href="/login" class="border-2 border-orange-500 text-orange-600 px-8 py-4 rounded-xl hover:bg-orange-50 transition text-center font-semibold">
                        Sudah Punya Akun? Masuk
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-4 gap-8">
                <div>
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="w-10 h-10 gradient-bg-orange rounded-xl flex items-center justify-center shadow-lg">
                            <span class="text-white font-bold text-lg">PT</span>
                        </div>
                        <span class="text-xl font-bold">Platform Tryout</span>
                    </div>
                    <p class="text-gray-400 text-sm">
                        Platform persiapan UTBK/SBMPTN terpercaya dengan ribuan soal berkualitas dan analisis mendalam.
                    </p>
                </div>
                <div>
                    <h4 class="font-bold mb-4">Tautan Cepat</h4>
                    <ul class="space-y-2 text-gray-400 text-sm">
                        <li><a href="#features" class="hover:text-orange-400 transition">Fitur</a></li>
                        <li><a href="#how-it-works" class="hover:text-orange-400 transition">Cara Kerja</a></li>
                        <li><a href="#testimonials" class="hover:text-orange-400 transition">Testimoni</a></li>
                        <li><a href="#faq" class="hover:text-orange-400 transition">FAQ</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold mb-4">Akun</h4>
                    <ul class="space-y-2 text-gray-400 text-sm">
                        <li><a href="/login" class="hover:text-orange-400 transition">Masuk</a></li>
                        <li><a href="/register" class="hover:text-orange-400 transition">Daftar</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold mb-4">Kontak</h4>
                    <p class="text-gray-400 text-sm">
                        Email: support@platformtryout.com<br>
                        Telp: (021) 1234-5678
                    </p>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400 text-sm">
                <p>&copy; 2024 Platform Tryout. All rights reserved.</p>
            </div>
        </div>
    </footer>

<script>
        // Mobile menu toggle
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');
        
        if (mobileMenuButton && mobileMenu) {
            mobileMenuButton.addEventListener('click', function() {
                mobileMenu.classList.toggle('hidden');
                const icon = mobileMenuButton.querySelector('svg');
                if (mobileMenu.classList.contains('hidden')) {
                    icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>';
                } else {
                    icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>';
                }
            });

            // Close mobile menu when clicking on a link
            mobileMenu.querySelectorAll('a').forEach(link => {
                link.addEventListener('click', function() {
                    mobileMenu.classList.add('hidden');
                    const icon = mobileMenuButton.querySelector('svg');
                    icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>';
                });
            });
        }

        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.getElementById('navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('shadow-lg');
                navbar.classList.remove('border-b');
            } else {
                navbar.classList.remove('shadow-lg');
                navbar.classList.add('border-b');
            }
        });

        // Scroll reveal animation
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('active');
                }
            });
        }, observerOptions);

        document.querySelectorAll('.reveal').forEach(el => {
            observer.observe(el);
        });

        // FAQ toggle
    function toggleFAQ(element) {
        const content = element.nextElementSibling;
            const icon = element.querySelector('svg');
        content.classList.toggle('hidden');
            icon.classList.toggle('rotate-180');
        }

        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Number counter animation
        function animateCounter(element, target, duration = 2000) {
            let start = 0;
            const increment = target / (duration / 16);
            const timer = setInterval(() => {
                start += increment;
                if (start >= target) {
                    element.textContent = target.toLocaleString('id-ID') + (element.textContent.includes('%') ? '%' : '');
                    clearInterval(timer);
                } else {
                    element.textContent = Math.floor(start).toLocaleString('id-ID') + (element.textContent.includes('%') ? '%' : '');
                }
            }, 16);
        }

        // Trigger counter animation when in view
        const counterObserver = new IntersectionObserver(function(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting && !entry.target.classList.contains('counted')) {
                    entry.target.classList.add('counted');
                    const text = entry.target.textContent;
                    const number = parseInt(text.replace(/[^0-9]/g, ''));
                    if (number) {
                        animateCounter(entry.target, number);
                    }
                }
            });
        }, { threshold: 0.5 });

        document.querySelectorAll('.count-up').forEach(el => {
            counterObserver.observe(el);
        });
</script>
</body>
</html>
