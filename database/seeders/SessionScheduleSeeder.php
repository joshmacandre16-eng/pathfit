<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SessionSchedule;
use App\Models\User;

class SessionScheduleSeeder extends Seeder
{
    public function run(): void
    {
        $coaches = User::where('role', 'Coach')->pluck('id')->toArray();
        $athletes = User::where('role', 'Athlete')->pluck('id')->toArray();
        
        if (empty($coaches) || empty($athletes)) {
            return; // Skip if no coaches or athletes exist
        }

        $sessions = [
            [
                'title' => 'Individual Basketball Coaching',
                'description' => 'One-on-one basketball skills development session focusing on shooting and ball handling.',
                'date' => '2024-02-25',
                'start_time' => '09:00:00',
                'end_time' => '10:30:00',
                'coach_id' => $coaches[0] ?? null,
                'athlete_id' => $athletes[0] ?? null,
                'duration' => 90,
                'status' => 'scheduled',
                'notes' => 'Focus on free throw consistency and defensive positioning.',
            ],
            [
                'title' => 'Swimming Technique Session',
                'description' => 'Personal swimming coaching to improve stroke technique and breathing.',
                'date' => '2024-02-26',
                'start_time' => '07:00:00',
                'end_time' => '08:00:00',
                'coach_id' => $coaches[1] ?? $coaches[0],
                'athlete_id' => $athletes[1] ?? $athletes[0],
                'duration' => 60,
                'status' => 'scheduled',
                'notes' => 'Work on freestyle and backstroke techniques.',
            ],
            [
                'title' => 'Football Skills Training',
                'description' => 'Individual football coaching session for skill development.',
                'date' => '2024-02-27',
                'start_time' => '16:30:00',
                'end_time' => '18:00:00',
                'coach_id' => $coaches[0] ?? null,
                'athlete_id' => $athletes[2] ?? $athletes[0],
                'duration' => 90,
                'status' => 'completed',
                'notes' => 'Excellent progress in ball control and passing accuracy.',
            ],
            [
                'title' => 'Tennis Match Preparation',
                'description' => 'Intensive tennis coaching to prepare for upcoming tournament.',
                'date' => '2024-02-28',
                'start_time' => '14:00:00',
                'end_time' => '16:00:00',
                'coach_id' => $coaches[2] ?? $coaches[0],
                'athlete_id' => $athletes[3] ?? $athletes[0],
                'duration' => 120,
                'status' => 'scheduled',
                'notes' => 'Focus on serve consistency and match strategy.',
            ],
            [
                'title' => 'Sprint Training Session',
                'description' => 'Track and field sprint technique and speed development.',
                'date' => '2024-03-01',
                'start_time' => '17:00:00',
                'end_time' => '18:30:00',
                'coach_id' => $coaches[1] ?? $coaches[0],
                'athlete_id' => $athletes[4] ?? $athletes[0],
                'duration' => 90,
                'status' => 'scheduled',
                'notes' => 'Work on starting blocks and acceleration phase.',
            ],
            [
                'title' => 'Volleyball Skills Development',
                'description' => 'Individual volleyball coaching for spiking and serving improvement.',
                'date' => '2024-03-02',
                'start_time' => '11:00:00',
                'end_time' => '12:30:00',
                'coach_id' => $coaches[0] ?? null,
                'athlete_id' => $athletes[0] ?? null,
                'duration' => 90,
                'status' => 'completed',
                'notes' => 'Great improvement in spike timing and accuracy.',
            ],
            [
                'title' => 'Badminton Agility Training',
                'description' => 'Focused badminton session on footwork and court movement.',
                'date' => '2024-03-03',
                'start_time' => '15:00:00',
                'end_time' => '16:00:00',
                'coach_id' => $coaches[2] ?? $coaches[0],
                'athlete_id' => $athletes[1] ?? $athletes[0],
                'duration' => 60,
                'status' => 'scheduled',
                'notes' => 'Concentrate on quick directional changes and racket positioning.',
            ],
            [
                'title' => 'Boxing Fundamentals',
                'description' => 'Basic boxing technique and conditioning session.',
                'date' => '2024-03-04',
                'start_time' => '19:00:00',
                'end_time' => '20:30:00',
                'coach_id' => $coaches[1] ?? $coaches[0],
                'athlete_id' => $athletes[2] ?? $athletes[0],
                'duration' => 90,
                'status' => 'scheduled',
                'notes' => 'Focus on proper stance, jab, and cross techniques.',
            ],
            [
                'title' => 'Martial Arts Forms Practice',
                'description' => 'Traditional martial arts forms and self-defense techniques.',
                'date' => '2024-03-05',
                'start_time' => '08:00:00',
                'end_time' => '09:30:00',
                'coach_id' => $coaches[0] ?? null,
                'athlete_id' => $athletes[3] ?? $athletes[0],
                'duration' => 90,
                'status' => 'completed',
                'notes' => 'Excellent form execution and mental focus demonstrated.',
            ],
            [
                'title' => 'Cross-Training Session',
                'description' => 'Multi-discipline training combining various sports elements.',
                'date' => '2024-03-06',
                'start_time' => '10:00:00',
                'end_time' => '11:30:00',
                'coach_id' => $coaches[2] ?? $coaches[0],
                'athlete_id' => $athletes[4] ?? $athletes[0],
                'duration' => 90,
                'status' => 'scheduled',
                'notes' => 'Combine cardio, strength, and flexibility training elements.',
            ]
        ];

        foreach ($sessions as $session) {
            if ($session['coach_id'] && $session['athlete_id']) {
                SessionSchedule::create($session);
            }
        }
    }
}