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

        // Define role-based access
        $rolePermissions = [
            'admin.dashboard' => ['Administrator'],
            'admin.users.index' => ['Administrator'],
            'admin.users.create' => ['Administrator'],
            'admin.users.store' => ['Administrator'],
            'admin.users.edit' => ['Administrator'],
            'admin.users.update' => ['Administrator'],
            'admin.users.destroy' => ['Administrator'],
            'athlete.dashboard' => ['Athlete'],
            'coach.dashboard' => ['Coach'],
        ];

        if (isset($rolePermissions[$routeName]) && !in_array($user->role, $rolePermissions[$routeName])) {
            Auth::logout();
            return redirect()->route('login')->with('error', 'Unauthorized access.');
        }

        return $next($request);
    }
}
