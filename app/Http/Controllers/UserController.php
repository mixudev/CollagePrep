<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::withCount(['studentModules', 'rankings'])
            ->latest()
            ->paginate(15);
        
        return view('dashboard.admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('dashboard.admin.users.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'username' => 'required|string|unique:users,username',
            'password' => 'required|string|min:8',
            'role' => 'required|in:admin,student',
            'phone' => 'nullable|string',
            'school' => 'nullable|string',
            'status' => 'required|in:active,inactive',
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $user = User::create($validated);

        // Log user creation
        ActivityLog::logActivity(
            'user_created',
            "Admin membuat user baru: {$user->name} ({$user->email})",
            $user,
            ['role' => $user->role, 'status' => $user->status]
        );

        return redirect()->route('admin.users.index')
            ->with('success', 'User berhasil dibuat.');
    }

    public function edit(User $user)
    {
        return view('dashboard.admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'username' => 'required|string|unique:users,username,' . $user->id,
            'password' => 'nullable|string|min:8',
            'role' => 'required|in:admin,student',
            'phone' => 'nullable|string',
            'school' => 'nullable|string',
            'status' => 'required|in:active,inactive',
        ]);

        if ($request->filled('password')) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $oldData = $user->toArray();
        $user->update($validated);

        // Log user update
        $changes = [];
        foreach ($validated as $key => $value) {
            if (isset($oldData[$key]) && $oldData[$key] != $value && $key !== 'password') {
                $changes[$key] = ['old' => $oldData[$key], 'new' => $value];
            }
        }

        ActivityLog::logActivity(
            'user_updated',
            "Admin memperbarui user: {$user->name} ({$user->email})",
            $user,
            ['changes' => $changes]
        );

        return redirect()->route('admin.users.index')
            ->with('success', 'User berhasil diperbarui.');
    }

    public function destroy(User $user)
    {
        $userName = $user->name;
        $userEmail = $user->email;
        
        // Log user deletion before delete
        ActivityLog::logActivity(
            'user_deleted',
            "Admin menghapus user: {$userName} ({$userEmail})",
            $user,
            ['deleted_user_id' => $user->id]
        );

        $user->delete();
        return redirect()->route('admin.users.index')
            ->with('success', 'User berhasil dihapus.');
    }
}

