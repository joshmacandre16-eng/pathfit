<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        $credentials = $request->only('email', 'password');
        $remember = $request->filled('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            $user = Auth::user();

            // Redirect based on role
            return match($user->role) {
                'Administrator' => redirect()->intended(route('admin.dashboard'))
                    ->with('success', 'Welcome back, Administrator!'),
                'Athlete' => redirect()->intended(route('athlete.dashboard'))
                    ->with('success', 'Welcome back, ' . $user->fname . '!'),
                'Coach' => redirect()->intended(route('coach.dashboard'))
                    ->with('success', 'Welcome back, Coach ' . $user->lname . '!'),
                default => $this->handleInvalidRole($request)
            };
        }

        return back()->withInput($request->only('email'))
            ->with('error', 'Invalid email or password. Please try again.');
    }

    private function handleInvalidRole(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')
            ->with('error', 'Unauthorized role. Please contact administrator.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('success', 'Logged out successfully.');
    }
}
