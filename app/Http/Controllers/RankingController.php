<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\Ranking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RankingController extends Controller
{
    public function index(Request $request)
    {
        // Always show global ranking
        $rankings = Ranking::global()
            ->with('user')
            ->orderBy('rank')
            ->paginate(20);

        // Get top 3 for podium
        $top3 = Ranking::global()
            ->with('user')
            ->orderBy('rank')
            ->limit(3)
            ->get();

        $userRank = null;

        if (Auth::check() && !Auth::user()->isAdmin()) {
            $userRank = Ranking::global()
                ->where('user_id', Auth::id())
                ->first();
        }

        return view('dashboard.rankings.index', compact('rankings', 'top3', 'userRank'));
    }
}

