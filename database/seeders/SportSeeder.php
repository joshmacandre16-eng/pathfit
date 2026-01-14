<?php

namespace Database\Seeders;

use App\Models\SportAvailable;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SportSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SportAvailable::create([
            'name' => 'Basketball',
            'description' => 'Team sport involving shooting a ball through a hoop',
        ]);

        SportAvailable::create([
            'name' => 'Soccer',
            'description' => 'Team sport played with a spherical ball',
        ]);

        SportAvailable::create([
            'name' => 'Tennis',
            'description' => 'Racket sport played individually or in doubles',
        ]);

        SportAvailable::create([
            'name' => 'Swimming',
            'description' => 'Water sport involving various swimming techniques',
        ]);

        SportAvailable::create([
            'name' => 'Volleyball',
            'description' => 'Team sport played by two teams of six players each',
        ]);

        SportAvailable::create([
            'name' => 'Track and Field',
            'description' => 'Sport involving running, jumping, and throwing events',
        ]);
    }
}
