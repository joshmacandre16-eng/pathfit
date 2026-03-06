<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\WelcomeContent;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $coaches = User::where('role', 'coach')->take(4)->get();
        
        // Get dynamic content from database
        $welcomeData = WelcomeContentController::getWelcomeData();

        return view('welcome', compact('coaches', 'welcomeData'));
    }
}
