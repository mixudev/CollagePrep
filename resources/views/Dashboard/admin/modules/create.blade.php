@extends('layouts.app')

@section('title', 'Tambah Modul')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Tambah Modul Baru</h1>
                    <p class="mt-2 text-sm text-gray-600">Buat modul tryout baru untuk sistem</p>
                </div>
                <a href="{{ route('admin.modules.index') }}" class="flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                    <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Kembali
                </a>
            </div>
        </div>

        <!-- Form Card -->
        <div class="bg-white shadow-sm border border-gray-200 rounded-xl overflow-hidden">
            <form action="{{ route('admin.modules.store') }}" method="POST" data-confirm-submit="Apakah Anda yakin ingin menyimpan modul baru?" id="module-form">
                @csrf
                
                <!-- Basic Information -->
                <div class="border-b border-gray-200 bg-gray-50 px-6 py-4">
                    <h2 class="text-base font-semibold text-gray-900">Informasi Dasar</h2>
                    <p class="text-xs text-gray-600 mt-1">Informasi utama modul</p>
                </div>
                
                <div class="p-6 space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Kategori <span class="text-red-500">*</span>
                            </label>
                            <select name="category_id" required 
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-900 focus:border-gray-900 transition-colors bg-white @error('category_id') border-red-500 @enderror">
                                <option value="">-- Pilih Kategori --</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Kode Modul <span class="text-red-500">*</span>
                                <span class="text-xs font-normal text-gray-500">(Otomatis)</span>
                            </label>
                            <input type="text" id="module-code" readonly
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg bg-gray-50 text-gray-600 cursor-not-allowed"
                                placeholder="Akan di-generate otomatis setelah memilih kategori">
                            <p class="mt-1 text-xs text-gray-500">Kode modul akan di-generate otomatis berdasarkan kategori yang dipilih</p>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Judul Modul <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="title" value="{{ old('title') }}" required
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-900 focus:border-gray-900 transition-colors @error('title') border-red-500 @enderror"
                            placeholder="Masukkan judul modul">
                        @error('title')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Deskripsi <span class="text-gray-500 text-xs font-normal">(Opsional)</span>
                        </label>
                        <textarea name="description" rows="3"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-900 focus:border-gray-900 transition-colors resize-none @error('description') border-red-500 @enderror"
                            placeholder="Masukkan deskripsi modul...">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Module Settings -->
                <div class="border-t border-gray-200 bg-gray-50 px-6 py-4">
                    <h2 class="text-base font-semibold text-gray-900">Pengaturan Modul</h2>
                    <p class="text-xs text-gray-600 mt-1">Konfigurasi durasi, passing grade, dan percobaan</p>
                </div>
                
                <div class="p-6 space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Durasi (menit) <span class="text-red-500">*</span>
                            </label>
                            <input type="number" name="duration" value="{{ old('duration') }}" required min="1"
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-900 focus:border-gray-900 transition-colors @error('duration') border-red-500 @enderror"
                                placeholder="120">
                            @error('duration')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Passing Grade <span class="text-red-500">*</span>
                            </label>
                            <input type="number" name="passing_grade" value="{{ old('passing_grade', 60) }}" required min="0" max="100" step="0.01"
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-900 focus:border-gray-900 transition-colors @error('passing_grade') border-red-500 @enderror"
                                placeholder="60.00">
                            @error('passing_grade')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Max Percobaan <span class="text-red-500">*</span>
                            </label>
                            <input type="number" name="max_attempts" value="{{ old('max_attempts', 3) }}" required min="1"
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-900 focus:border-gray-900 transition-colors @error('max_attempts') border-red-500 @enderror"
                                placeholder="3">
                            @error('max_attempts')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="p-4 bg-gray-50 rounded-lg border border-gray-200">
                        <div class="flex items-start">
                            <svg class="h-5 w-5 text-gray-400 mr-3 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <div>
                                <p class="text-sm font-medium text-gray-900">Jumlah Soal</p>
                                <p class="text-xs text-gray-600 mt-1">Jumlah soal akan otomatis dihitung berdasarkan soal yang ditambahkan ke modul ini.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Schedule Settings -->
                <div class="border-t border-gray-200 bg-gray-50 px-6 py-4">
                    <h2 class="text-base font-semibold text-gray-900">Jadwal Modul</h2>
                    <p class="text-xs text-gray-600 mt-1">Atur periode aktif modul (opsional)</p>
                </div>
                
                <div class="p-6 space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Tanggal Mulai <span class="text-gray-500 text-xs font-normal">(Opsional)</span>
                            </label>
                            <input type="datetime-local" name="start_date" value="{{ old('start_date') }}"
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-900 focus:border-gray-900 transition-colors">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Tanggal Selesai <span class="text-gray-500 text-xs font-normal">(Opsional)</span>
                            </label>
                            <input type="datetime-local" name="end_date" value="{{ old('end_date') }}"
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-900 focus:border-gray-900 transition-colors">
                        </div>
                    </div>
                </div>

                <!-- Publication Settings -->
                <div class="border-t border-gray-200 bg-gray-50 px-6 py-4">
                    <h2 class="text-base font-semibold text-gray-900">Pengaturan Publikasi</h2>
                    <p class="text-xs text-gray-600 mt-1">Atur visibilitas dan fitur modul</p>
                </div>
                
                <div class="p-6 space-y-4">
                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg border border-gray-200">
                        <div>
                            <label class="text-sm font-semibold text-gray-900">Publish Modul</label>
                            <p class="text-xs text-gray-600 mt-1">Modul yang dipublish akan terlihat oleh siswa</p>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="is_published" value="1" {{ old('is_published') ? 'checked' : '' }} class="sr-only peer">
                            <div class="w-11 h-6 bg-gray-300 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-gray-200 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-gray-700"></div>
                        </label>
                    </div>

                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg border border-gray-200">
                        <div>
                            <label class="text-sm font-semibold text-gray-900">Tampilkan Ranking</label>
                            <p class="text-xs text-gray-600 mt-1">Siswa dapat melihat ranking setelah menyelesaikan ujian</p>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="show_ranking" value="1" {{ old('show_ranking', true) ? 'checked' : '' }} class="sr-only peer">
                            <div class="w-11 h-6 bg-gray-300 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-gray-200 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-gray-700"></div>
                        </label>
                    </div>

                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg border border-gray-200">
                        <div>
                            <label class="text-sm font-semibold text-gray-900">Tampilkan Jawaban Setelah Submit</label>
                            <p class="text-xs text-gray-600 mt-1">Siswa dapat melihat jawaban benar setelah submit</p>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="show_answer_after_submit" value="1" {{ old('show_answer_after_submit', true) ? 'checked' : '' }} class="sr-only peer">
                            <div class="w-11 h-6 bg-gray-300 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-gray-200 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-gray-700"></div>
                        </label>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="border-t border-gray-200 bg-gray-50 px-6 py-6">
                    <div class="flex items-center justify-end space-x-4">
                        <a href="{{ route('admin.modules.index') }}" 
                            class="px-6 py-2.5 border border-gray-300 rounded-lg text-gray-700 hover:bg-white transition-colors font-medium">
                            Batal
                        </a>
                        <button type="submit" 
                            class="px-6 py-2.5 bg-gray-900 text-white rounded-lg hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors font-medium">
                            <span class="flex items-center">
                                <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Simpan Modul
                            </span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const categorySelect = document.querySelector('select[name="category_id"]');
    const codeInput = document.getElementById('module-code');
    
    // Get category codes from server
    const categoryCodes = @json($categories->pluck('code', 'id')->toArray());
    
    categorySelect.addEventListener('change', function() {
        const categoryId = this.value;
        if (categoryId && categoryCodes[categoryId]) {
            const categoryCode = categoryCodes[categoryId].toUpperCase();
            codeInput.value = categoryCode + '-XXX';
            codeInput.classList.remove('text-gray-600');
            codeInput.classList.add('text-gray-900', 'font-medium');
        } else {
            codeInput.value = '';
            codeInput.classList.remove('text-gray-900', 'font-medium');
            codeInput.classList.add('text-gray-600');
        }
    });
    
    // Trigger on page load if category is already selected
    if (categorySelect.value) {
        categorySelect.dispatchEvent(new Event('change'));
    }
});
</script>
@endsection
