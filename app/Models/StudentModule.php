<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentModule extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'module_id',
        'started_at',
        'finished_at',
        'duration_seconds',
        'score',
        'correct_answers',
        'wrong_answers',
        'unanswered',
        'status',
        'attempt_number',
    ];

    protected $casts = [
        'started_at' => 'datetime',
        'finished_at' => 'datetime',
        'score' => 'decimal:2',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function module()
    {
        return $this->belongsTo(Module::class);
    }

    public function answers()
    {
        return $this->hasMany(StudentAnswer::class);
    }

    // Scopes
    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    public function scopeInProgress($query)
    {
        return $query->where('status', 'in_progress');
    }

    // Accessors
    public function getDurationInMinutesAttribute()
    {
        return round($this->duration_seconds / 60, 2);
    }

    public function getAccuracyPercentageAttribute()
    {
        $total = $this->correct_answers + $this->wrong_answers;
        return $total > 0 ? round(($this->correct_answers / $total) * 100, 2) : 0;
    }

    public function getTotalAnsweredAttribute()
    {
        return $this->correct_answers + $this->wrong_answers;
    }
}