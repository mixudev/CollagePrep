@extends('layouts.app')

@section('title', 'Dashboard Siswa')

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="px-4 py-6 sm:px-0">
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900">Dashboard</h1>
                <p class="mt-2 text-sm text-gray-600">Selamat datang, {{ auth()->user()->name }}</p>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4 mb-8">
                <div class="bg-white overflow-hidden shadow-sm rounded-lg border border-gray-200">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-gray-100 rounded-lg p-3">
                                <svg class="h-6 w-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Modul Selesai</dt>
                                    <dd class="text-2xl font-semibold text-gray-900">{{ $stats['modules_completed'] }}</dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm rounded-lg border border-gray-200">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-gray-100 rounded-lg p-3">
                                <svg class="h-6 w-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                </svg>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Rata-rata Nilai</dt>
                                    <dd class="text-2xl font-semibold text-gray-900">{{ number_format($stats['average_score'], 1) }}</dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm rounded-lg border border-gray-200">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-gray-100 rounded-lg p-3">
                                <svg class="h-6 w-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                </svg>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Total Percobaan</dt>
                                    <dd class="text-2xl font-semibold text-gray-900">{{ $stats['total_attempts'] }}</dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm rounded-lg border border-gray-200">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-gray-100 rounded-lg p-3">
                                <svg class="h-6 w-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                                </svg>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Ranking Global</dt>
                                    <dd class="text-2xl font-semibold text-gray-900">{{ $stats['global_rank'] }}</dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Additional Stats -->
            <div class="grid grid-cols-1 gap-5 sm:grid-cols-4 mb-8">
                <div class="bg-white overflow-hidden shadow-sm rounded-lg border border-gray-200">
                    <div class="p-5">
                        <div class="flex items-center mb-2">
                            <svg class="h-5 w-5 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <div class="text-sm font-medium text-gray-500">Jawaban Benar</div>
                        </div>
                        <div class="text-2xl font-semibold text-gray-900">{{ $stats['total_correct'] }}</div>
                    </div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm rounded-lg border border-gray-200">
                    <div class="p-5">
                        <div class="flex items-center mb-2">
                            <svg class="h-5 w-5 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <div class="text-sm font-medium text-gray-500">Jawaban Salah</div>
                        </div>
                        <div class="text-2xl font-semibold text-gray-900">{{ $stats['total_wrong'] }}</div>
                    </div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm rounded-lg border border-gray-200">
                    <div class="p-5">
                        <div class="flex items-center mb-2">
                            <svg class="h-5 w-5 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <div class="text-sm font-medium text-gray-500">Tidak Dijawab</div>
                        </div>
                        <div class="text-2xl font-semibold text-gray-900">{{ $stats['total_unanswered'] }}</div>
                    </div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm rounded-lg border border-gray-200">
                    <div class="p-5">
                        <div class="flex items-center mb-2">
                            <svg class="h-5 w-5 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                            </svg>
                            <div class="text-sm font-medium text-gray-500">Score Terbaik</div>
                        </div>
                        <div class="text-2xl font-semibold text-gray-900">{{ number_format($stats['best_score'], 1) }}</div>
                    </div>
                </div>
            </div>

            <!-- Charts Row -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                <!-- Score Progress Chart -->
                <div class="bg-white shadow-sm rounded-lg border border-gray-200 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Progress Score (30 Hari Terakhir)</h3>
                    <div class="relative" style="height: 300px;">
                        <canvas id="scoreProgressChart"></canvas>
                    </div>
                </div>

                <!-- Category Performance Chart -->
                <div class="bg-white shadow-sm rounded-lg border border-gray-200 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Performa per Kategori</h3>
                    <div class="relative" style="height: 300px;">
                        <canvas id="categoryPerformanceChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Additional Charts -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                <!-- Weekly Activity -->
                <div class="bg-white shadow-sm rounded-lg border border-gray-200 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Aktivitas Mingguan</h3>
                    <div class="relative" style="height: 300px;">
                        <canvas id="weeklyActivityChart"></canvas>
                    </div>
                </div>

                <!-- Accuracy Trend -->
                <div class="bg-white shadow-sm rounded-lg border border-gray-200 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Tren Akurasi (30 Hari)</h3>
                    <div class="relative" style="height: 300px;">
                        <canvas id="accuracyTrendChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Time Analysis -->
            @if($timeAnalysis && ($timeAnalysis->avg_minutes > 0 || $timeAnalysis->min_minutes > 0 || $timeAnalysis->max_minutes > 0))
            <div class="bg-white shadow-sm rounded-lg border border-gray-200 p-6 mb-8">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Analisis Waktu Pengerjaan</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="text-center p-4 bg-gray-50 rounded-lg border border-gray-200">
                        <div class="text-2xl font-semibold text-gray-900">{{ number_format(max(0, $timeAnalysis->avg_minutes ?? 0), 1) }} menit</div>
                        <div class="text-sm text-gray-600 mt-1">Rata-rata</div>
                    </div>
                    <div class="text-center p-4 bg-gray-50 rounded-lg border border-gray-200">
                        <div class="text-2xl font-semibold text-gray-900">{{ number_format(max(0, $timeAnalysis->min_minutes ?? 0), 1) }} menit</div>
                        <div class="text-sm text-gray-600 mt-1">Tercepat</div>
                    </div>
                    <div class="text-center p-4 bg-gray-50 rounded-lg border border-gray-200">
                        <div class="text-2xl font-semibold text-gray-900">{{ number_format(max(0, $timeAnalysis->max_minutes ?? 0), 1) }} menit</div>
                        <div class="text-sm text-gray-600 mt-1">Terlama</div>
                    </div>
                </div>
            </div>
            @endif


            <!-- Recent Progress & Rankings -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- My Progress -->
                <div class="bg-white shadow-sm rounded-lg border border-gray-200">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900">Progress Terbaru</h3>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($myModules as $myModule)
                                    @if($myModule->module)
                                        <tr class="hover:bg-gray-50 transition-colors">
                                            <td class="px-6 py-4">
                                                <div class="text-sm font-medium text-gray-900">{{ $myModule->module->title }}</div>
                                                <div class="text-sm text-gray-600">Score: {{ number_format($myModule->score, 2) }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <a href="{{ route('exam.result', $myModule) }}" class="text-gray-900 hover:text-gray-700 font-medium">Lihat</a>
                                            </td>
                                        </tr>
                                    @endif
                                @empty
                                    <tr>
                                        <td colspan="2" class="px-6 py-12 text-center text-gray-500">Belum ada progress</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- My Rankings -->
                <div class="bg-white shadow-sm rounded-lg border border-gray-200">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900">Ranking Saya</h3>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($myRankings as $ranking)
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="px-6 py-4">
                                            <div class="text-sm font-medium text-gray-900">
                                                {{ $ranking->module ? $ranking->module->title : 'Global' }}
                                            </div>
                                            <div class="text-sm text-gray-600">Rank: #{{ $ranking->rank }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                            Score: {{ number_format($ranking->average_score ?? $ranking->score, 2) }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2" class="px-6 py-12 text-center text-gray-500">Belum ada ranking</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Helper function to get CSS variable and convert to RGB
function getCSSVariable(varName) {
    return getComputedStyle(document.documentElement).getPropertyValue(varName).trim();
}

function hexToRgb(hex) {
    const result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
    return result ? {
        r: parseInt(result[1], 16),
        g: parseInt(result[2], 16),
        b: parseInt(result[3], 16)
    } : null;
}

function getSecondaryColor() {
    const secondaryColor = getCSSVariable('--secondary-color') || '#f97316';
    const rgb = hexToRgb(secondaryColor);
    return {
        hex: secondaryColor,
        rgb: `rgb(${rgb.r}, ${rgb.g}, ${rgb.b})`,
        rgba: (opacity) => `rgba(${rgb.r}, ${rgb.g}, ${rgb.b}, ${opacity})`
    };
}

const secondaryColor = getSecondaryColor();

// Score Progress Chart
const scoreProgressCtx = document.getElementById('scoreProgressChart').getContext('2d');
new Chart(scoreProgressCtx, {
    type: 'line',
            data: {
                labels: {!! json_encode($scoreProgress->pluck('date')) !!},
                datasets: [{
                    label: 'Rata-rata Score',
                    data: {!! json_encode($scoreProgress->pluck('avg_score')) !!},
                    borderColor: secondaryColor.rgb,
                    backgroundColor: secondaryColor.rgba(0.1),
                    tension: 0.4,
                    fill: true,
                    borderWidth: 2
                }]
            },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: false
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                max: 100
            }
        },
        layout: {
            padding: {
                top: 10,
                bottom: 10
            }
        }
    }
});

