<?php

namespace Database\Seeders;

use App\Models\SportActivity;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SportActivitySeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SportActivity::create([
            'name' => 'Running',
            'description' => 'Cardiovascular exercise involving sustained running at various paces',
        ]);

        SportActivity::create([
            'name' => 'Weightlifting',
            'description' => 'Strength training using free weights or machines to build muscle mass',
        ]);

        SportActivity::create([
            'name' => 'Yoga',
            'description' => 'Physical and mental practice involving body postures and breathing techniques',
        ]);

        SportActivity::create([
            'name' => 'Cycling',
            'description' => 'Cardiovascular exercise using a bicycle for transportation or recreation',
        ]);

        SportActivity::create([
            'name' => 'Swimming',
            'description' => 'Full-body workout performed in water using various swimming strokes',
        ]);

        SportActivity::create([
            'name' => 'HIIT',
            'description' => 'High-Intensity Interval Training combining short bursts of intense exercise with recovery periods',
        ]);

        SportActivity::create([
            'name' => 'Pilates',
            'description' => 'Low-impact exercise method focusing on core strength, flexibility, and muscle control',
        ]);

        SportActivity::create([
            'name' => 'CrossFit',
            'description' => 'High-intensity fitness program incorporating elements from several sports and types of exercise',
        ]);

        SportActivity::create([
            'name' => 'Boxing',
            'description' => 'Combat sport and martial art involving punching techniques and footwork',
        ]);

        SportActivity::create([
            'name' => 'Dancing',
            'description' => 'Rhythmic movement to music, including various dance styles for fitness and expression',
        ]);
    }
}
