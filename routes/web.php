<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\RankingController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', function () {
    return view('landing');
})->name('landing');

// Authentication routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Student routes
    Route::middleware('role:student')->group(function () {
        Route::get('/tryout', [\App\Http\Controllers\TryoutController::class, 'index'])->name('tryout.index');
        Route::get('/modules/{module}/exam', [ExamController::class, 'show'])->name('exam.show');
        Route::post('/exam/{studentModule}/answer', [ExamController::class, 'saveAnswer'])->name('exam.save-answer');
        Route::post('/exam/{studentModule}/submit', [ExamController::class, 'submit'])->name('exam.submit');
        Route::get('/exam/{studentModule}/result', [ExamController::class, 'result'])->name('exam.result');
        Route::get('/history', [\App\Http\Controllers\HistoryController::class, 'index'])->name('history.index');
        Route::get('/achievements', [\App\Http\Controllers\AchievementController::class, 'index'])->name('achievements.index');
    });

    // Ranking (accessible by both)
    Route::get('/rankings', [RankingController::class, 'index'])->name('rankings.index');

    // Profile (accessible by both)
    Route::get('/profile', [\App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');

    // Admin routes
    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
        // Users
        Route::get('users', [UserController::class, 'index'])->name('users.index');
        Route::get('users/create', [UserController::class, 'create'])->name('users.create');
        Route::post('users', [UserController::class, 'store'])->name('users.store');
        Route::get('users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('users/{user}', [UserController::class, 'update'])->name('users.update');
        Route::delete('users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

        // Categories
        Route::get('categories', [CategoryController::class, 'index'])->name('categories.index');
        Route::post('categories', [CategoryController::class, 'store'])->name('categories.store');
        Route::put('categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
        Route::delete('categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');

        // Modules
        Route::get('modules', [ModuleController::class, 'index'])->name('modules.index');
        Route::get('modules/create', [ModuleController::class, 'create'])->name('modules.create');
        Route::post('modules', [ModuleController::class, 'store'])->name('modules.store');
        Route::get('modules/{module}', [ModuleController::class, 'show'])->name('modules.show');
        Route::get('modules/{module}/edit', [ModuleController::class, 'edit'])->name('modules.edit');
        Route::put('modules/{module}', [ModuleController::class, 'update'])->name('modules.update');
        Route::delete('modules/{module}', [ModuleController::class, 'destroy'])->name('modules.destroy');

        // Questions
        Route::get('questions/create', [QuestionController::class, 'create'])->name('questions.create');
        Route::post('questions', [QuestionController::class, 'store'])->name('questions.store');
        Route::get('questions/{question}/edit', [QuestionController::class, 'edit'])->name('questions.edit');
        Route::put('questions/{question}', [QuestionController::class, 'update'])->name('questions.update');
        Route::delete('questions/{question}', [QuestionController::class, 'destroy'])->name('questions.destroy');

        // Settings
        Route::get('settings', [\App\Http\Controllers\SettingController::class, 'index'])->name('settings.index');
        Route::put('settings', [\App\Http\Controllers\SettingController::class, 'update'])->name('settings.update');

        // Role Management
        Route::get('roles', [\App\Http\Controllers\RoleController::class, 'index'])->name('roles.index');
        Route::put('roles/{user}', [\App\Http\Controllers\RoleController::class, 'updateRole'])->name('roles.update');
        Route::post('roles/bulk-update', [\App\Http\Controllers\RoleController::class, 'bulkUpdate'])->name('roles.bulk-update');
        
        // Activity Logs
        Route::get('activity-logs', [\App\Http\Controllers\ActivityLogController::class, 'index'])->name('activity-logs.index');
    });
});
