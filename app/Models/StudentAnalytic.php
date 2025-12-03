<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentAnalytic extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'total_questions_attempted',
        'total_correct',
        'total_wrong',
        'accuracy_percentage',
        'average_score',
        'total_time_spent_seconds',
        'average_time_per_question',
        'strong_topics',
        'weak_topics',
    ];

    protected $casts = [
        'accuracy_percentage' => 'decimal:2',
        'average_score' => 'decimal:2',
        'average_time_per_question' => 'decimal:2',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Accessors
    public function getTotalTimeInHoursAttribute()
    {
        return round($this->total_time_spent_seconds / 3600, 2);
    }

    public function getPerformanceLevelAttribute()
    {
        if ($this->accuracy_percentage >= 80) return 'excellent';
        if ($this->accuracy_percentage >= 60) return 'good';
        if ($this->accuracy_percentage >= 40) return 'average';
        return 'needs_improvement';
    }
}