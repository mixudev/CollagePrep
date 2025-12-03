@extends('layouts.app')

@section('title', 'Ujian - ' . $module->title)

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <!-- Header with Timer -->
        <div class="bg-white shadow rounded-lg mb-6 p-4">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">{{ $module->title }}</h1>
                    <p class="text-sm text-gray-600">{{ $module->category->name }}</p>
                </div>
                <div class="text-right">
                    <div class="text-sm text-gray-600 mb-1">Waktu Tersisa</div>
                    <div id="timer" class="text-3xl font-bold text-indigo-600">00:00:00</div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
            <!-- Question Navigation Sidebar -->
            <div class="lg:col-span-1">
                <div class="bg-white shadow rounded-lg p-4 sticky top-4">
                    <h3 class="font-semibold text-gray-900 mb-4">Navigasi Soal</h3>
                    <div class="grid grid-cols-5 gap-2" id="question-nav">
                        @foreach($questions as $index => $question)
                            <button 
                                type="button"
                                data-question="{{ $index + 1 }}"
                                class="question-nav-btn w-10 h-10 rounded-lg border-2 transition-colors
                                    {{ isset($answers[$question->id]) ? 'bg-green-100 border-green-500' : 'border-gray-300 hover:border-indigo-500' }}
                                    {{ $index === 0 ? 'active bg-indigo-100 border-indigo-500' : '' }}"
                                onclick="showQuestion({{ $index + 1 }})">
                                {{ $index + 1 }}
                            </button>
                        @endforeach
                    </div>
                    <div class="mt-4 pt-4 border-t border-gray-200">
                        <div class="flex items-center mb-2">
                            <div class="w-4 h-4 bg-green-100 border-2 border-green-500 rounded mr-2"></div>
                            <span class="text-sm text-gray-600">Terjawab</span>
                        </div>
                        <div class="flex items-center mb-2">
                            <div class="w-4 h-4 bg-gray-100 border-2 border-gray-300 rounded mr-2"></div>
                            <span class="text-sm text-gray-600">Belum Terjawab</span>
                        </div>
                        <button 
                            type="button"
                            id="mark-btn"
                            class="w-full mt-4 px-4 py-2 bg-yellow-100 text-yellow-800 rounded-lg hover:bg-yellow-200 transition-colors text-sm font-medium"
                            onclick="toggleMark()">
                            Tandai Ragu-ragu
                        </button>
                    </div>
                </div>
            </div>

            <!-- Question Area -->
            <div class="lg:col-span-3">
                <div class="bg-white shadow rounded-lg p-6">
                    <form id="exam-form" action="{{ route('exam.submit', $studentModule) }}" method="POST">
                        @csrf
                        <div id="questions-container">
                            @foreach($questions as $index => $question)
                                <div class="question-item {{ $index === 0 ? '' : 'hidden' }}" data-question-id="{{ $question->id }}" data-question-number="{{ $index + 1 }}">
                                    <div class="mb-4">
                                        <div class="flex items-center justify-between mb-4">
                                            <span class="px-3 py-1 bg-indigo-100 text-indigo-800 rounded-full text-sm font-semibold">
                                                Soal {{ $index + 1 }} dari {{ $questions->count() }}
                                            </span>
                                            <span class="px-3 py-1 bg-gray-100 text-gray-800 rounded-full text-sm">
                                                {{ ucfirst($question->difficulty) }} | {{ $question->points }} poin
                                            </span>
                                        </div>
                                        
                                        <div class="mb-6">
                                            @if($question->question_image)
                                                <div class="flex gap-6 items-start">
                                                    <div class="flex-shrink-0 w-56 max-w-[224px]">
                                                        <div class="bg-gray-50 rounded-lg border border-gray-200 p-3">
                                                            <img src="{{ asset('storage/' . $question->question_image) }}" 
                                                                alt="Question Image" 
                                                                class="w-full h-auto max-h-80 object-contain rounded cursor-pointer hover:opacity-90 transition-opacity"
                                                                onclick="openImageModal('{{ asset('storage/' . $question->question_image) }}')">
                                                        </div>
                                                    </div>
                                                    <div class="flex-1 min-w-0">
                                                        <p class="text-lg font-medium text-gray-900 leading-relaxed">{!! nl2br(e($question->question_text)) !!}</p>
                                                    </div>
                                                </div>
                                            @else
                                                <p class="text-lg font-medium text-gray-900 leading-relaxed">{!! nl2br(e($question->question_text)) !!}</p>
                                            @endif
                                        </div>

                                        @if($question->type === 'multiple_choice')
                                            <div class="space-y-3">
                                                @foreach($question->options->sortBy('option_label') as $option)
                                                    <label class="flex items-start p-4 border-2 rounded-lg cursor-pointer transition-colors hover:bg-gray-50
                                                        {{ isset($answers[$question->id]) && $answers[$question->id] == $option->id ? 'border-gray-900 bg-gray-50' : 'border-gray-200' }}">
                                                        <input 
                                                            type="radio" 
                                                            name="question_{{ $question->id }}" 
                                                            value="{{ $option->id }}"
                                                            data-question-id="{{ $question->id }}"
                                                            data-option-id="{{ $option->id }}"
                                                            class="mt-1 mr-3 h-4 w-4 text-gray-900 focus:ring-gray-500"
                                                            {{ isset($answers[$question->id]) && $answers[$question->id] == $option->id ? 'checked' : '' }}
                                                            onchange="saveAnswer({{ $question->id }}, {{ $option->id }})">
                                                        <div class="flex-1">
                                                            <span class="font-semibold text-gray-900 mr-2">{{ $option->option_label }}.</span>
                                                            <span class="text-gray-700">{{ $option->option_text }}</span>
                                                        </div>
                                                    </label>
                                                @endforeach
                                            </div>
                                        @elseif($question->type === 'true_false')
                                            @php
                                                $trueOption = $question->options->where('option_text', 'Benar')->first();
                                                $falseOption = $question->options->where('option_text', 'Salah')->first();
                                            @endphp
                                            @if($trueOption && $falseOption)
                                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6">
                                                    <button 
                                                        type="button"
                                                        data-question-id="{{ $question->id }}"
                                                        data-option-id="{{ $trueOption->id }}"
                                                        onclick="saveAnswer({{ $question->id }}, {{ $trueOption->id }}); return false;"
                                                        class="flex items-center justify-center p-6 border-2 rounded-lg cursor-pointer transition-all duration-200 font-semibold text-lg relative z-10
                                                            {{ isset($answers[$question->id]) && $answers[$question->id] == $trueOption->id ? 'bg-gray-900 text-white border-gray-900 scale-105' : 'bg-white text-gray-900 border-gray-200 hover:border-gray-400 hover:scale-105' }}"
                                                        style="pointer-events: auto;">
                                                        <svg class="h-8 w-8 mr-3 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                        </svg>
                                                        <span class="text-xl pointer-events-none">Benar</span>
                                                    </button>
                                                    <button 
                                                        type="button"
                                                        data-question-id="{{ $question->id }}"
                                                        data-option-id="{{ $falseOption->id }}"
                                                        onclick="saveAnswer({{ $question->id }}, {{ $falseOption->id }}); return false;"
                                                        class="flex items-center justify-center p-6 border-2 rounded-lg cursor-pointer transition-all duration-200 font-semibold text-lg relative z-10
                                                            {{ isset($answers[$question->id]) && $answers[$question->id] == $falseOption->id ? 'bg-gray-900 text-white border-gray-900 scale-105' : 'bg-white text-gray-900 border-gray-200 hover:border-gray-400 hover:scale-105' }}"
                                                        style="pointer-events: auto;">
                                                        <svg class="h-8 w-8 mr-3 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                        </svg>
                                                        <span class="text-xl pointer-events-none">Salah</span>
                                                    </button>
                                                </div>
                                            @else
                                                <div class="mt-4 p-4 bg-red-50 border border-red-200 rounded-lg">
                                                    <p class="text-red-600 text-sm">Error: Opsi benar/salah tidak ditemukan untuk soal ini.</p>
                                                </div>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="flex items-center justify-between mt-8 pt-6 border-t border-gray-200">
                            <button 
                                type="button"
                                id="prev-btn"
                                class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors font-medium"
                                onclick="previousQuestion()"
                                style="display: none;">
                                ← Sebelumnya
                            </button>
                            <div class="flex space-x-4">
                                <button 
                                    type="button"
                                    id="next-btn"
                                    class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors font-medium"
                                    onclick="nextQuestion()">
                                    Selanjutnya →
                                </button>
                                <button 
                                    type="button"
                                    id="submit-btn"
                                    class="px-6 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors font-medium hidden"
                                    onclick="submitExam()">
                                    Submit Ujian
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
let currentQuestion = 1;
const totalQuestions = {{ $questions->count() }};
const duration = {{ $module->duration }} * 60; // Convert to seconds
let timeLeft = duration;
let timerInterval;

