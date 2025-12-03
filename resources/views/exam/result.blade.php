@extends('layouts.app')

@section('title', 'Hasil Ujian - ' . $studentModule->module->title)

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <!-- Header Card -->
        <div class="bg-white shadow-sm border border-gray-200 rounded-xl p-8 mb-6">
            <div class="text-center">
                <div class="mx-auto h-16 w-16 rounded-full bg-gray-100 flex items-center justify-center mb-4">
                    @if($studentModule->score >= $studentModule->module->passing_grade)
                        <svg class="h-10 w-10 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    @else
                        <svg class="h-10 w-10 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    @endif
                </div>
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Hasil Ujian</h1>
                <h2 class="text-lg text-gray-600 mb-6">{{ $studentModule->module->title }}</h2>
                <div class="inline-flex items-center justify-center px-8 py-4 bg-gray-900 rounded-lg mb-4">
                    <span class="text-5xl font-bold text-white">{{ number_format($studentModule->score, 2) }}</span>
                    <span class="text-xl text-gray-300 ml-2">/ 100</span>
                </div>
                <div class="flex items-center justify-center gap-4 text-sm text-gray-600">
                    <span>Passing Grade: <strong class="text-gray-900">{{ $studentModule->module->passing_grade }}</strong></span>
                    <span class="text-gray-300">|</span>
                    @if($studentModule->score >= $studentModule->module->passing_grade)
                        <span class="text-gray-900 font-semibold">✓ Lulus</span>
                    @else
                        <span class="text-gray-900 font-semibold">✗ Tidak Lulus</span>
                    @endif
                </div>
            </div>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
            <div class="bg-white border border-gray-200 rounded-lg p-5 text-center shadow-sm">
                <div class="text-3xl font-bold text-gray-900 mb-1">{{ $studentModule->correct_answers ?? 0 }}</div>
                <div class="text-sm text-gray-600">Benar</div>
            </div>
            <div class="bg-white border border-gray-200 rounded-lg p-5 text-center shadow-sm">
                <div class="text-3xl font-bold text-gray-900 mb-1">{{ $studentModule->wrong_answers ?? 0 }}</div>
                <div class="text-sm text-gray-600">Salah</div>
            </div>
            <div class="bg-white border border-gray-200 rounded-lg p-5 text-center shadow-sm">
                <div class="text-3xl font-bold text-gray-900 mb-1">{{ $studentModule->unanswered ?? 0 }}</div>
                <div class="text-sm text-gray-600">Tidak Dijawab</div>
            </div>
            <div class="bg-white border border-gray-200 rounded-lg p-5 text-center shadow-sm">
                <div class="text-3xl font-bold text-gray-900 mb-1">{{ round($studentModule->duration_seconds / 60) ?? 0 }}</div>
                <div class="text-sm text-gray-600">Menit</div>
            </div>
        </div>

        <!-- Review Answers -->
        @if($studentModule->module->show_answer_after_submit)
            <div class="bg-white shadow-sm border border-gray-200 rounded-xl p-8">
                <div class="mb-6">
                    <h3 class="text-2xl font-bold text-gray-900">Review Jawaban</h3>
                    <p class="text-sm text-gray-600 mt-1">Pembahasan lengkap untuk semua soal</p>
                </div>
                
                <div class="space-y-6">
                    @foreach($questions as $index => $question)
                        @php
                            $answer = $studentAnswers[$question->id] ?? null;
                            $isCorrect = $answer ? $answer->is_correct : false;
                            $selectedOptionId = $answer ? $answer->selected_option_id : null;
                        @endphp
                        
                        <div class="border border-gray-200 rounded-lg p-6 {{ $isCorrect ? 'bg-green-50 border-green-200' : ($answer ? 'bg-red-50 border-red-200' : 'bg-white') }}">
                            <!-- Question Header -->
                            <div class="flex items-start justify-between mb-4 pb-4 border-b border-gray-200">
                                <div class="flex items-center gap-3">
                                    <span class="px-3 py-1 bg-gray-900 text-white rounded text-sm font-semibold">
                                        Soal {{ $index + 1 }}
                                    </span>
                                    <span class="px-3 py-1 bg-gray-100 text-gray-700 rounded text-sm">
                                        {{ ucfirst($question->difficulty) }} | {{ $question->points }} poin
                                    </span>
                                </div>
                                <div class="flex items-center gap-2">
                                    @if($answer)
                                        @if($isCorrect)
                                            <span class="px-3 py-1 bg-gray-900 text-white rounded text-sm font-semibold">✓ Benar</span>
                                        @else
                                            <span class="px-3 py-1 bg-gray-700 text-white rounded text-sm font-semibold">✗ Salah</span>
                                        @endif
                                    @else
                                        <span class="px-3 py-1 bg-gray-300 text-gray-700 rounded text-sm font-semibold">Tidak Dijawab</span>
                                    @endif
                                </div>
                            </div>
                            
                            <!-- Question Text -->
                            <div class="mb-6">
                                @if($question->question_image)
                                    <div class="flex gap-6 items-start mb-4">
                                        <div class="flex-shrink-0 w-48 max-w-[192px]">
                                            <div class="bg-gray-50 rounded-lg border border-gray-200 p-3">
                                                <img src="{{ asset('storage/' . $question->question_image) }}" 
                                                    alt="Question Image" 
                                                    class="w-full h-auto max-h-64 object-contain rounded cursor-pointer hover:opacity-90 transition-opacity"
                                                    onclick="openImageModal('{{ asset('storage/' . $question->question_image) }}')">
                                            </div>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-base font-medium text-gray-900 leading-relaxed">{!! nl2br(e($question->question_text)) !!}</p>
                                        </div>
                                    </div>
                                @else
                                    <p class="text-base font-medium text-gray-900 leading-relaxed">{!! nl2br(e($question->question_text)) !!}</p>
                                @endif
                            </div>
                            
                            <!-- Options -->
                            <div class="space-y-2 mb-6">
                                @foreach($question->options->sortBy('option_label') as $option)
                                    @php
                                        $isSelected = $selectedOptionId == $option->id;
                                        $isCorrect = $option->is_correct;
                                    @endphp
                                    <div class="p-4 rounded-lg border-2 transition-colors
                                        {{ $isCorrect ? 'border-green-600 bg-green-50' : '' }}
                                        {{ $isSelected && !$isCorrect ? 'border-red-600 bg-red-50' : '' }}
                                        {{ !$isSelected && !$isCorrect ? 'border-gray-200 bg-white' : '' }}">
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center flex-1">
                                                <span class="font-semibold text-gray-900 mr-3 min-w-[24px]">{{ $option->option_label }}.</span>
                                                <span class="text-gray-700 flex-1">{{ $option->option_text }}</span>
                                            </div>
                                            <div class="flex items-center gap-3 ml-4">
                                                @if($isCorrect)
                                                    <span class="px-2 py-1 bg-green-600 text-white text-xs font-semibold rounded">Jawaban Benar</span>
                                                @endif
                                                @if($isSelected && !$isCorrect)
                                                    <span class="px-2 py-1 bg-red-600 text-white text-xs font-semibold rounded">Jawaban Anda</span>
                                                @endif
                                                @if($isSelected && $isCorrect)
                                                    <span class="px-2 py-1 bg-green-600 text-white text-xs font-semibold rounded">Jawaban Anda</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            
                            <!-- Explanation -->
                            @if($question->explanation)
                                <div class="mt-6 pt-6 border-t border-gray-200">
                                    <h4 class="font-semibold text-gray-900 mb-3 flex items-center">
                                        <svg class="h-5 w-5 mr-2 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Pembahasan
                                    </h4>
                                    <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                                        <p class="text-sm text-gray-700 leading-relaxed">{!! nl2br(e($question->explanation)) !!}</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        @else
            <div class="bg-white shadow-sm border border-gray-200 rounded-xl p-8 text-center">
                <p class="text-gray-600">Pembahasan tidak tersedia untuk modul ini.</p>
            </div>
        @endif

        <!-- Actions -->
        <div class="mt-8 flex justify-center gap-4">
            <a href="{{ route('dashboard') }}" class="px-6 py-2.5 bg-gray-900 text-white rounded-lg hover:bg-gray-800 transition-colors font-medium">
                Kembali ke Dashboard
            </a>
            <a href="{{ route('rankings.index', ['module_id' => $studentModule->module_id]) }}" class="px-6 py-2.5 bg-white border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors font-medium">
                Lihat Ranking
            </a>
        </div>
    </div>
</div>

<!-- Image Modal Script -->
<script>
function openImageModal(imageSrc) {
    if (typeof Swal !== 'undefined') {
        Swal.fire({
            html: `<img src="${imageSrc}" alt="Question Image" class="max-w-full max-h-[80vh] object-contain rounded-lg">`,
            width: '90%',
            showCloseButton: true,
            showConfirmButton: false,
            customClass: {
                popup: 'minimal-swal-popup',
            },
            background: '#ffffff',
        });
    } else {
        window.open(imageSrc, '_blank');
    }
}
</script>
@endsection
