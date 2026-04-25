<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TrainingSchedule;
use App\Models\User;

class TrainingScheduleSeeder extends Seeder
{
    public function run(): void
    {
        $coaches = User::where('role', 'Coach')->pluck('id')->toArray();
        $athletes = User::where('role', 'Athlete')->pluck('id')->toArray();
        
        if (empty($coaches) || empty($athletes)) {
            return; // Skip if no coaches or athletes exist
        }

        $schedules = [
            [
                'title' => 'Morning Basketball Training',
                'description' => 'Intensive basketball skills training focusing on dribbling, shooting, and team coordination.',
                'date' => '2024-02-15',
                'start_time' => '07:00:00',
                'end_time' => '09:00:00',
                'coach_id' => $coaches[0] ?? null,
                'user_id' => $athletes[0] ?? null,
            ],
            [
                'title' => 'Swimming Technique Session',
                'description' => 'Focus on freestyle and backstroke techniques with endurance building.',
                'date' => '2024-02-16',
                'start_time' => '06:30:00',
                'end_time' => '08:00:00',
                'coach_id' => $coaches[1] ?? $coaches[0],
                'user_id' => $athletes[1] ?? $athletes[0],
            ],
            [
                'title' => 'Football Conditioning',
                'description' => 'Physical conditioning and tactical training for football players.',
                'date' => '2024-02-17',
                'start_time' => '16:00:00',
                'end_time' => '18:00:00',
                'coach_id' => $coaches[0] ?? null,
                'user_id' => $athletes[2] ?? $athletes[0],
            ],
            [
                'title' => 'Tennis Skills Development',
                'description' => 'Serve, volley, and match play training for intermediate players.',
                'date' => '2024-02-18',
                'start_time' => '14:00:00',
                'end_time' => '16:00:00',
                'coach_id' => $coaches[1] ?? $coaches[0],
                'user_id' => $athletes[3] ?? $athletes[0],
            ],
            [
                'title' => 'Track and Field Sprint Training',
                'description' => 'Speed development and sprint technique improvement session.',
                'date' => '2024-02-19',
                'start_time' => '17:00:00',
                'end_time' => '19:00:00',
                'coach_id' => $coaches[2] ?? $coaches[0],
                'user_id' => $athletes[4] ?? $athletes[0],
            ],
            [
                'title' => 'Volleyball Team Practice',
                'description' => 'Team coordination, spiking, and defensive strategies training.',
                'date' => '2024-02-20',
                'start_time' => '18:00:00',
                'end_time' => '20:00:00',
                'coach_id' => $coaches[0] ?? null,
                'user_id' => $athletes[0] ?? null,
            ],
            [
                'title' => 'Badminton Agility Training',
                'description' => 'Footwork, agility, and racket technique improvement.',
                'date' => '2024-02-21',
                'start_time' => '15:00:00',
                'end_time' => '17:00:00',
                'coach_id' => $coaches[1] ?? $coaches[0],
                'user_id' => $athletes[1] ?? $athletes[0],
            ],
            [
                'title' => 'Boxing Fundamentals',
                'description' => 'Basic boxing techniques, footwork, and conditioning.',
                'date' => '2024-02-22',
                'start_time' => '19:00:00',
                'end_time' => '21:00:00',
                'coach_id' => $coaches[2] ?? $coaches[0],
                'user_id' => $athletes[2] ?? $athletes[0],
            ],
            [
                'title' => 'Martial Arts Forms Practice',
                'description' => 'Traditional forms practice and self-defense techniques.',
                'date' => '2024-02-23',
                'start_time' => '08:00:00',
                'end_time' => '10:00:00',
                'coach_id' => $coaches[0] ?? null,
                'user_id' => $athletes[3] ?? $athletes[0],
            ],
            [
                'title' => 'Cross-Training Session',
                'description' => 'Multi-sport training combining various athletic disciplines.',
                'date' => '2024-02-24',
                'start_time' => '10:00:00',
                'end_time' => '12:00:00',
                'coach_id' => $coaches[1] ?? $coaches[0],
                'user_id' => $athletes[4] ?? $athletes[0],
            ]
        ];

        foreach ($schedules as $schedule) {
            if ($schedule['coach_id'] && $schedule['user_id']) {
                TrainingSchedule::create($schedule);
            }
        }
    }
}