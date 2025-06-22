<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\ActivityLog;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::check()) {
            return Auth::user()->isAdmin() 
                ? redirect()->route('admin.dashboard')
                : redirect('/');
        }
        
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            $user = Auth::user();
        
            ActivityLog::create([
                'user_id' => $user->id,
                'action' => $user->isAdmin() ? 'admin_login' : 'user_login',
                'description' => 'Login ke sistem',
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);

            $request->session()->regenerate();
            
            if ($user->isAdmin()) {
                return redirect()->intended(route('admin.dashboard'));
            } else {
                return redirect()->intended('/'); 
            }
        }

        return back()->withErrors([
            'email' => 'Email atau password tidak valid.',
        ]);
    }

    public function logout(Request $request)
    {
        $user = Auth::user();
        
        if ($user) {
            ActivityLog::create([
                'user_id' => $user->id,
                'action' => $user->isAdmin() ? 'admin_logout' : 'user_logout',
                'description' => 'Logout dari sistem',
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);
        }

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    public function showCreateAdminForm()
    {
        if (User::where('role', 'admin')->exists()) {
            return redirect()->route('login')->with('error', 'Admin sudah ada.');
        }
        return view('admin.auth.create-admin');
    }

    public function createAdmin(Request $request)
    {
        if (User::where('role', 'admin')->exists()) {
            return redirect()->route('login')->with('error', 'Admin sudah ada.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $admin = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);

        ActivityLog::create([
            'user_id' => $admin->id,
            'action' => 'admin_created',
            'description' => 'Akun admin baru dibuat',
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return redirect()->route('login')->with('success', 'Akun admin berhasil dibuat. Silakan login.');
    }
}