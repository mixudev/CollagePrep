@extends('layouts.app')

@section('title', 'Detail Modul - ' . $module->title)

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <div class="flex items-center space-x-3 mb-2">
                        <a href="{{ route('admin.modules.index') }}" class="text-gray-500 hover:text-gray-700 transition-colors">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                        </a>
                        <h1 class="text-3xl font-bold text-gray-900">{{ $module->title }}</h1>
                    </div>
                    <div class="flex items-center space-x-4 text-sm text-gray-600 ml-9">
                        <span class="flex items-center">
                            <svg class="h-4 w-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                            </svg>
                            {{ $module->category->name }}
                        </span>
                        <span class="flex items-center">
                            <svg class="h-4 w-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"></path>
                            </svg>
                            {{ $module->code }}
                        </span>
                    </div>
                </div>
                <div class="flex space-x-3">
                    <a href="{{ route('admin.modules.edit', $module) }}" 
                        class="flex items-center px-4 py-2 bg-white border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors font-medium shadow-sm">
                        <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        Edit Modul
                    </a>
                    <a href="{{ route('admin.modules.index') }}" 
                        class="flex items-center px-4 py-2 bg-gray-900 text-white rounded-lg hover:bg-gray-800 transition-colors font-medium shadow-sm">
                        <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Kembali
                    </a>
                </div>
            </div>
        </div>

        @if(session('success'))
            <div class="mb-6 bg-gray-50 border border-gray-200 text-gray-800 px-4 py-3 rounded-lg flex items-center">
                <svg class="h-5 w-5 mr-2 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                {{ session('success') }}
            </div>
        @endif

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-medium mb-1">Total Soal</p>
                        <p class="text-3xl font-bold text-gray-900">{{ $module->questions->count() }}</p>
                    </div>
                    <div class="bg-gray-100 rounded-lg p-3">
                        <svg class="h-8 w-8 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-medium mb-1">Siswa Selesai</p>
                        <p class="text-3xl font-bold text-gray-900">{{ $module->studentModules->where('status', 'completed')->count() }}</p>
                    </div>
                    <div class="bg-gray-100 rounded-lg p-3">
                        <svg class="h-8 w-8 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-medium mb-1">Rata-rata Score</p>
                        <p class="text-3xl font-bold text-gray-900">
                            {{ $module->studentModules->where('status', 'completed')->avg('score') ? number_format($module->studentModules->where('status', 'completed')->avg('score'), 1) : 'N/A' }}
                        </p>
                    </div>
                    <div class="bg-gray-100 rounded-lg p-3">
                        <svg class="h-8 w-8 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-medium mb-1">Durasi</p>
                        <p class="text-3xl font-bold text-gray-900">{{ $module->duration }}</p>
                        <p class="text-gray-500 text-xs mt-1">menit</p>
                    </div>
                    <div class="bg-gray-100 rounded-lg p-3">
                        <svg class="h-8 w-8 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Module Information -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
            <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6">
                <h3 class="text-base font-semibold text-gray-900 mb-4 flex items-center">
                    <svg class="h-5 w-5 mr-2 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Informasi Modul
                </h3>
                <dl class="space-y-4">
                    <div class="flex justify-between items-center py-2 border-b border-gray-100">
                        <dt class="text-sm text-gray-600">Passing Grade</dt>
                        <dd class="text-base font-semibold text-gray-900">{{ $module->passing_grade }}</dd>
                    </div>
                    <div class="flex justify-between items-center py-2 border-b border-gray-100">
                        <dt class="text-sm text-gray-600">Max Percobaan</dt>
                        <dd class="text-base font-semibold text-gray-900">{{ $module->max_attempts }}</dd>
                    </div>
                    <div class="flex justify-between items-center py-2 border-b border-gray-100">
                        <dt class="text-sm text-gray-600">Target Soal</dt>
                        <dd class="text-base font-semibold text-gray-900">{{ $module->total_questions }}</dd>
                    </div>
                    @if($module->start_date || $module->end_date)
                        <div class="pt-2">
                            <dt class="text-sm text-gray-600 mb-2">Periode</dt>
                            <dd class="text-sm text-gray-900 space-y-1">
                                @if($module->start_date)
                                    <div class="flex items-center">
                                        <svg class="h-4 w-4 mr-1.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        Mulai: {{ \Carbon\Carbon::parse($module->start_date)->format('d M Y') }}
                                    </div>
                                @endif
                                @if($module->end_date)
                                    <div class="flex items-center">
                                        <svg class="h-4 w-4 mr-1.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        Selesai: {{ \Carbon\Carbon::parse($module->end_date)->format('d M Y') }}
                                    </div>
                                @endif
                            </dd>
                        </div>
                    @endif
                </dl>
            </div>

            <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6">
                <h3 class="text-base font-semibold text-gray-900 mb-4 flex items-center">
                    <svg class="h-5 w-5 mr-2 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Status
                </h3>
                <dl class="space-y-4">
                    <div class="flex justify-between items-center py-2">
                        <dt class="text-sm text-gray-600">Published</dt>
                        <dd>
                            <span class="px-3 py-1 text-xs font-medium rounded-md {{ $module->is_published ? 'bg-gray-900 text-white' : 'bg-gray-100 text-gray-700' }}">
                                {{ $module->is_published ? 'Ya' : 'Tidak' }}
                            </span>
                        </dd>
                    </div>
                    <div class="flex justify-between items-center py-2">
                        <dt class="text-sm text-gray-600">Tampilkan Ranking</dt>
                        <dd>
                            <span class="px-3 py-1 text-xs font-medium rounded-md {{ $module->show_ranking ? 'bg-gray-900 text-white' : 'bg-gray-100 text-gray-700' }}">
                                {{ $module->show_ranking ? 'Ya' : 'Tidak' }}
                            </span>
                        </dd>
                    </div>
                    <div class="flex justify-between items-center py-2">
                        <dt class="text-sm text-gray-600">Tampilkan Jawaban</dt>
                        <dd>
                            <span class="px-3 py-1 text-xs font-medium rounded-md {{ $module->show_answer_after_submit ? 'bg-gray-900 text-white' : 'bg-gray-100 text-gray-700' }}">
                                {{ $module->show_answer_after_submit ? 'Ya' : 'Tidak' }}
                            </span>
                        </dd>
                    </div>
                </dl>
            </div>

            <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6">
                <h3 class="text-base font-semibold text-gray-900 mb-4 flex items-center">
                    <svg class="h-5 w-5 mr-2 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                    Deskripsi
                </h3>
                <p class="text-sm text-gray-600 leading-relaxed">
                    {{ $module->description ?: 'Tidak ada deskripsi' }}
                </p>
            </div>
        </div>

        <!-- Questions Section -->
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
            <div class="bg-gray-50 border-b border-gray-200 px-6 py-4">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-base font-semibold text-gray-900">Daftar Soal</h3>
                        <p class="text-xs text-gray-600 mt-1">{{ $module->questions->count() }} soal tersedia</p>
                    </div>
                    <a href="{{ route('admin.questions.create', ['module_id' => $module->id]) }}" 
                        class="flex items-center px-4 py-2 bg-gray-900 text-white rounded-lg hover:bg-gray-800 transition-colors font-medium shadow-sm">
                        <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Tambah Soal
                    </a>
                </div>
            </div>
            
            <div class="p-6">
                @forelse($module->questions->sortBy('order') as $index => $question)
                    <div class="border border-gray-200 rounded-lg p-5 mb-4 hover:border-gray-300 hover:shadow-sm transition-all bg-white last:mb-0">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <div class="flex items-center space-x-2 mb-3">
                                    <span class="px-2.5 py-1 bg-gray-900 text-white rounded-md text-xs font-bold">
                                        Soal #{{ $index + 1 }}
                                    </span>
                                    <span class="px-2.5 py-1 bg-gray-100 text-gray-700 rounded-md text-xs font-medium">
                                        {{ ucfirst($question->difficulty) }}
                                    </span>
                                    <span class="px-2.5 py-1 bg-gray-100 text-gray-700 rounded-md text-xs font-medium">
                                        {{ $question->points }} poin
                                    </span>
                                    <span class="px-2.5 py-1 bg-gray-100 text-gray-700 rounded-md text-xs font-medium">
                                        {{ ucfirst(str_replace('_', ' ', $question->type)) }}
                                    </span>
                                    @if($question->is_active)
                                        <span class="px-2.5 py-1 bg-gray-900 text-white rounded-md text-xs font-medium">
                                            Aktif
                                        </span>
                                    @else
                                        <span class="px-2.5 py-1 bg-gray-200 text-gray-600 rounded-md text-xs font-medium">
                                            Nonaktif
                                        </span>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <p class="text-gray-900 font-medium leading-relaxed">
                                        {{ Str::limit(strip_tags($question->question_text), 200) }}
                                    </p>
                                </div>
                                @if($question->type === 'multiple_choice' && $question->options->count() > 0)
                                    <div class="mt-3 pt-3 border-t border-gray-100">
                                        <p class="text-xs text-gray-500 mb-2 font-medium">Pilihan Jawaban:</p>
                                        <div class="grid grid-cols-2 gap-2">
                                            @foreach($question->options->sortBy('option_label') as $option)
                                                <div class="flex items-center space-x-2 text-sm">
                                                    <span class="font-semibold text-gray-700">{{ $option->option_label }}.</span>
                                                    <span class="text-gray-600">{{ Str::limit($option->option_text, 40) }}</span>
                                                    @if($option->is_correct)
                                                        <span class="px-2 py-0.5 bg-gray-900 text-white rounded text-xs font-medium">✓ Benar</span>
                                                    @endif
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="ml-6 flex flex-col space-y-2">
                                <a href="{{ route('admin.questions.edit', $question) }}" 
                                    class="flex items-center px-4 py-2 bg-white border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors text-sm font-medium">
                                    <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                    Edit
                                </a>
                                <form action="{{ route('admin.questions.destroy', $question) }}" method="POST" 
                                    class="delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                        class="w-full flex items-center px-4 py-2 bg-white border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors text-sm font-medium"
                                        data-confirm-delete="Apakah Anda yakin ingin menghapus soal ini?">
                                        <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-12">
                        <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <h3 class="mt-4 text-lg font-semibold text-gray-900">Belum ada soal</h3>
                        <p class="mt-2 text-sm text-gray-600">Mulai dengan menambahkan soal pertama untuk modul ini.</p>
                        <div class="mt-6">
                            <a href="{{ route('admin.questions.create', ['module_id' => $module->id]) }}" 
                                class="inline-flex items-center px-4 py-2 bg-gray-900 text-white rounded-lg hover:bg-gray-800 transition-colors font-medium">
                                <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                                Tambah Soal Pertama
                            </a>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
