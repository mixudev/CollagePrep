<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ranking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'module_id',
        'ranking_type',
        'rank',
        'score',
        'average_score',
        'total_modules_completed',
    ];

    protected $casts = [
        'score' => 'decimal:2',
        'average_score' => 'decimal:2',
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

    // Scopes
    public function scopeGlobal($query)
    {
        return $query->where('ranking_type', 'global');
    }

    public function scopeModule($query)
    {
        return $query->where('ranking_type', 'module');
    }

    public function scopeByModule($query, $moduleId)
    {
        return $query->where('module_id', $moduleId);
    }

    public function scopeTopRanks($query, $limit = 10)
    {
        return $query->orderBy('rank')->limit($limit);
    }
}
