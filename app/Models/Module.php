<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Module extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'category_id',
        'title',
        'code',
        'description',
        'duration',
        'total_questions',
        'passing_grade',
        'start_date',
        'end_date',
        'is_published',
        'show_ranking',
        'show_answer_after_submit',
        'max_attempts',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'is_published' => 'boolean',
        'show_ranking' => 'boolean',
        'show_answer_after_submit' => 'boolean',
    ];

    // Relationships
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function studentModules()
    {
        return $this->hasMany(StudentModule::class);
    }

    public function rankings()
    {
        return $this->hasMany(Ranking::class);
    }

    public function students()
    {
        return $this->belongsToMany(User::class, 'student_modules')
            ->withPivot(['started_at', 'finished_at', 'score', 'status', 'attempt_number'])
            ->withTimestamps();
    }

    // Scopes
    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    public function scopeActive($query)
    {
        return $query->where('is_published', true)
            ->where(function($q) {
                $q->whereNull('start_date')
                  ->orWhere('start_date', '<=', now());
            })
            ->where(function($q) {
                $q->whereNull('end_date')
                  ->orWhere('end_date', '>=', now());
            });
    }

    // Accessors
    public function getIsActiveAttribute()
    {
        $now = now();
        $isDateActive = (!$this->start_date || $this->start_date <= $now) &&
                       (!$this->end_date || $this->end_date >= $now);
        return $this->is_published && $isDateActive;
    }

    public function getDurationInHoursAttribute()
    {
        return round($this->duration / 60, 2);
    }
}