<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ActivityReport;
use App\Models\User;

class ActivityReportSeeder extends Seeder
{
    public function run(): void
    {
        $athletes = User::where('role', 'Athlete')->pluck('id')->toArray();
        
        if (empty($athletes)) {
            return; // Skip if no athletes exist
        }

        $reports = [
            [
                'user_id' => $athletes[0] ?? 1,
                'activity_date' => '2024-02-10',
                'activity_type' => 'Basketball Training',
                'duration' => 120,
                'description' => 'Focused on shooting drills and defensive positioning. Improved free throw accuracy by 15%.',
                'performance_rating' => 8,
            ],
            [
                'user_id' => $athletes[1] ?? $athletes[0],
                'activity_date' => '2024-02-11',
                'activity_type' => 'Swimming Practice',
                'duration' => 90,
                'description' => 'Worked on freestyle technique and endurance. Completed 2000m without stopping.',
                'performance_rating' => 9,
            ],
            [
                'user_id' => $athletes[2] ?? $athletes[0],
                'activity_date' => '2024-02-12',
                'activity_type' => 'Football Conditioning',
                'duration' => 150,
                'description' => 'Strength and agility training. Improved sprint times and ball control skills.',
                'performance_rating' => 7,
            ],
            [
                'user_id' => $athletes[3] ?? $athletes[0],
                'activity_date' => '2024-02-13',
                'activity_type' => 'Tennis Match Play',
                'duration' => 180,
                'description' => 'Competitive match practice. Won 2 out of 3 sets with improved serve consistency.',
                'performance_rating' => 8,
            ],
            [
                'user_id' => $athletes[4] ?? $athletes[0],
                'activity_date' => '2024-02-14',
                'activity_type' => 'Track Sprint Training',
                'duration' => 75,
                'description' => 'Speed work and technique refinement. Personal best in 100m sprint.',
                'performance_rating' => 10,
            ],
            [
                'user_id' => $athletes[0] ?? 1,
                'activity_date' => '2024-02-15',
                'activity_type' => 'Volleyball Practice',
                'duration' => 135,
                'description' => 'Team coordination drills and spiking practice. Excellent teamwork displayed.',
                'performance_rating' => 9,
            ],
            [
                'user_id' => $athletes[1] ?? $athletes[0],
                'activity_date' => '2024-02-16',
                'activity_type' => 'Badminton Training',
                'duration' => 100,
                'description' => 'Footwork and racket technique improvement. Better court coverage achieved.',
                'performance_rating' => 7,
            ],
            [
                'user_id' => $athletes[2] ?? $athletes[0],
                'activity_date' => '2024-02-17',
                'activity_type' => 'Boxing Workout',
                'duration' => 110,
                'description' => 'Heavy bag training and sparring session. Improved punch combinations.',
                'performance_rating' => 8,
            ],
            [
                'user_id' => $athletes[3] ?? $athletes[0],
                'activity_date' => '2024-02-18',
                'activity_type' => 'Martial Arts Forms',
                'duration' => 95,
                'description' => 'Traditional forms practice and meditation. Excellent focus and technique.',
                'performance_rating' => 9,
            ],
            [
                'user_id' => $athletes[4] ?? $athletes[0],
                'activity_date' => '2024-02-19',
                'activity_type' => 'Cross Training',
                'duration' => 160,
                'description' => 'Multi-discipline workout combining cardio, strength, and flexibility training.',
                'performance_rating' => 8,
            ]
        ];

        foreach ($reports as $report) {
            ActivityReport::create($report);
        }
    }
}