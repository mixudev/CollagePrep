@extends('layouts.app')

@section('title', 'Achievements')

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="px-4 py-6 sm:px-0">
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900">Achievements</h1>
                <p class="mt-2 text-sm text-gray-600">Pencapaian dan badge yang telah Anda raih</p>
            </div>

            <!-- Stats -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-gradient-to-r from-yellow-400 to-orange-500 rounded-lg p-6 text-white">
                    <div class="text-3xl font-bold">{{ $achievements->count() }}</div>
                    <div class="text-sm opacity-90">Total Achievements</div>
                </div>
                <div class="bg-gradient-to-r from-purple-400 to-pink-500 rounded-lg p-6 text-white">
                    <div class="text-3xl font-bold">{{ $allAchievements->count() - $achievements->count() }}</div>
                    <div class="text-sm opacity-90">Belum Diraih</div>
                </div>
                <div class="bg-gradient-to-r from-blue-400 to-cyan-500 rounded-lg p-6 text-white">
                    <div class="text-3xl font-bold">{{ $allAchievements->count() > 0 ? round(($achievements->count() / $allAchievements->count()) * 100) : 0 }}%</div>
                    <div class="text-sm opacity-90">Progress</div>
                </div>
            </div>

            <!-- Achievements Grid -->
            <div class="bg-white shadow rounded-lg p-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-6">Daftar Achievements</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($allAchievements as $achievement)
                        @php
                            $earned = $achievements->contains($achievement->id);
                            $earnedAt = $earned ? $achievements->firstWhere('id', $achievement->id)->pivot->earned_at : null;
                        @endphp
                        <div class="border-2 rounded-lg p-6 transition-all {{ $earned ? 'border-yellow-400 bg-yellow-50 shadow-lg' : 'border-gray-200 bg-gray-50 opacity-60' }}">
                            <div class="flex items-start justify-between mb-4">
                                <div class="flex-1">
                                    <h3 class="text-lg font-semibold text-gray-900 mb-1">{{ $achievement->name ?? ucfirst($achievement->type) }}</h3>
                                    <p class="text-sm text-gray-600 mb-2">{{ $achievement->description }}</p>
                                    <div class="flex items-center space-x-2">
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-indigo-100 text-indigo-800">
                                            {{ ucfirst($achievement->type) }}
                                        </span>
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                            {{ $achievement->points }} poin
                                        </span>
                                    </div>
                                </div>
                                @if($earned)
                                    <div class="ml-4">
                                        <svg class="h-8 w-8 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                        </svg>
                                    </div>
                                @endif
                            </div>
                            @if($earned && $earnedAt)
                                <div class="mt-4 pt-4 border-t border-gray-200">
                                    <p class="text-xs text-gray-500">Diraih pada: {{ \Carbon\Carbon::parse($earnedAt)->format('d M Y') }}</p>
                                </div>
                            @else
                                <div class="mt-4 pt-4 border-t border-gray-200">
                                    <p class="text-xs text-gray-500">Syarat: {{ $achievement->requirement_value ?? 'N/A' }}</p>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

