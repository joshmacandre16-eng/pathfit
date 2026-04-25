<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SportAvailable;

class SportAvailableSeeder extends Seeder
{
    public function run(): void
    {
        $sports = [
            [
                'name' => 'Basketball',
                'description' => 'Indoor/outdoor court sport with 5 players per team. Equipment: basketball, hoops, court.'
            ],
            [
                'name' => 'Football',
                'description' => 'Field sport with 11 players per team. Equipment: football, goalposts, field markers.'
            ],
            [
                'name' => 'Swimming',
                'description' => 'Aquatic sport in pool or open water. Equipment: swimwear, goggles, pool access.'
            ],
            [
                'name' => 'Tennis',
                'description' => 'Court sport with rackets and ball. Equipment: tennis racket, balls, court access.'
            ],
            [
                'name' => 'Track and Field',
                'description' => 'Athletic events on track and field. Equipment: running spikes, throwing implements.'
            ],
            [
                'name' => 'Volleyball',
                'description' => 'Net sport with 6 players per team. Equipment: volleyball, net, court.'
            ],
            [
                'name' => 'Badminton',
                'description' => 'Racket sport with shuttlecock. Equipment: badminton racket, shuttlecocks, court.'
            ],
            [
                'name' => 'Table Tennis',
                'description' => 'Indoor paddle sport. Equipment: paddle, ping pong balls, table.'
            ],
            [
                'name' => 'Boxing',
                'description' => 'Combat sport with gloves. Equipment: boxing gloves, protective gear, ring.'
            ],
            [
                'name' => 'Martial Arts',
                'description' => 'Traditional combat arts. Equipment: uniform, protective gear, mats.'
            ]
        ];

        foreach ($sports as $sport) {
            SportAvailable::updateOrCreate(
                ['name' => $sport['name']],
                $sport
            );
        }
    }
}