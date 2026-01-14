<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Redirect based on role
        switch ($user->role) {
            case 'Administrator':
                return redirect()->route('admin.dashboard');
            case 'Athlete':
                return redirect()->route('athlete.dashboard');
            case 'Coach':
                return redirect()->route('coach.dashboard');
            default:
                Auth::logout();
                return redirect('/')->with('error', 'Unauthorized role.');
        }
    }
}