// Category Performance Chart
const categoryCtx = document.getElementById('categoryPerformanceChart').getContext('2d');
new Chart(categoryCtx, {
    type: 'bar',
            data: {
                labels: {!! json_encode($categoryPerformance->pluck('name')) !!},
                datasets: [{
                    label: 'Rata-rata Score',
                    data: {!! json_encode($categoryPerformance->pluck('avg_score')) !!},
                    backgroundColor: secondaryColor.rgba(0.8)
                }]
            },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: false
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                max: 100
            }
        },
        layout: {
            padding: {
                top: 10,
                bottom: 10
            }
        }
    }
});

// Weekly Activity Chart
const weeklyCtx = document.getElementById('weeklyActivityChart').getContext('2d');
new Chart(weeklyCtx, {
    type: 'bar',
            data: {
                labels: {!! json_encode($weeklyActivity->pluck('week')) !!},
                datasets: [{
                    label: 'Ujian Selesai',
                    data: {!! json_encode($weeklyActivity->pluck('count')) !!},
                    backgroundColor: secondaryColor.rgba(0.8)
                }]
            },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: false
            }
        },
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

// Accuracy Trend Chart
const accuracyCtx = document.getElementById('accuracyTrendChart').getContext('2d');
new Chart(accuracyCtx, {
    type: 'line',
            data: {
                labels: {!! json_encode($accuracyTrend->pluck('date')) !!},
                datasets: [{
                    label: 'Akurasi (%)',
                    data: {!! json_encode($accuracyTrend->pluck('accuracy')) !!},
                    borderColor: secondaryColor.rgb,
                    backgroundColor: secondaryColor.rgba(0.1),
                    tension: 0.4,
                    fill: true,
                    borderWidth: 2
                }]
            },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: false
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                max: 100
            }
        },
        layout: {
            padding: {
                top: 10,
                bottom: 10
            }
        }
    }
});
</script>
@endsection
