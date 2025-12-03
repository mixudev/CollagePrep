<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\Question;
use App\Models\StudentAnswer;
use App\Models\StudentModule;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ExamController extends Controller
{
    public function show(Module $module)
    {
        $user = Auth::user();

        // Check if module is available
        if (!$module->is_active) {
            return redirect()->route('dashboard')
                ->with('error', 'Modul tidak tersedia.');
        }

        // Get or create student module
        $studentModule = StudentModule::where('user_id', $user->id)
            ->where('module_id', $module->id)
            ->where('status', 'in_progress')
            ->first();

        if (!$studentModule) {
            // Check max attempts
            $attemptCount = StudentModule::where('user_id', $user->id)
                ->where('module_id', $module->id)
                ->count();

            if ($attemptCount >= $module->max_attempts) {
                return redirect()->route('dashboard')
                    ->with('error', 'Anda telah mencapai batas maksimal percobaan untuk modul ini.');
            }

            // Create new attempt
            $studentModule = StudentModule::create([
                'user_id' => $user->id,
                'module_id' => $module->id,
                'status' => 'in_progress',
                'started_at' => now(),
                'attempt_number' => $attemptCount + 1,
            ]);

            // Log exam start
            ActivityLog::logActivity(
                'exam_started',
                "User {$user->name} memulai ujian: {$module->title} (Percobaan ke-{$studentModule->attempt_number})",
                $module,
                [
                    'student_module_id' => $studentModule->id,
                    'attempt_number' => $studentModule->attempt_number,
                    'module_id' => $module->id
                ]
            );
        }

        // Get questions
        $questions = Question::where('module_id', $module->id)
            ->active()
            ->ordered()
            ->with('options')
            ->get();

        // Get existing answers
        $answers = StudentAnswer::where('student_module_id', $studentModule->id)
            ->pluck('selected_option_id', 'question_id')
            ->toArray();

        return view('exam.take', compact('module', 'studentModule', 'questions', 'answers'));
    }

    public function saveAnswer(Request $request, StudentModule $studentModule)
    {
        $validated = $request->validate([
            'question_id' => 'required|exists:questions,id',
            'selected_option_id' => 'nullable|exists:question_options,id',
            'is_marked' => 'boolean',
        ]);

        $question = Question::findOrFail($validated['question_id']);

        $isCorrect = false;
        $pointsEarned = 0;

        if ($validated['selected_option_id']) {
            $selectedOption = $question->options()->find($validated['selected_option_id']);
            $isCorrect = $selectedOption ? $selectedOption->is_correct : false;
            $pointsEarned = $isCorrect ? $question->points : 0;
        }

        StudentAnswer::updateOrCreate(
            [
                'student_module_id' => $studentModule->id,
                'question_id' => $validated['question_id'],
            ],
            [
                'selected_option_id' => $validated['selected_option_id'],
                'is_correct' => $isCorrect,
                'points_earned' => $pointsEarned,
                'is_marked' => $validated['is_marked'] ?? false,
            ]
        );

        return response()->json(['success' => true]);
    }

    public function submit(Request $request, StudentModule $studentModule)
    {
        if ($studentModule->status === 'completed') {
            return redirect()->route('exam.result', $studentModule)
                ->with('error', 'Ujian sudah disubmit sebelumnya.');
        }

        DB::transaction(function () use ($studentModule) {
            $answers = StudentAnswer::where('student_module_id', $studentModule->id)
                ->with('question')
                ->get();

            $correctAnswers = $answers->where('is_correct', true)->count();
            $wrongAnswers = $answers->where('is_correct', false)->count();
            $unanswered = $studentModule->module->total_questions - $answers->count();
            $totalPoints = $answers->sum('points_earned');
            $maxPoints = $studentModule->module->questions()->sum('points');
            $score = $maxPoints > 0 ? ($totalPoints / $maxPoints) * 100 : 0;

            // Calculate duration - ensure started_at exists and is valid
            $duration = 0;
            if ($studentModule->started_at) {
                $duration = max(0, now()->diffInSeconds($studentModule->started_at));
            } else {
                // Fallback: use module duration if started_at is missing
                $duration = $studentModule->module->duration * 60;
            }

            $studentModule->update([
                'status' => 'completed',
                'finished_at' => now(),
                'duration_seconds' => $duration,
                'score' => round($score, 2),
                'correct_answers' => $correctAnswers,
                'wrong_answers' => $wrongAnswers,
                'unanswered' => $unanswered,
            ]);

            // Update ranking (simplified - you might want to use a job for this)
            $this->updateRanking($studentModule);

            // Log exam submission
            ActivityLog::logActivity(
                'exam_submitted',
                "User {$studentModule->user->name} menyelesaikan ujian: {$studentModule->module->title} dengan score {$studentModule->score}",
                $studentModule->module,
                [
                    'student_module_id' => $studentModule->id,
                    'score' => $studentModule->score,
                    'correct_answers' => $studentModule->correct_answers,
                    'wrong_answers' => $studentModule->wrong_answers,
                    'duration_seconds' => $studentModule->duration_seconds,
                    'attempt_number' => $studentModule->attempt_number
                ]
            );
        });

        return redirect()->route('exam.result', $studentModule)
            ->with('success', 'Ujian berhasil disubmit!');
    }

    private function updateRanking(StudentModule $studentModule)
    {
        // Update module ranking
        $moduleRankings = StudentModule::where('module_id', $studentModule->module_id)
            ->completed()
            ->orderBy('score', 'desc')
            ->get();

        $rank = 1;
        foreach ($moduleRankings as $sm) {
            \App\Models\Ranking::updateOrCreate(
                [
                    'user_id' => $sm->user_id,
                    'module_id' => $sm->module_id,
                    'ranking_type' => 'module',
                ],
                [
                    'rank' => $rank++,
                    'score' => $sm->score,
                    'average_score' => $sm->score,
                ]
            );
        }

        // Update global ranking
        $user = $studentModule->user;
        $completedModules = StudentModule::where('user_id', $user->id)
            ->completed()
            ->get();

        $avgScore = $completedModules->avg('score');
        $totalCompleted = $completedModules->count();

        $globalRankings = StudentModule::whereIn('user_id', function($query) {
                $query->select('user_id')
                    ->from('student_modules')
                    ->where('status', 'completed')
                    ->groupBy('user_id');
            })
            ->completed()
            ->select('user_id', DB::raw('AVG(score) as avg_score'))
            ->groupBy('user_id')
            ->orderBy('avg_score', 'desc')
            ->get();

        $rank = 1;
        foreach ($globalRankings as $gr) {
            \App\Models\Ranking::updateOrCreate(
                [
                    'user_id' => $gr->user_id,
                    'ranking_type' => 'global',
                ],
                [
                    'rank' => $rank++,
                    'average_score' => $gr->avg_score,
                    'total_modules_completed' => StudentModule::where('user_id', $gr->user_id)
                        ->completed()
                        ->count(),
                ]
            );
        }
    }

    public function result(StudentModule $studentModule)
    {
        if ($studentModule->user_id !== Auth::id()) {
            abort(403);
        }

        // Load module with all questions and options
        $studentModule->load(['module.category']);
        
        // Get all questions from the module with their options
        $questions = Question::where('module_id', $studentModule->module_id)
            ->ordered()
            ->with('options')
            ->get();
        
        // Get all student answers mapped by question_id
        $studentAnswers = StudentAnswer::where('student_module_id', $studentModule->id)
            ->with('selectedOption')
            ->get()
            ->keyBy('question_id');
        
        return view('exam.result', compact('studentModule', 'questions', 'studentAnswers'));
    }
}

