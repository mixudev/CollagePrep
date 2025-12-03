@extends('layouts.app')

@section('title', 'Ranking Global')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Ranking Global</h1>
            <p class="mt-2 text-sm text-gray-600">Peringkat siswa berdasarkan performa keseluruhan</p>
        </div>

        <!-- Top 3 Podium -->
        @if($top3->count() > 0)
            <div class="mb-12">
                <div class="flex items-end justify-center gap-4 max-w-4xl mx-auto">
                    <!-- 2nd Place -->
                    @if($top3->count() >= 2)
                        <div class="flex-1 max-w-[200px]">
                            <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6 text-center">
                                <div class="mb-4">
                                    <div class="mx-auto w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mb-3">
                                        @if($top3[1]->user->avatar)
                                            <img src="{{ $top3[1]->user->avatar_url }}" alt="{{ $top3[1]->user->name }}" class="w-20 h-20 rounded-full object-cover">
                                        @else
                                            <span class="text-2xl font-bold text-gray-400">{{ strtoupper(substr($top3[1]->user->name, 0, 1)) }}</span>
                                        @endif
                                    </div>
                                    <div class="w-16 h-16 bg-gray-200 rounded-lg mx-auto flex items-center justify-center mb-2">
                                        <span class="text-3xl font-bold text-gray-600">2</span>
                                    </div>
                                </div>
                                <h3 class="font-semibold text-gray-900 mb-1">{{ $top3[1]->user->name }}</h3>
                                <p class="text-sm text-gray-600 mb-2">{{ $top3[1]->user->email }}</p>
                                <div class="bg-gray-50 rounded-lg p-3">
                                    <div class="text-xs text-gray-500 mb-1">Score</div>
                                    <div class="text-2xl font-bold text-gray-900">{{ number_format($top3[1]->average_score ?? $top3[1]->score, 1) }}</div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- 1st Place -->
                    @if($top3->count() >= 1)
                        <div class="flex-1 max-w-[240px]">
                            <div class="bg-white border-2 border-gray-300 rounded-xl shadow-lg p-6 text-center relative">
                                <div class="absolute -top-4 left-1/2 transform -translate-x-1/2">
                                    <div class="bg-gray-900 text-white px-4 py-1 rounded-full text-xs font-bold">
                                        JUARA 1
                                    </div>
                                </div>
                                <div class="mb-4 mt-2">
                                    <div class="mx-auto w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mb-3">
                                        @if($top3[0]->user->avatar)
                                            <img src="{{ $top3[0]->user->avatar_url }}" alt="{{ $top3[0]->user->name }}" class="w-24 h-24 rounded-full object-cover">
                                        @else
                                            <span class="text-3xl font-bold text-gray-400">{{ strtoupper(substr($top3[0]->user->name, 0, 1)) }}</span>
                                        @endif
                                    </div>
                                    <div class="w-20 h-20 bg-gray-900 rounded-lg mx-auto flex items-center justify-center mb-2">
                                        <span class="text-4xl font-bold text-white">1</span>
                                    </div>
                                </div>
                                <h3 class="font-bold text-lg text-gray-900 mb-1">{{ $top3[0]->user->name }}</h3>
                                <p class="text-sm text-gray-600 mb-2">{{ $top3[0]->user->email }}</p>
                                <div class="bg-gray-900 rounded-lg p-3">
                                    <div class="text-xs text-gray-300 mb-1">Score</div>
                                    <div class="text-3xl font-bold text-white">{{ number_format($top3[0]->average_score ?? $top3[0]->score, 1) }}</div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- 3rd Place -->
                    @if($top3->count() >= 3)
                        <div class="flex-1 max-w-[200px]">
                            <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6 text-center">
                                <div class="mb-4">
                                    <div class="mx-auto w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mb-3">
                                        @if($top3[2]->user->avatar)
                                            <img src="{{ $top3[2]->user->avatar_url }}" alt="{{ $top3[2]->user->name }}" class="w-20 h-20 rounded-full object-cover">
                                        @else
                                            <span class="text-2xl font-bold text-gray-400">{{ strtoupper(substr($top3[2]->user->name, 0, 1)) }}</span>
                                        @endif
                                    </div>
                                    <div class="w-16 h-16 bg-gray-200 rounded-lg mx-auto flex items-center justify-center mb-2">
                                        <span class="text-3xl font-bold text-gray-600">3</span>
                                    </div>
                                </div>
                                <h3 class="font-semibold text-gray-900 mb-1">{{ $top3[2]->user->name }}</h3>
                                <p class="text-sm text-gray-600 mb-2">{{ $top3[2]->user->email }}</p>
                                <div class="bg-gray-50 rounded-lg p-3">
                                    <div class="text-xs text-gray-500 mb-1">Score</div>
                                    <div class="text-2xl font-bold text-gray-900">{{ number_format($top3[2]->average_score ?? $top3[2]->score, 1) }}</div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        @endif

        <!-- User Rank Card -->
        @if($userRank)
            <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6 mb-8">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-base font-semibold text-gray-900 mb-1">Peringkat Anda</h3>
                        <p class="text-sm text-gray-600">Lihat posisi Anda di ranking global</p>
                    </div>
                    <div class="text-right">
                        <div class="text-4xl font-bold text-gray-900 mb-1">#{{ $userRank->rank }}</div>
                        <div class="text-sm text-gray-600">Score: {{ number_format($userRank->average_score ?? $userRank->score, 2) }}</div>
                        <div class="text-xs text-gray-500 mt-1">{{ $userRank->total_modules_completed ?? 0 }} modul selesai</div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Rankings Table -->
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
            <div class="bg-gray-50 border-b border-gray-200 px-6 py-4">
                <h3 class="text-base font-semibold text-gray-900">Daftar Ranking</h3>
                <p class="text-xs text-gray-600 mt-1">{{ $rankings->total() }} siswa terdaftar</p>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Rank</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Nama</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Score</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Modul Selesai</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($rankings as $ranking)
                            <tr class="{{ auth()->id() === $ranking->user_id ? 'bg-gray-50' : 'hover:bg-gray-50' }} transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        @if($ranking->rank <= 3)
                                            <span class="text-xl mr-2">
                                                @if($ranking->rank == 1) 🥇
                                                @elseif($ranking->rank == 2) 🥈
                                                @elseif($ranking->rank == 3) 🥉
                                                @endif
                                            </span>
                                        @endif
                                        <span class="text-base font-semibold text-gray-900">#{{ $ranking->rank }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            @if($ranking->user->avatar)
                                                <img class="h-10 w-10 rounded-full object-cover" src="{{ $ranking->user->avatar_url }}" alt="{{ $ranking->user->name }}">
                                            @else
                                                <div class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center">
                                                    <span class="text-sm font-semibold text-gray-600">{{ strtoupper(substr($ranking->user->name, 0, 1)) }}</span>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">{{ $ranking->user->name }}</div>
                                            <div class="text-sm text-gray-500">{{ $ranking->user->email }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-sm font-semibold text-gray-900">
                                        {{ number_format($ranking->average_score ?? $ranking->score, 2) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                    {{ $ranking->total_modules_completed ?? 0 }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-12 text-center">
                                    <svg class="mx-auto h-16 w-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                    </svg>
                                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Belum ada data ranking</h3>
                                    <p class="text-sm text-gray-600">Ranking akan muncul setelah siswa menyelesaikan tryout</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($rankings->hasPages())
                <div class="bg-gray-50 border-t border-gray-200 px-6 py-4">
                    {{ $rankings->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
