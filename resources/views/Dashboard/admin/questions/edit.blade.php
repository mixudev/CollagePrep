@extends('layouts.app')

@section('title', 'Edit Soal')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Edit Soal</h1>
                    <p class="mt-2 text-sm text-gray-600">Modul: <span class="font-semibold">{{ $question->module->title }}</span></p>
                </div>
                <a href="{{ route('admin.modules.show', $question->module) }}" class="flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                    <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Kembali ke Modul
                </a>
            </div>
        </div>

        <!-- Form Card -->
        <div class="bg-white shadow-sm border border-gray-200 rounded-xl overflow-hidden">
            <form action="{{ route('admin.questions.update', $question) }}" method="POST" enctype="multipart/form-data" id="question-form" data-confirm-submit="Apakah Anda yakin ingin menyimpan perubahan soal?">
                @csrf
                @method('PUT')
                
                <!-- Basic Information Section -->
                <div class="border-b border-gray-200 bg-gray-50 px-6 py-4">
                    <h2 class="text-lg font-semibold text-gray-900">Informasi Dasar</h2>
                    <p class="text-sm text-gray-600 mt-1">Modul dan kategori tidak dapat diubah</p>
                </div>
                
                <div class="p-6 space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Modul Selection (Readonly) -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Modul <span class="text-red-500">*</span>
                            </label>
                            <input type="hidden" name="module_id" value="{{ $question->module_id }}">
                            <div class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-gray-50 text-gray-700 cursor-not-allowed">
                                {{ $question->module->code }} - {{ $question->module->title }}
                            </div>
                        </div>

                        <!-- Kategori Selection (Readonly) -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Kategori <span class="text-red-500">*</span>
                            </label>
                            <input type="hidden" name="category_id" value="{{ $question->module->category_id }}">
                            <div class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-gray-50 text-gray-700 cursor-not-allowed">
                                {{ $question->module->category->name }}
                            </div>
                        </div>
                    </div>

                    <!-- Question Text -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Teks Soal <span class="text-red-500">*</span>
                        </label>
                        <textarea name="question_text" rows="5" required 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors resize-none"
                            placeholder="Masukkan teks soal di sini...">{{ old('question_text', $question->question_text) }}</textarea>
                        @error('question_text')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Question Image -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Gambar Soal <span class="text-gray-500 text-xs font-normal">(Opsional)</span>
                        </label>
                        @if($question->question_image)
                            <div class="mb-4">
                                <p class="text-sm text-gray-600 mb-2">Gambar saat ini:</p>
                                <img src="{{ asset('storage/' . $question->question_image) }}" alt="Current image" class="max-h-48 rounded-lg border border-gray-300">
                            </div>
                        @endif
                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:border-indigo-400 transition-colors">
                            <div class="space-y-1 text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div class="flex text-sm text-gray-600">
                                    <label for="question_image" class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                        <span>Upload gambar baru</span>
                                        <input id="question_image" name="question_image" type="file" accept="image/*" class="sr-only">
                                    </label>
                                    <p class="pl-1">atau drag and drop</p>
                                </div>
                                <p class="text-xs text-gray-500">PNG, JPG, GIF hingga 2MB</p>
                            </div>
                        </div>
                        <div id="image-preview" class="mt-4 hidden">
                            <img id="preview-img" src="" alt="Preview" class="max-h-48 rounded-lg border border-gray-300">
                        </div>
                        @error('question_image')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Question Settings Section -->
                <div class="border-t border-gray-200 bg-gray-50 px-6 py-4">
                    <h2 class="text-lg font-semibold text-gray-900">Pengaturan Soal</h2>
                    <p class="text-sm text-gray-600 mt-1">Konfigurasi tipe, kesulitan, dan poin soal</p>
                </div>
                
                <div class="p-6 space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Question Type -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Tipe Soal <span class="text-red-500">*</span>
                            </label>
                            <select name="type" required id="question-type" 
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-900 focus:border-gray-900 transition-colors bg-white">
                                <option value="multiple_choice" {{ old('type', $question->type) == 'multiple_choice' ? 'selected' : '' }}>Pilihan Ganda</option>
                                <option value="true_false" {{ old('type', $question->type) == 'true_false' ? 'selected' : '' }}>Benar/Salah</option>
                            </select>
                            @error('type')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Difficulty -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Tingkat Kesulitan <span class="text-red-500">*</span>
                            </label>
                            <select name="difficulty" required 
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors bg-white">
                                <option value="easy" {{ old('difficulty', $question->difficulty) == 'easy' ? 'selected' : '' }}>Mudah</option>
                                <option value="medium" {{ old('difficulty', $question->difficulty) == 'medium' ? 'selected' : '' }}>Sedang</option>
                                <option value="hard" {{ old('difficulty', $question->difficulty) == 'hard' ? 'selected' : '' }}>Sulit</option>
                            </select>
                            @error('difficulty')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Points -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Poin <span class="text-red-500">*</span>
                            </label>
                            <input type="number" name="points" value="{{ old('points', $question->points) }}" required min="0" step="0.1" 
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors"
                                placeholder="1.0">
                            @error('points')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Options Section (for Multiple Choice) -->
                <div id="options-section" class="border-t border-gray-200 {{ $question->type === 'multiple_choice' ? '' : 'hidden' }}">
                    <div class="bg-gray-50 px-6 py-4">
                        <h2 class="text-base font-semibold text-gray-900">Pilihan Jawaban</h2>
                        <p class="text-xs text-gray-600 mt-1">Edit pilihan jawaban dan tandai jawaban yang benar</p>
                    </div>
                    
                    <div class="p-6">
                        <div id="options-container" class="space-y-4">
                            @php
                                $options = $question->options->sortBy('option_label');
                                $optionCount = max(5, $options->count());
                            @endphp
                            @for($i = 0; $i < $optionCount; $i++)
                                @php
                                    $option = $options->where('option_label', chr(65 + $i))->first();
                                @endphp
                                <div class="option-item flex items-start gap-4 p-4 border-2 border-gray-200 rounded-lg hover:border-indigo-300 transition-colors bg-white">
                                    <div class="flex-shrink-0">
                                        <div class="w-12 h-12 flex items-center justify-center bg-indigo-100 text-indigo-700 rounded-lg font-bold text-lg">
                                            {{ chr(65 + $i) }}
                                        </div>
                                    </div>
                                    <div class="flex-1">
                                        <input type="hidden" name="options[{{ $i }}][option_label]" value="{{ chr(65 + $i) }}">
                                        <input type="text" 
                                            name="options[{{ $i }}][option_text]" 
                                            placeholder="Masukkan teks jawaban {{ chr(65 + $i) }}..." 
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors"
                                            value="{{ old("options.$i.option_text", $option->option_text ?? '') }}">
                                    </div>
                                    <div class="flex-shrink-0 flex items-center">
                                        <label class="flex items-center cursor-pointer p-3 rounded-lg hover:bg-indigo-50 transition-colors">
                                            <input type="radio" name="correct_option" value="{{ $i }}" 
                                                class="h-5 w-5 text-indigo-600 focus:ring-indigo-500"
                                                {{ ($option && $option->is_correct) || old('correct_option') == $i ? 'checked' : '' }}>
                                            <span class="ml-2 text-sm font-medium text-gray-700">Jawaban Benar</span>
                                        </label>
                                    </div>
                                </div>
                            @endfor
                        </div>
                        <p class="mt-4 text-sm text-gray-500 flex items-center">
                            <svg class="h-5 w-5 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Pilih salah satu jawaban sebagai jawaban yang benar
                        </p>
                    </div>
                </div>

                <!-- True/False Answer Section -->
                <div id="true-false-section" class="border-t border-gray-200 {{ $question->type === 'true_false' ? '' : 'hidden' }}">
                    <div class="bg-gray-50 px-6 py-4">
                        <h2 class="text-base font-semibold text-gray-900">Jawaban Benar/Salah</h2>
                        <p class="text-xs text-gray-600 mt-1">Pilih apakah pernyataan ini benar atau salah</p>
                    </div>
                    
                    <div class="p-6">
                        @php
                            $trueOption = $question->options->where('option_text', 'Benar')->first();
                            $currentAnswer = $trueOption && $trueOption->is_correct ? 'true' : 'false';
                        @endphp
                        <div class="space-y-4">
                            <label class="flex items-center p-4 border-2 rounded-lg hover:border-gray-400 transition-colors cursor-pointer bg-white {{ old('true_false_answer', $currentAnswer) == 'true' ? 'border-gray-900' : 'border-gray-200' }}">
                                <input type="radio" name="true_false_answer" value="true" 
                                    class="h-5 w-5 text-gray-900 focus:ring-gray-500"
                                    {{ old('true_false_answer', $currentAnswer) == 'true' ? 'checked' : '' }}>
                                <div class="ml-4">
                                    <div class="text-sm font-semibold text-gray-900">Benar</div>
                                    <div class="text-xs text-gray-600">Pernyataan ini benar</div>
                                </div>
                            </label>
                            <label class="flex items-center p-4 border-2 rounded-lg hover:border-gray-400 transition-colors cursor-pointer bg-white {{ old('true_false_answer', $currentAnswer) == 'false' ? 'border-gray-900' : 'border-gray-200' }}">
                                <input type="radio" name="true_false_answer" value="false" 
                                    class="h-5 w-5 text-gray-900 focus:ring-gray-500"
                                    {{ old('true_false_answer', $currentAnswer) == 'false' ? 'checked' : '' }}>
                                <div class="ml-4">
                                    <div class="text-sm font-semibold text-gray-900">Salah</div>
                                    <div class="text-xs text-gray-600">Pernyataan ini salah</div>
                                </div>
                            </label>
                        </div>
                        @error('true_false_answer')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Additional Information Section -->
                <div class="border-t border-gray-200 bg-gray-50 px-6 py-4">
                    <h2 class="text-lg font-semibold text-gray-900">Informasi Tambahan</h2>
                    <p class="text-sm text-gray-600 mt-1">Tambahkan pembahasan dan pengaturan lainnya</p>
                </div>
                
                <div class="p-6 space-y-6">
                    <!-- Explanation -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Pembahasan <span class="text-gray-500 text-xs font-normal">(Opsional)</span>
                        </label>
                        <textarea name="explanation" rows="4" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors resize-none"
                            placeholder="Masukkan pembahasan atau penjelasan untuk jawaban yang benar...">{{ old('explanation', $question->explanation) }}</textarea>
                        @error('explanation')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Active Status -->
                    <div class="flex items-center justify-between p-4 bg-indigo-50 rounded-lg border border-indigo-200">
                        <div>
                            <label class="text-sm font-semibold text-gray-900">Status Aktif</label>
                            <p class="text-xs text-gray-600 mt-1">Soal yang aktif akan ditampilkan dalam ujian</p>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="is_active" value="1" {{ old('is_active', $question->is_active) ? 'checked' : '' }} class="sr-only peer">
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-indigo-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-indigo-600"></div>
                        </label>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="border-t border-gray-200 bg-gray-50 px-6 py-6">
                    <div class="flex items-center justify-end space-x-4">
                        <a href="{{ route('admin.modules.show', $question->module) }}" 
                            class="px-6 py-3 border border-gray-300 rounded-lg text-gray-700 hover:bg-white transition-colors font-medium">
                            Batal
                        </a>
                        <button type="submit" 
                            class="px-6 py-3 bg-gray-900 text-white rounded-lg hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors font-medium">
                            <span class="flex items-center">
                                <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Update Soal
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
    const questionType = document.getElementById('question-type');
    const optionsSection = document.getElementById('options-section');
    const trueFalseSection = document.getElementById('true-false-section');
    const imageInput = document.getElementById('question_image');
    const imagePreview = document.getElementById('image-preview');
    const previewImg = document.getElementById('preview-img');

    // Show/hide options section based on question type
    function toggleOptionsSection() {
        if (questionType.value === 'multiple_choice') {
            optionsSection.classList.remove('hidden');
            trueFalseSection.classList.add('hidden');
        } else if (questionType.value === 'true_false') {
            optionsSection.classList.add('hidden');
            trueFalseSection.classList.remove('hidden');
        } else {
            optionsSection.classList.add('hidden');
            trueFalseSection.classList.add('hidden');
        }
    }

    questionType.addEventListener('change', toggleOptionsSection);
    toggleOptionsSection(); // Initial check

    // Image preview
    imageInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImg.src = e.target.result;
                imagePreview.classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        } else {
            imagePreview.classList.add('hidden');
        }
    });

    // Form validation
    document.getElementById('question-form').addEventListener('submit', function(e) {
        if (questionType.value === 'multiple_choice') {
            const correctOption = document.querySelector('input[name="correct_option"]:checked');
            if (!correctOption) {
                e.preventDefault();
                if (typeof Swal !== 'undefined') {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Peringatan',
                        text: 'Silakan pilih jawaban yang benar!',
                        confirmButtonText: 'OK',
                        customClass: {
                            popup: 'minimal-swal-popup',
                            confirmButton: 'minimal-swal-confirm'
                        }
                    });
                } else {
                    alert('Silakan pilih jawaban yang benar!');
                }
                return false;
            }
        } else if (questionType.value === 'true_false') {
            const trueFalseAnswer = document.querySelector('input[name="true_false_answer"]:checked');
            if (!trueFalseAnswer) {
                e.preventDefault();
                if (typeof Swal !== 'undefined') {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Peringatan',
                        text: 'Silakan pilih apakah pernyataan benar atau salah!',
                        confirmButtonText: 'OK',
                        customClass: {
                            popup: 'minimal-swal-popup',
                            confirmButton: 'minimal-swal-confirm'
                        }
                    });
                } else {
                    alert('Silakan pilih apakah pernyataan benar atau salah!');
                }
                return false;
            }
        }
    });
});
</script>
@endsection
