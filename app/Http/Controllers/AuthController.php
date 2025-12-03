<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return view('auth.login');
    }

    public function showRegisterForm()
    {
        // Check if registration is enabled
        $registrationEnabled = \App\Models\Setting::getValue('registration_enabled', true);
        
        if (!$registrationEnabled) {
            abort(403, 'Registrasi tidak tersedia saat ini.');
        }

        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return view('auth.register');
    }

    public function register(Request $request)
    {
        // Check if registration is enabled
        $registrationEnabled = \App\Models\Setting::getValue('registration_enabled', true);
        
        if (!$registrationEnabled) {
            return back()->withErrors([
                'email' => 'Registrasi tidak tersedia saat ini.',
            ]);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => 'student',
            'status' => 'active',
        ]);

        Auth::login($user);

        // Log registration
        ActivityLog::logActivity(
            'register',
            "User {$user->name} ({$user->email}) mendaftar akun baru",
            $user,
            ['role' => $user->role]
        );

        return redirect()->route('dashboard')
            ->with('success', 'Registrasi berhasil! Selamat datang.');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        $remember = $request->filled('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            
            $user = Auth::user();
            
            // Check if user is active
            if ($user->status !== 'active') {
                Auth::logout();
                return back()->withErrors([
                    'email' => 'Akun Anda tidak aktif. Silakan hubungi administrator.',
                ]);
            }

            // Log login
            ActivityLog::logActivity(
                'login',
                "User {$user->name} ({$user->email}) berhasil login",
                $user
            );

            return redirect()->intended(route('dashboard'));
        }

        return back()->withErrors([
            'email' => 'Email atau password yang Anda masukkan salah.',
        ])->withInput($request->only('email'));
    }

    public function logout(Request $request)
    {
        $user = Auth::user();
        
        // Log logout before logout
        if ($user) {
            ActivityLog::logActivity(
                'logout',
                "User {$user->name} ({$user->email}) logout",
                $user
            );
        }

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}

