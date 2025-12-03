<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
    public function index(Request $request)
    {
        $query = ActivityLog::with('user')->latest();

        // Filter by user if provided
        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        // Filter by action if provided
        if ($request->filled('action')) {
            $query->where('action', $request->action);
        }

        // Filter by date range if provided
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $activityLogs = $query->paginate(50);

        // Get unique actions for filter
        $actions = ActivityLog::distinct()->pluck('action')->sort()->values();

        return view('dashboard.admin.activity-logs.index', compact('activityLogs', 'actions'));
    }
}

