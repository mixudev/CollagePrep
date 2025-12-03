@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="px-4 py-6 sm:px-0">
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900">Dashboard Admin</h1>
                <p class="mt-2 text-sm text-gray-600">Selamat datang, {{ auth()->user()->name }}</p>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4 mb-8">
                <div class="bg-white overflow-hidden shadow-sm rounded-lg border border-gray-200">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-gray-100 rounded-lg p-3">
                                <svg class="h-6 w-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                </svg>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Total Siswa</dt>
                                    <dd class="text-2xl font-semibold text-gray-900">{{ $stats['total_students'] }}</dd>
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
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Total Modul</dt>
                                    <dd class="text-2xl font-semibold text-gray-900">{{ $stats['total_modules'] }}</dd>
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
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Ujian Selesai</dt>
                                    <dd class="text-2xl font-semibold text-gray-900">{{ $stats['total_completed'] }}</dd>
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
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Rata-rata Score</dt>
                                    <dd class="text-2xl font-semibold text-gray-900">{{ number_format($stats['average_score'], 1) }}</dd>
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
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <div class="text-sm font-medium text-gray-500">Total Soal</div>
                        </div>
                        <div class="text-2xl font-semibold text-gray-900">{{ $stats['total_questions'] }}</div>
                    </div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm rounded-lg border border-gray-200">
                    <div class="p-5">
                        <div class="flex items-center mb-2">
                            <svg class="h-5 w-5 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <div class="text-sm font-medium text-gray-500">Ujian Aktif</div>
                        </div>
                        <div class="text-2xl font-semibold text-gray-900">{{ $stats['active_exams'] }}</div>
                    </div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm rounded-lg border border-gray-200">
                    <div class="p-5">
                        <div class="flex items-center mb-2">
                            <svg class="h-5 w-5 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path>
                            </svg>
                            <div class="text-sm font-medium text-gray-500">Siswa Nonaktif</div>
                        </div>
                        <div class="text-2xl font-semibold text-gray-900">{{ $stats['inactive_students'] }}</div>
                    </div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm rounded-lg border border-gray-200">
                    <div class="p-5">
                        <div class="flex items-center mb-2">
                            <svg class="h-5 w-5 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                            </svg>
                            <div class="text-sm font-medium text-gray-500">Total Kategori</div>
                        </div>
                        <div class="text-2xl font-semibold text-gray-900">{{ $stats['total_categories'] }}</div>
                    </div>
                </div>
            </div>

            <!-- Charts Row -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                <!-- Completion by Month Chart -->
                <div class="bg-white shadow-sm rounded-lg border border-gray-200 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Penyelesaian Ujian per Bulan</h3>
                    <div class="relative" style="height: 300px;">
                        <canvas id="completionChart"></canvas>
                    </div>
                </div>

                <!-- Score Distribution Chart -->
                <div class="bg-white shadow-sm rounded-lg border border-gray-200 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Distribusi Score</h3>
                    <div class="relative" style="height: 300px;">
                        <canvas id="scoreDistributionChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Performance Charts -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                <!-- Performance by Category -->
                <div class="bg-white shadow-sm rounded-lg border border-gray-200 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Performa per Kategori</h3>
                    <div class="relative" style="height: 300px;">
                        <canvas id="categoryPerformanceChart"></canvas>
                    </div>
                </div>

                <!-- Daily Activity -->
                <div class="bg-white shadow-sm rounded-lg border border-gray-200 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Aktivitas Harian (7 Hari Terakhir)</h3>
                    <div class="relative" style="height: 300px;">
                        <canvas id="dailyActivityChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Tables Row -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                <!-- Top Performers -->
                <div class="bg-white shadow-sm rounded-lg border border-gray-200">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900">Top 10 Performer</h3>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rank</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Score</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($topPerformers as $ranking)
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 py-1 text-xs font-semibold rounded {{ $ranking->rank <= 3 ? 'bg-gray-900 text-white' : 'bg-gray-100 text-gray-700' }}">
                                                #{{ $ranking->rank }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            {{ $ranking->user->name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                            {{ number_format($ranking->average_score ?? $ranking->score, 2) }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Module Statistics -->
                <div class="bg-white shadow-sm rounded-lg border border-gray-200">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900">Statistik Modul</h3>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Modul</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Selesai</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Avg Score</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($moduleStats as $module)
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            {{ Str::limit($module->title, 30) }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                            {{ $module->completed_count }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                            {{ number_format($module->avg_score ?? 0, 2) }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="bg-white shadow-sm rounded-lg border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Aktivitas Terbaru</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Siswa</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Modul</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Score</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Waktu</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($recentActivity as $activity)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ $activity->user->name ?? 'User Tidak Ditemukan' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                        {{ $activity->module ? $activity->module->title : 'Modul Tidak Tersedia' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                        <span class="px-2 py-1 text-xs font-semibold rounded {{ $activity->score >= 70 ? 'bg-gray-100 text-gray-700 border border-gray-300' : 'bg-gray-50 text-gray-600 border border-gray-200' }}">
                                            {{ number_format($activity->score, 2) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $activity->finished_at ? $activity->finished_at->diffForHumans() : 'N/A' }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
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

// Completion by Month Chart
const completionCtx = document.getElementById('completionChart').getContext('2d');
const completionGradient = completionCtx.createLinearGradient(0, 0, 0, 300);
completionGradient.addColorStop(0, secondaryColor.rgba(0.4));
completionGradient.addColorStop(0.5, secondaryColor.rgba(0.15));
completionGradient.addColorStop(1, secondaryColor.rgba(0.02));

new Chart(completionCtx, {
    type: 'line',
            data: {
                labels: {!! json_encode($completionByMonth->pluck('month')) !!},
                datasets: [{
                    label: 'Ujian Selesai',
                    data: {!! json_encode($completionByMonth->pluck('count')) !!},
                    borderColor: secondaryColor.rgb,
                    backgroundColor: completionGradient,
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
                beginAtZero: true
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

// Score Distribution Chart
const scoreDistCtx = document.getElementById('scoreDistributionChart').getContext('2d');
const scoreDistGradients = [];
const scoreData = {!! json_encode($scoreDistribution->pluck('count')) !!};
for (let i = 0; i < scoreData.length; i++) {
    const gradient = scoreDistCtx.createLinearGradient(0, 0, 0, 300);
    const baseOpacity = 0.95 - (i * 0.12);
    gradient.addColorStop(0, secondaryColor.rgba(Math.max(baseOpacity, 0.6)));
    gradient.addColorStop(0.6, secondaryColor.rgba(Math.max(baseOpacity * 0.8, 0.4)));
    gradient.addColorStop(1, secondaryColor.rgba(Math.max(baseOpacity * 0.5, 0.2)));
    scoreDistGradients.push(gradient);
}

new Chart(scoreDistCtx, {
    type: 'bar',
            data: {
                labels: {!! json_encode($scoreDistribution->pluck('score_range')) !!},
                datasets: [{
                    label: 'Jumlah',
                    data: {!! json_encode($scoreDistribution->pluck('count')) !!},
                    backgroundColor: scoreDistGradients
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
const categoryGradients = [];
const categoryCount = {!! $performanceByCategory->count() !!};
const hues = [0, 30, 60, 90, 120, 150, 180, 210, 240, 270];
for (let i = 0; i < Math.max(categoryCount, 5); i++) {
    const gradient = categoryCtx.createRadialGradient(0, 0, 0, 0, 0, 100);
    const baseOpacity = 0.9 - (i * 0.12);
    gradient.addColorStop(0, secondaryColor.rgba(Math.min(baseOpacity, 0.9)));
    gradient.addColorStop(0.7, secondaryColor.rgba(Math.max(baseOpacity * 0.75, 0.4)));
    gradient.addColorStop(1, secondaryColor.rgba(Math.max(baseOpacity * 0.5, 0.25)));
    categoryGradients.push(gradient);
}

new Chart(categoryCtx, {
    type: 'doughnut',
            data: {
                labels: {!! json_encode($performanceByCategory->pluck('name')) !!},
                datasets: [{
                    data: {!! json_encode($performanceByCategory->pluck('avg_score')) !!},
                    backgroundColor: categoryGradients.slice(0, categoryCount)
                }]
            },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                position: 'bottom'
            }
        }
    }
});

// Daily Activity Chart
const dailyCtx = document.getElementById('dailyActivityChart').getContext('2d');
const dailyGradient = dailyCtx.createLinearGradient(0, 0, 0, 300);
dailyGradient.addColorStop(0, secondaryColor.rgba(0.9));
dailyGradient.addColorStop(0.5, secondaryColor.rgba(0.7));
dailyGradient.addColorStop(1, secondaryColor.rgba(0.45));

new Chart(dailyCtx, {
    type: 'bar',
            data: {
                labels: {!! json_encode($dailyActivity->pluck('date')) !!},
                datasets: [{
                    label: 'Ujian Selesai',
                    data: {!! json_encode($dailyActivity->pluck('count')) !!},
                    backgroundColor: dailyGradient,
                    borderRadius: 4
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
