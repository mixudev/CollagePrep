<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentAnswer extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_module_id',
        'question_id',
        'selected_option_id',
        'essay_answer',
        'is_correct',
        'points_earned',
        'time_spent_seconds',
        'is_marked',
    ];

    protected $casts = [
        'is_correct' => 'boolean',
        'is_marked' => 'boolean',
        'points_earned' => 'decimal:2',
    ];

    // Relationships
    public function studentModule()
    {
        return $this->belongsTo(StudentModule::class);
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function selectedOption()
    {
        return $this->belongsTo(QuestionOption::class, 'selected_option_id');
    }

    // Scopes
    public function scopeCorrect($query)
    {
        return $query->where('is_correct', true);
    }

    public function scopeWrong($query)
    {
        return $query->where('is_correct', false);
    }

    public function scopeMarked($query)
    {
        return $query->where('is_marked', true);
    }
}