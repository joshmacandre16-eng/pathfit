<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SportActivity;

class SportActivitySeeder extends Seeder
{
    public function run(): void
    {
        $activities = [
            [
                'name' => 'Basketball',
                'description' => 'Team sport played on a court with two hoops. Develops coordination, teamwork, and cardiovascular fitness.'
            ],
            [
                'name' => 'Football',
                'description' => 'Popular team sport that builds endurance, strength, and strategic thinking skills.'
            ],
            [
                'name' => 'Swimming',
                'description' => 'Full-body workout that improves cardiovascular health and builds muscle strength.'
            ],
            [
                'name' => 'Tennis',
                'description' => 'Racket sport that enhances hand-eye coordination, agility, and mental focus.'
            ],
            [
                'name' => 'Track and Field',
                'description' => 'Collection of athletic events including running, jumping, and throwing competitions.'
            ],
            [
                'name' => 'Volleyball',
                'description' => 'Team sport that develops jumping ability, quick reflexes, and communication skills.'
            ],
            [
                'name' => 'Badminton',
                'description' => 'Racket sport that improves speed, agility, and precision in movements.'
            ],
            [
                'name' => 'Table Tennis',
                'description' => 'Fast-paced sport that enhances reflexes, concentration, and hand-eye coordination.'
            ],
            [
                'name' => 'Boxing',
                'description' => 'Combat sport that builds strength, endurance, and self-discipline.'
            ],
            [
                'name' => 'Martial Arts',
                'description' => 'Traditional combat practices that develop flexibility, balance, and mental discipline.'
            ]
        ];

        foreach ($activities as $activity) {
            SportActivity::updateOrCreate(
                ['name' => $activity['name']],
                $activity
            );
        }
    }
}