<?php

namespace App\Http\Controllers;

use App\Models\StudentModule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
    public function index()
    {
        $history = StudentModule::where('user_id', Auth::id())
            ->completed()
            ->with(['module.category'])
            ->latest('finished_at')
            ->paginate(15);

        return view('dashboard.student.history', compact('history'));
    }
}

