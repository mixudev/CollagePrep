<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AchievementController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $achievements = $user->achievements()->withPivot('earned_at')->get();
        
        // Get all available achievements
        $allAchievements = \App\Models\Achievement::all();
        
        return view('dashboard.student.achievements', compact('achievements', 'allAchievements'));
    }
}