// Timer
function startTimer() {
    timerInterval = setInterval(() => {
        timeLeft--;
        updateTimerDisplay();
        
        if (timeLeft <= 0) {
            clearInterval(timerInterval);
            submitExam(true);
        }
    }, 1000);
    updateTimerDisplay();
}

function updateTimerDisplay() {
    const hours = Math.floor(timeLeft / 3600);
    const minutes = Math.floor((timeLeft % 3600) / 60);
    const seconds = timeLeft % 60;
    document.getElementById('timer').textContent = 
        `${String(hours).padStart(2, '0')}:${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
    
    if (timeLeft <= 300) { // 5 minutes
        document.getElementById('timer').classList.add('text-red-600');
    }
}

// Question Navigation
function showQuestion(num) {
    document.querySelectorAll('.question-item').forEach(item => item.classList.add('hidden'));
    document.querySelector(`[data-question-number="${num}"]`).classList.remove('hidden');
    
    document.querySelectorAll('.question-nav-btn').forEach(btn => btn.classList.remove('active', 'bg-indigo-100', 'border-indigo-500'));
    document.querySelector(`[data-question="${num}"]`).classList.add('active', 'bg-indigo-100', 'border-indigo-500');
    
    currentQuestion = num;
    updateNavigationButtons();
}

function nextQuestion() {
    if (currentQuestion < totalQuestions) {
        showQuestion(currentQuestion + 1);
    }
}

function previousQuestion() {
    if (currentQuestion > 1) {
        showQuestion(currentQuestion - 1);
    }
}

function updateNavigationButtons() {
    document.getElementById('prev-btn').style.display = currentQuestion === 1 ? 'none' : 'block';
    document.getElementById('next-btn').style.display = currentQuestion === totalQuestions ? 'none' : 'block';
    document.getElementById('submit-btn').classList.toggle('hidden', currentQuestion !== totalQuestions);
}

// Save Answer
function saveAnswer(questionId, optionId) {
    console.log('saveAnswer called:', { questionId, optionId });
    
    // Immediately update UI for better UX
    const questionItem = document.querySelector(`.question-item[data-question-id="${questionId}"]`);
    if (questionItem) {
        // Update true/false buttons visual state
        const trueFalseButtons = questionItem.querySelectorAll('button[data-option-id]');
        trueFalseButtons.forEach(btn => {
            const btnOptionId = parseInt(btn.getAttribute('data-option-id'));
            if (btnOptionId === optionId) {
                // Selected button
                btn.classList.add('bg-gray-900', 'text-white', 'border-gray-900', 'scale-105');
                btn.classList.remove('bg-white', 'text-gray-900', 'border-gray-200', 'hover:border-gray-400');
            } else {
                // Unselected button
                btn.classList.remove('bg-gray-900', 'text-white', 'border-gray-900', 'scale-105');
                btn.classList.add('bg-white', 'text-gray-900', 'border-gray-200', 'hover:border-gray-400');
            }
        });
        
        // Update multiple choice radio buttons
        const radioInputs = questionItem.querySelectorAll(`input[data-question-id="${questionId}"]`);
        radioInputs.forEach(input => {
            const inputOptionId = parseInt(input.getAttribute('data-option-id'));
            const label = input.closest('label');
            if (inputOptionId === optionId) {
                input.checked = true;
                if (label) {
                    label.classList.add('border-gray-900', 'bg-gray-50');
                    label.classList.remove('border-gray-200');
                }
            } else {
                input.checked = false;
                if (label) {
                    label.classList.remove('border-gray-900', 'bg-gray-50');
                    label.classList.add('border-gray-200');
                }
            }
        });
    }
    
    // Save to server
    fetch('{{ route("exam.save-answer", $studentModule) }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
            question_id: questionId,
            selected_option_id: optionId
        })
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        console.log('Answer saved:', data);
        
        // Update navigation button
        const questionNum = Array.from(document.querySelectorAll('.question-item')).findIndex(item => 
            item.dataset.questionId == questionId
        ) + 1;
        const navBtn = document.querySelector(`[data-question="${questionNum}"]`);
        if (navBtn) {
            navBtn.classList.add('bg-green-100', 'border-green-500');
            navBtn.classList.remove('border-gray-300');
        }
    })
    .catch(error => {
        console.error('Error saving answer:', error);
        // Optionally show error message to user
    });
}

function toggleMark() {
    // Implement mark functionality if needed
}

function submitExam(auto = false) {
    const message = auto 
        ? 'Waktu ujian telah habis. Jawaban akan otomatis disubmit.'
        : 'Apakah Anda yakin ingin menyelesaikan ujian? Pastikan semua jawaban sudah diisi.';
    
        if (!auto) {
        if (typeof Swal !== 'undefined') {
            Swal.fire({
                title: 'Konfirmasi Submit',
                text: message,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Submit',
                cancelButtonText: 'Batal',
                reverseButtons: true,
                customClass: {
                    popup: 'minimal-swal-popup',
                    confirmButton: 'minimal-swal-confirm',
                    cancelButton: 'minimal-swal-cancel'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('exam-form').submit();
                }
            });
        } else {
            // Fallback jika SweetAlert belum load
            if (confirm(message)) {
                document.getElementById('exam-form').submit();
            }
        }
    } else {
        if (typeof Swal !== 'undefined') {
            Swal.fire({
                title: 'Waktu Habis',
                text: 'Waktu ujian telah habis. Jawaban akan otomatis disubmit.',
                icon: 'info',
                confirmButtonText: 'OK',
                customClass: {
                    popup: 'minimal-swal-popup',
                    confirmButton: 'minimal-swal-confirm'
                },
                allowOutsideClick: false,
                allowEscapeKey: false
            }).then(() => {
                document.getElementById('exam-form').submit();
            });
        } else {
            document.getElementById('exam-form').submit();
        }
    }
}

// Image Modal
function openImageModal(imageSrc) {
    if (typeof Swal !== 'undefined') {
        Swal.fire({
            html: `<img src="${imageSrc}" alt="Question Image" class="max-w-full max-h-[80vh] object-contain rounded-lg">`,
            width: '90%',
            showCloseButton: true,
            showConfirmButton: false,
            background: 'rgba(0, 0, 0, 0.9)',
            customClass: {
                popup: 'minimal-swal-popup'
            },
            customClass: {
                popup: 'image-modal-popup'
            }
        });
    } else {
        // Fallback jika SweetAlert belum load
        const modal = document.createElement('div');
        modal.className = 'fixed inset-0 bg-black bg-opacity-90 z-50 flex items-center justify-center p-4';
        modal.onclick = function(e) {
            if (e.target === modal) {
                document.body.removeChild(modal);
            }
        };
        const img = document.createElement('img');
        img.src = imageSrc;
        img.className = 'max-w-full max-h-[90vh] object-contain rounded-lg';
        modal.appendChild(img);
        document.body.appendChild(modal);
    }
}

// Initialize
document.addEventListener('DOMContentLoaded', function() {
    startTimer();
    updateNavigationButtons();
    
    // Prevent page reload warning
    window.addEventListener('beforeunload', function(e) {
        e.preventDefault();
        e.returnValue = '';
    });
});
</script>

<!-- Image Modal Styles -->
<style>
.image-modal-popup {
    background: transparent !important;
}
</style>
@endsection

