<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\Question;
use App\Models\QuestionOption;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class QuestionController extends Controller
{

    public function create(Request $request)
    {
        $moduleId = $request->module_id;
        if (!$moduleId) {
            return redirect()->route('admin.modules.index')
                ->with('error', 'Pilih modul terlebih dahulu.');
        }
        
        $module = Module::with('category')->findOrFail($moduleId);
        return view('dashboard.admin.questions.create', compact('module'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'module_id' => 'required|exists:modules,id',
            'category_id' => 'required|exists:categories,id',
            'question_text' => 'required|string',
            'question_image' => 'nullable|image|max:2048',
            'type' => 'required|in:multiple_choice,true_false',
            'points' => 'required|numeric|min:0',
            'difficulty' => 'required|in:easy,medium,hard',
            'explanation' => 'nullable|string',
            'order' => 'nullable|integer',
            'is_active' => 'boolean',
            'correct_option' => 'required_if:type,multiple_choice|integer',
            'true_false_answer' => 'required_if:type,true_false|in:true,false',
        ]);

        // Handle image upload
        if ($request->hasFile('question_image')) {
            $validated['question_image'] = $request->file('question_image')->store('questions', 'public');
        }

        $question = Question::create($validated);

        // Update module's total_questions count
        $module = Module::find($question->module_id);
        $module->update([
            'total_questions' => $module->questions()->count()
        ]);

        // Create options for multiple choice
        if ($request->type === 'multiple_choice' && $request->has('options')) {
            $correctOptionIndex = $request->input('correct_option');
            foreach ($request->options as $index => $optionData) {
                if (!empty($optionData['option_text'])) {
                    QuestionOption::create([
                        'question_id' => $question->id,
                        'option_label' => $optionData['option_label'],
                        'option_text' => $optionData['option_text'],
                        'is_correct' => $index == $correctOptionIndex,
                    ]);
                }
            }
        }
        
        // Create options for true/false
        if ($request->type === 'true_false') {
            $isTrue = $request->input('true_false_answer') === 'true';
            QuestionOption::create([
                'question_id' => $question->id,
                'option_label' => 'A',
                'option_text' => 'Benar',
                'is_correct' => $isTrue,
            ]);
            QuestionOption::create([
                'question_id' => $question->id,
                'option_label' => 'B',
                'option_text' => 'Salah',
                'is_correct' => !$isTrue,
            ]);
        }

        // Log question creation
        ActivityLog::logActivity(
            'question_created',
            "Admin membuat soal baru untuk modul: {$module->title}",
            $question,
            ['module_id' => $question->module_id, 'type' => $question->type, 'difficulty' => $question->difficulty]
        );

        return redirect()->route('admin.modules.show', $question->module_id)
            ->with('success', 'Soal berhasil dibuat.');
    }

    public function edit(Question $question)
    {
        $question->load(['options', 'module.category']);
        return view('dashboard.admin.questions.edit', compact('question'));
    }

    public function update(Request $request, Question $question)
    {
        $validated = $request->validate([
            'module_id' => 'required|exists:modules,id',
            'category_id' => 'required|exists:categories,id',
            'question_text' => 'required|string',
            'question_image' => 'nullable|image|max:2048',
            'type' => 'required|in:multiple_choice,true_false',
            'points' => 'required|numeric|min:0',
            'difficulty' => 'required|in:easy,medium,hard',
            'explanation' => 'nullable|string',
            'order' => 'nullable|integer',
            'is_active' => 'boolean',
            'correct_option' => 'required_if:type,multiple_choice|integer',
            'true_false_answer' => 'required_if:type,true_false|in:true,false',
        ]);

        // Handle image upload
        if ($request->hasFile('question_image')) {
            $validated['question_image'] = $request->file('question_image')->store('questions', 'public');
        }

        $question->update($validated);

        // Update module's total_questions count
        $module = Module::find($question->module_id);
        $module->update([
            'total_questions' => $module->questions()->count()
        ]);

        // Update options
        if ($request->type === 'multiple_choice' && $request->has('options')) {
            $correctOptionIndex = $request->input('correct_option');
            $question->options()->delete();
            foreach ($request->options as $index => $optionData) {
                if (!empty($optionData['option_text'])) {
                    QuestionOption::create([
                        'question_id' => $question->id,
                        'option_label' => $optionData['option_label'],
                        'option_text' => $optionData['option_text'],
                        'is_correct' => $index == $correctOptionIndex,
                    ]);
                }
            }
        }
        
        // Update options for true/false
        if ($request->type === 'true_false') {
            $isTrue = $request->input('true_false_answer') === 'true';
            $question->options()->delete();
            QuestionOption::create([
                'question_id' => $question->id,
                'option_label' => 'A',
                'option_text' => 'Benar',
                'is_correct' => $isTrue,
            ]);
            QuestionOption::create([
                'question_id' => $question->id,
                'option_label' => 'B',
                'option_text' => 'Salah',
                'is_correct' => !$isTrue,
            ]);
        }

        // Log question update
        ActivityLog::logActivity(
            'question_updated',
            "Admin memperbarui soal untuk modul: {$module->title}",
            $question,
            ['module_id' => $question->module_id, 'type' => $question->type]
        );

        return redirect()->route('admin.modules.show', $question->module_id)
            ->with('success', 'Soal berhasil diperbarui.');
    }

    public function destroy(Question $question)
    {
        $moduleId = $question->module_id;
        $module = Module::find($moduleId);
        
        // Log question deletion before delete
        ActivityLog::logActivity(
            'question_deleted',
            "Admin menghapus soal dari modul: {$module->title}",
            $question,
            ['module_id' => $moduleId, 'deleted_question_id' => $question->id]
        );

        $question->delete();
        
        // Update module's total_questions count
        $module->update([
            'total_questions' => $module->questions()->count()
        ]);
        
        return redirect()->route('admin.modules.show', $moduleId)
            ->with('success', 'Soal berhasil dihapus.');
    }
}

