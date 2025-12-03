<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\StudentModule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TryoutController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Get all active and published modules
        $modules = Module::with('category')
            ->published()
            ->active()
            ->latest()
            ->get();

        // Get student's module attempts
        $studentModules = StudentModule::where('user_id', $user->id)
            ->with('module')
            ->get()
            ->groupBy('module_id');

        // Process modules with student data
        $modules = $modules->map(function($module) use ($studentModules, $user) {
            $attempts = $studentModules->get($module->id, collect());
            $completed = $attempts->where('status', 'completed')->count();
            $inProgress = $attempts->where('status', 'in_progress')->first();
            $bestScore = $attempts->where('status', 'completed')->max('score');
            
            $module->attempts_count = $attempts->count();
            $module->completed_count = $completed;
            $module->in_progress = $inProgress;
            $module->best_score = $bestScore;
            $module->can_attempt = $attempts->count() < $module->max_attempts;
            
            return $module;
        });

        return view('dashboard.student.tryout.index', compact('modules'));
    }
}

