<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserdashboardController extends Controller
{
    public function user()
    {
        return view('athlete.dashboard');
    }

    public function coach()
    {
        $user = Auth::user();
        $athletes = \App\Models\User::where('coach_id', $user->id)->get();

        // Statistics
        $athletesCount = $athletes->count();
        $upcomingSessions = \App\Models\TrainingSchedule::where('coach_id', $user->id)
            ->where('date', '>=', now()->toDateString())
            ->count();
        $recentActivities = \App\Models\ActivityReport::whereHas('user', function($query) use ($user) {
            $query->where('coach_id', $user->id);
        })->count();
        $messagesCount = 0; // Placeholder, implement if needed

        // Lists
        $upcomingSessionsList = \App\Models\TrainingSchedule::where('coach_id', $user->id)
            ->where('date', '>=', now()->toDateString())
            ->orderBy('date')
            ->get();
        $recentActivitiesList = \App\Models\ActivityReport::whereHas('user', function($query) use ($user) {
            $query->where('coach_id', $user->id);
        })->orderBy('activity_date', 'desc')->get();

        return view('coach.dashboard', compact(
            'athletes',
            'athletesCount',
            'upcomingSessions',
            'recentActivities',
            'messagesCount',
            'upcomingSessionsList',
            'recentActivitiesList'
        ));
    }
}
