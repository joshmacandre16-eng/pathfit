<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            SportActivitySeeder::class,
            SportAvailableSeeder::class,
            TrainingScheduleSeeder::class,
            ActivityReportSeeder::class,
            MessageSeeder::class,
            SessionScheduleSeeder::class,
            SportRequirementSeeder::class,
            WelcomeContentSeeder::class,
            FooterLinkSeeder::class,
        ]);
    }
}