<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $users = User::withCount(['studentModules', 'rankings'])
            ->latest()
            ->paginate(15);
        
        return view('dashboard.admin.roles.index', compact('users'));
    }

    public function updateRole(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|in:admin,student',
            'status' => 'required|in:active,inactive',
        ]);

        $oldRole = $user->role;
        $oldStatus = $user->status;
        
        $user->update([
            'role' => $request->role,
            'status' => $request->status,
        ]);

        // Log role/status update
        $changes = [];
        if ($oldRole != $request->role) {
            $changes['role'] = ['old' => $oldRole, 'new' => $request->role];
        }
        if ($oldStatus != $request->status) {
            $changes['status'] = ['old' => $oldStatus, 'new' => $request->status];
        }

        ActivityLog::logActivity(
            'user_role_updated',
            "Admin mengubah role/status user: {$user->name} ({$user->email})",
            $user,
            ['changes' => $changes]
        );

        return redirect()->route('admin.roles.index')
            ->with('success', 'Role dan status user berhasil diperbarui.');
    }

    public function bulkUpdate(Request $request)
    {
        $request->validate([
            'user_ids' => 'required|array',
            'user_ids.*' => 'exists:users,id',
            'action' => 'required|in:activate,deactivate,make_admin,make_student',
        ]);

        $users = User::whereIn('id', $request->user_ids)->get();

        $actionDescriptions = [
            'activate' => 'mengaktifkan',
            'deactivate' => 'menonaktifkan',
            'make_admin' => 'menjadikan admin',
            'make_student' => 'menjadikan student'
        ];

        foreach ($users as $user) {
            $oldRole = $user->role;
            $oldStatus = $user->status;
            
            switch ($request->action) {
                case 'activate':
                    $user->update(['status' => 'active']);
                    break;
                case 'deactivate':
                    $user->update(['status' => 'inactive']);
                    break;
                case 'make_admin':
                    $user->update(['role' => 'admin']);
                    break;
                case 'make_student':
                    $user->update(['role' => 'student']);
                    break;
            }

            // Log bulk update for each user
            ActivityLog::logActivity(
                'user_bulk_updated',
                "Admin {$actionDescriptions[$request->action]} user: {$user->name} ({$user->email})",
                $user,
                [
                    'action' => $request->action,
                    'old_role' => $oldRole,
                    'old_status' => $oldStatus,
                    'new_role' => $user->role,
                    'new_status' => $user->status
                ]
            );
        }

        return redirect()->route('admin.roles.index')
            ->with('success', count($users) . ' user berhasil diperbarui.');
    }
}

