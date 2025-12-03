<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Module;
use App\Models\Ranking;
use App\Models\StudentModule;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->isAdmin()) {
            return $this->adminDashboard();
        } else {
            return $this->studentDashboard();
        }
    }

    private function adminDashboard()
    {
        // Basic Stats
        $stats = [
            'total_students' => User::students()->active()->count(),
            'total_modules' => Module::count(),
            'total_completed' => StudentModule::completed()->count(),
            'active_exams' => StudentModule::inProgress()->count(),
            'total_questions' => \App\Models\Question::count(),
            'average_score' => StudentModule::completed()->avg('score') ?? 0,
            'inactive_students' => User::students()->where('status', 'inactive')->count(),
            'total_categories' => Category::count(),
        ];

        // Chart Data - Exam Completion by Month
        $completionByMonth = DB::table('student_modules')
            ->selectRaw('DATE_FORMAT(finished_at, "%Y-%m") as month, COUNT(*) as count')
            ->where('status', 'completed')
            ->where('finished_at', '>=', now()->subMonths(6))
            ->whereNotNull('finished_at')
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Chart Data - Score Distribution
        $scoreDistribution = DB::table('student_modules')
            ->selectRaw('
                CASE 
                    WHEN score >= 90 THEN "90-100"
                    WHEN score >= 80 THEN "80-89"
                    WHEN score >= 70 THEN "70-79"
                    WHEN score >= 60 THEN "60-69"
                    ELSE "0-59"
                END as score_range,
                COUNT(*) as count
            ')
            ->where('status', 'completed')
            ->groupBy('score_range')
            ->orderBy('score_range', 'desc')
            ->get();

        // Chart Data - Performance by Category
        $performanceByCategory = DB::table('student_modules')
            ->join('modules', 'student_modules.module_id', '=', 'modules.id')
            ->join('categories', 'modules.category_id', '=', 'categories.id')
            ->where('student_modules.status', 'completed')
            ->selectRaw('categories.name, AVG(student_modules.score) as avg_score, COUNT(*) as total')
            ->groupBy('categories.id', 'categories.name')
            ->get();

        // Chart Data - Daily Activity (Last 7 days)
        $dailyActivity = DB::table('student_modules')
            ->selectRaw('DATE(finished_at) as date, COUNT(*) as count')
            ->where('status', 'completed')
            ->where('finished_at', '>=', now()->subDays(7))
            ->whereNotNull('finished_at')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Top Performers
        $topPerformers = Ranking::global()
            ->with('user')
            ->topRanks(10)
            ->get();

        // Recent Activity
        $recentActivity = StudentModule::with(['user', 'module'])
            ->whereHas('module') // Ensure module still exists
            ->completed()
            ->latest('finished_at')
            ->limit(10)
            ->get();

        // Module Statistics
        $moduleStats = Module::with('category')
            ->withCount(['studentModules as completed_count' => function($query) {
                $query->where('status', 'completed');
            }])
            ->withAvg('studentModules as avg_score', 'score')
            ->latest()
            ->limit(5)
            ->get();

        // Category Performance
        $categoryStats = Category::withCount(['modules', 'questions'])
            ->with(['modules' => function($query) {
                $query->withCount(['studentModules as completed_count' => function($q) {
                    $q->where('status', 'completed');
                }]);
            }])
            ->get();

        return view('dashboard.admin.index', compact(
            'stats',
            'completionByMonth',
            'scoreDistribution',
            'performanceByCategory',
            'dailyActivity',
            'topPerformers',
            'recentActivity',
            'moduleStats',
            'categoryStats'
        ));
    }

    private function studentDashboard()
    {
        $user = Auth::user();

        // Available modules
        $availableModules = Module::active()
            ->with('category')
            ->get()
            ->filter(function($module) use ($user) {
                $studentModule = StudentModule::where('user_id', $user->id)
                    ->where('module_id', $module->id)
                    ->get();
                
                if ($studentModule->isEmpty()) {
                    return true;
                }
                
                if ($studentModule->where('status', 'in_progress')->isNotEmpty()) {
                    return true;
                }
                
                $completedCount = $studentModule->where('status', 'completed')->count();
                return $completedCount < $module->max_attempts;
            });

        // Statistics
        $completedModules = StudentModule::where('user_id', $user->id)->completed()->get();
        
        $stats = [
            'modules_completed' => $completedModules->count(),
            'average_score' => $completedModules->avg('score') ?? 0,
            'total_attempts' => StudentModule::where('user_id', $user->id)->count(),
            'global_rank' => Ranking::global()
                ->where('user_id', $user->id)
                ->value('rank') ?? 'N/A',
            'total_correct' => $completedModules->sum('correct_answers'),
            'total_wrong' => $completedModules->sum('wrong_answers'),
            'total_unanswered' => $completedModules->sum('unanswered'),
            'best_score' => $completedModules->max('score') ?? 0,
        ];

        // Chart Data - Score Progress Over Time
        $scoreProgress = DB::table('student_modules')
            ->selectRaw('DATE(finished_at) as date, AVG(score) as avg_score')
            ->where('user_id', $user->id)
            ->where('status', 'completed')
            ->where('finished_at', '>=', now()->subDays(30))
            ->whereNotNull('finished_at')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Chart Data - Performance by Category
        $categoryPerformance = DB::table('student_modules')
            ->join('modules', 'student_modules.module_id', '=', 'modules.id')
            ->join('categories', 'modules.category_id', '=', 'categories.id')
            ->where('student_modules.user_id', $user->id)
            ->where('student_modules.status', 'completed')
            ->selectRaw('categories.name, AVG(student_modules.score) as avg_score, COUNT(*) as attempts')
            ->groupBy('categories.id', 'categories.name')
            ->get();

        // Chart Data - Weekly Activity
        $weeklyActivity = DB::table('student_modules')
            ->selectRaw('WEEK(finished_at) as week, COUNT(*) as count')
            ->where('user_id', $user->id)
            ->where('status', 'completed')
            ->where('finished_at', '>=', now()->subWeeks(8))
            ->whereNotNull('finished_at')
            ->groupBy('week')
            ->orderBy('week')
            ->get();

        // Recent Modules
        $myModules = StudentModule::where('user_id', $user->id)
            ->whereHas('module')
            ->with('module.category')
            ->latest()
            ->limit(5)
            ->get();

        // My Rankings
        $myRankings = Ranking::where('user_id', $user->id)
            ->with('module')
            ->latest()
            ->limit(5)
            ->get();

        // Accuracy Trend
        $accuracyTrend = DB::table('student_modules')
            ->selectRaw('
                DATE(finished_at) as date,
                CASE 
                    WHEN SUM(correct_answers) + SUM(wrong_answers) > 0 
                    THEN (SUM(correct_answers) / (SUM(correct_answers) + SUM(wrong_answers))) * 100 
                    ELSE 0 
                END as accuracy
            ')
            ->where('user_id', $user->id)
            ->where('status', 'completed')
            ->where('finished_at', '>=', now()->subDays(30))
            ->whereNotNull('finished_at')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Time Spent Analysis
        $timeAnalysis = DB::table('student_modules')
            ->selectRaw('
                AVG(duration_seconds / 60.0) as avg_minutes,
                MIN(duration_seconds / 60.0) as min_minutes,
                MAX(duration_seconds / 60.0) as max_minutes
            ')
            ->where('user_id', $user->id)
            ->where('status', 'completed')
            ->whereNotNull('duration_seconds')
            ->where('duration_seconds', '>', 0)
            ->first();

        return view('dashboard.student.index', compact(
            'availableModules',
            'stats',
            'scoreProgress',
            'categoryPerformance',
            'weeklyActivity',
            'myModules',
            'myRankings',
            'accuracyTrend',
            'timeAnalysis'
        ));
    }
}
