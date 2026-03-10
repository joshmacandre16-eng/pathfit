<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\WelcomeContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WelcomeController extends Controller
{
    public function index()
    {
        $coaches = collect([]);
        $welcomeData = [];
        
        // Try to fetch coaches from database with error handling
        try {
            $coaches = User::where('role', 'coach')->take(4)->get();
        } catch (\Exception $e) {
            Log::warning('Failed to fetch coaches: ' . $e->getMessage());
            // Coaches will remain as empty collection, view has fallback content
        }
        
        // Try to fetch welcome content with error handling
        try {
            $welcomeData = WelcomeContentController::getWelcomeData();
        } catch (\Exception $e) {
            Log::warning('Failed to fetch welcome content: ' . $e->getMessage());
            // WelcomeData will remain as empty array, view has fallback content
        }

        return view('welcome', compact('coaches', 'welcomeData'));
    }
}
