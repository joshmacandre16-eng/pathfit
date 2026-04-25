<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginAuth
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login to access this page.');
        }

        $user = Auth::user();
        $routeName = $request->route()->getName();

        // Role-based route access control
        if (str_starts_with($routeName, 'admin.') && $user->role !== 'Administrator') {
            return redirect()->route('athlete.dashboard')->with('error', 'Unauthorized access.');
        }

        if (str_starts_with($routeName, 'athlete.') && $user->role !== 'Athlete') {
            return redirect()->route($user->role === 'Administrator' ? 'admin.dashboard' : 'coach.dashboard')
                ->with('error', 'Unauthorized access.');
        }

        if (str_starts_with($routeName, 'coach.') && $user->role !== 'Coach') {
            return redirect()->route($user->role === 'Administrator' ? 'admin.dashboard' : 'athlete.dashboard')
                ->with('error', 'Unauthorized access.');
        }

        return $next($request);
    }
}
