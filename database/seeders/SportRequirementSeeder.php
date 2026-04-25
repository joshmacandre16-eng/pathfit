<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SportRequirement;
use App\Models\User;
use App\Models\SportAvailable;

class SportRequirementSeeder extends Seeder
{
    public function run(): void
    {
        $coaches = User::where('role', 'Coach')->pluck('id')->toArray();
        $sports = SportAvailable::pluck('id')->toArray();
        
        if (empty($coaches) || empty($sports)) {
            return;
        }

        $requirements = [
            [
                'coach_id' => $coaches[0] ?? 1,
                'sport_available_id' => $sports[0] ?? 1,
                'min_age' => 16,
                'max_age' => 25,
                'required_gender' => 'both',
                'min_height' => 160.0,
                'max_height' => 220.0,
                'min_weight' => 50.0,
                'max_weight' => 120.0,
                'min_experience_years' => 0,
                'required_level' => 'beginner',
                'required_positions' => json_encode(['Point Guard', 'Shooting Guard', 'Center']),
                'medical_restrictions' => json_encode(['No heart conditions', 'No knee injuries']),
                'is_active' => true,
            ],
            [
                'coach_id' => $coaches[1] ?? $coaches[0],
                'sport_available_id' => $sports[1] ?? $sports[0],
                'min_age' => 18,
                'max_age' => 30,
                'required_gender' => 'male',
                'min_height' => 165.0,
                'max_height' => 200.0,
                'min_weight' => 60.0,
                'max_weight' => 100.0,
                'min_experience_years' => 1,
                'required_level' => 'intermediate',
                'required_positions' => json_encode(['Forward', 'Midfielder', 'Defender', 'Goalkeeper']),
                'medical_restrictions' => json_encode(['No concussion history', 'No ankle injuries']),
                'is_active' => true,
            ],
            [
                'coach_id' => $coaches[0] ?? 1,
                'sport_available_id' => $sports[2] ?? $sports[0],
                'min_age' => 14,
                'max_age' => 35,
                'required_gender' => 'both',
                'min_height' => 150.0,
                'max_height' => 200.0,
                'min_weight' => 40.0,
                'max_weight' => 90.0,
                'min_experience_years' => 0,
                'required_level' => 'beginner',
                'required_positions' => json_encode(['Freestyle', 'Backstroke', 'Breaststroke', 'Butterfly']),
                'medical_restrictions' => json_encode(['No respiratory issues', 'Must be able to swim']),
                'is_active' => true,
            ],
            [
                'coach_id' => $coaches[2] ?? $coaches[0],
                'sport_available_id' => $sports[3] ?? $sports[0],
                'min_age' => 12,
                'max_age' => 40,
                'required_gender' => 'both',
                'min_height' => 140.0,
                'max_height' => 210.0,
                'min_weight' => 35.0,
                'max_weight' => 100.0,
                'min_experience_years' => 0,
                'required_level' => 'beginner',
                'required_positions' => json_encode(['Singles', 'Doubles']),
                'medical_restrictions' => json_encode(['No shoulder injuries', 'No wrist problems']),
                'is_active' => true,
            ],
            [
                'coach_id' => $coaches[1] ?? $coaches[0],
                'sport_available_id' => $sports[4] ?? $sports[0],
                'min_age' => 15,
                'max_age' => 28,
                'required_gender' => 'both',
                'min_height' => 150.0,
                'max_height' => 200.0,
                'min_weight' => 45.0,
                'max_weight' => 85.0,
                'min_experience_years' => 0,
                'required_level' => 'beginner',
                'required_positions' => json_encode(['Sprints', 'Distance', 'Jumps', 'Throws']),
                'medical_restrictions' => json_encode(['No leg injuries', 'Good cardiovascular health']),
                'is_active' => true,
            ],
            [
                'coach_id' => $coaches[0] ?? 1,
                'sport_available_id' => $sports[5] ?? $sports[0],
                'min_age' => 16,
                'max_age' => 30,
                'required_gender' => 'both',
                'min_height' => 160.0,
                'max_height' => 210.0,
                'min_weight' => 50.0,
                'max_weight' => 95.0,
                'min_experience_years' => 0,
                'required_level' => 'beginner',
                'required_positions' => json_encode(['Setter', 'Spiker', 'Libero', 'Middle Blocker']),
                'medical_restrictions' => json_encode(['No finger injuries', 'No back problems']),
                'is_active' => true,
            ],
            [
                'coach_id' => $coaches[2] ?? $coaches[0],
                'sport_available_id' => $sports[6] ?? $sports[0],
                'min_age' => 10,
                'max_age' => 45,
                'required_gender' => 'both',
                'min_height' => 130.0,
                'max_height' => 200.0,
                'min_weight' => 30.0,
                'max_weight' => 90.0,
                'min_experience_years' => 0,
                'required_level' => 'beginner',
                'required_positions' => json_encode(['Singles', 'Doubles', 'Mixed Doubles']),
                'medical_restrictions' => json_encode(['No elbow injuries', 'Good hand-eye coordination']),
                'is_active' => true,
            ],
            [
                'coach_id' => $coaches[1] ?? $coaches[0],
                'sport_available_id' => $sports[7] ?? $sports[0],
                'min_age' => 8,
                'max_age' => 50,
                'required_gender' => 'both',
                'min_height' => 120.0,
                'max_height' => 200.0,
                'min_weight' => 25.0,
                'max_weight' => 100.0,
                'min_experience_years' => 0,
                'required_level' => 'beginner',
                'required_positions' => json_encode(['Offensive', 'Defensive', 'All-round']),
                'medical_restrictions' => json_encode(['No wrist injuries', 'Good reflexes required']),
                'is_active' => true,
            ],
            [
                'coach_id' => $coaches[0] ?? 1,
                'sport_available_id' => $sports[8] ?? $sports[0],
                'min_age' => 18,
                'max_age' => 35,
                'required_gender' => 'both',
                'min_height' => 150.0,
                'max_height' => 200.0,
                'min_weight' => 50.0,
                'max_weight' => 120.0,
                'min_experience_years' => 0,
                'required_level' => 'beginner',
                'required_positions' => json_encode(['Lightweight', 'Middleweight', 'Heavyweight']),
                'medical_restrictions' => json_encode(['No head injuries', 'Medical clearance required']),
                'is_active' => true,
            ],
            [
                'coach_id' => $coaches[2] ?? $coaches[0],
                'sport_available_id' => $sports[9] ?? $sports[0],
                'min_age' => 12,
                'max_age' => 60,
                'required_gender' => 'both',
                'min_height' => 130.0,
                'max_height' => 200.0,
                'min_weight' => 35.0,
                'max_weight' => 120.0,
                'min_experience_years' => 0,
                'required_level' => 'beginner',
                'required_positions' => json_encode(['Forms', 'Sparring', 'Self-Defense']),
                'medical_restrictions' => json_encode(['No joint problems', 'Good flexibility preferred']),
                'is_active' => true,
            ]
        ];

        foreach ($requirements as $requirement) {
            SportRequirement::create($requirement);
        }
    }
}
