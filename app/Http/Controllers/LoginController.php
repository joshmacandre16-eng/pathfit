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

        if (Auth::attempt($request->only('email', 'password'), $request->filled('remember'))) {
            $request->session()->regenerate();
            $user = Auth::user();

            // Redirect based on role
            switch ($user->role) {
                case 'Administrator':
                    return redirect()->intended(route('admin.dashboard'))->with('success', 'Welcome back, Administrator!');
                case 'Athlete':
                    return redirect()->intended(route('athlete.dashboard'))->with('success', 'Welcome back, ' . $user->fname . '!');
                case 'Coach':
                    return redirect()->intended(route('coach.dashboard'))->with('success', 'Welcome back, Coach ' . $user->lname . '!');
                default:
                    Auth::logout();
                    $request->session()->invalidate();
                    $request->session()->regenerateToken();
                    return redirect()->route('login')->with('error', 'Unauthorized role. Please contact administrator.');
            }
        }

        return redirect()->back()->withInput($request->only('email'))->with('error', 'Invalid email or password. Please try again.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('success', 'Logged out successfully.');
    }
}
