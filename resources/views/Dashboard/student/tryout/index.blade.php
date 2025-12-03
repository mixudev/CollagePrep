@extends('layouts.app')

@section('title', 'Tryout UTBK')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Tryout UTBK</h1>
            <p class="text-gray-600">Pilih modul tryout yang ingin Anda kerjakan</p>
        </div>

        <!-- Modules Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($modules as $module)
                <div class="bg-white border border-gray-200 rounded-xl shadow-sm hover:shadow-md transition-shadow overflow-hidden flex flex-col">
                    <!-- Module Header -->
                    <div class="bg-gray-50 border-b border-gray-200 px-5 py-4">
                        <div class="flex items-center justify-between mb-2">
                            <span class="px-2.5 py-1 bg-gray-900 text-white text-xs font-semibold rounded-md">
                                {{ $module->code }}
                            </span>
                            <span class="px-2.5 py-1 bg-gray-100 text-gray-700 text-xs font-medium rounded-md">
                                {{ $module->category->name }}
                            </span>
                        </div>
                        <h3 class="text-base font-semibold text-gray-900 line-clamp-2">{{ $module->title }}</h3>
                    </div>

                    <!-- Module Content -->
                    <div class="p-5 flex-1 flex flex-col">
                        @if($module->description)
                            <p class="text-sm text-gray-600 mb-4 line-clamp-2 flex-shrink-0">{{ $module->description }}</p>
                        @endif

                        <!-- Module Info -->
                        <div class="space-y-2.5 mb-4 flex-grow">
                            <div class="flex items-center text-sm text-gray-600">
                                <svg class="h-4 w-4 mr-2 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span class="text-gray-500">Durasi:</span>
                                <span class="ml-1.5 font-medium text-gray-900">{{ $module->duration }} menit</span>
                            </div>
                            <div class="flex items-center text-sm text-gray-600">
                                <svg class="h-4 w-4 mr-2 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span class="text-gray-500">Jumlah Soal:</span>
                                <span class="ml-1.5 font-medium text-gray-900">{{ $module->total_questions }} soal</span>
                            </div>
                            <div class="flex items-center text-sm text-gray-600">
                                <svg class="h-4 w-4 mr-2 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span class="text-gray-500">Passing Grade:</span>
                                <span class="ml-1.5 font-medium text-gray-900">{{ $module->passing_grade }}</span>
                            </div>
                            <div class="flex items-center text-sm text-gray-600">
                                <svg class="h-4 w-4 mr-2 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                </svg>
                                <span class="text-gray-500">Max Percobaan:</span>
                                <span class="ml-1.5 font-medium text-gray-900">{{ $module->max_attempts }}x</span>
                            </div>
                        </div>

                        <!-- Progress Info -->
                        @if($module->attempts_count > 0)
                            <div class="mb-4 p-3 bg-gray-50 rounded-lg border border-gray-200 flex-shrink-0">
                                <div class="flex items-center justify-between text-xs text-gray-600 mb-1">
                                    <span>Progress</span>
                                    <span>{{ $module->completed_count }}/{{ $module->max_attempts }} selesai</span>
                                </div>
                                @if($module->best_score)
                                    <div class="text-sm font-semibold text-gray-900">
                                        Score Terbaik: <span class="text-gray-700">{{ number_format($module->best_score, 1) }}</span>
                                    </div>
                                @endif
                            </div>
                        @endif

                        <!-- Action Button -->
                        <div class="mt-auto">
                            @if($module->in_progress)
                                <a href="{{ route('exam.show', $module) }}" 
                                    class="block w-full text-center px-4 py-2.5 bg-gray-900 text-white rounded-lg hover:bg-gray-800 transition-colors font-medium text-sm">
                                    <span class="flex items-center justify-center">
                                        <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Lanjutkan Ujian
                                    </span>
                                </a>
                            @elseif($module->can_attempt)
                                <a href="{{ route('exam.show', $module) }}" 
                                    class="block w-full text-center px-4 py-2.5 bg-gray-900 text-white rounded-lg hover:bg-gray-800 transition-colors font-medium text-sm">
                                    <span class="flex items-center justify-center">
                                        <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Mulai Tryout
                                    </span>
                                </a>
                            @else
                                <button disabled 
                                    class="block w-full text-center px-4 py-2.5 bg-gray-100 text-gray-400 rounded-lg cursor-not-allowed font-medium text-sm">
                                    <span class="flex items-center justify-center">
                                        <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path>
                                        </svg>
                                        Maksimal Percobaan Tercapai
                                    </span>
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full">
                    <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-12 text-center">
                        <svg class="mx-auto h-16 w-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Tidak Ada Modul Tersedia</h3>
                        <p class="text-gray-600">Belum ada modul tryout yang tersedia saat ini.</p>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
