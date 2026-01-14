<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Basic Information
            $table->string('athlete_id')->nullable()->unique();
            $table->string('nickname')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->integer('age')->nullable();
            $table->string('nationality')->nullable();
            $table->string('place_of_birth')->nullable();
            $table->string('current_residence')->nullable();

            // Physical Attributes
            $table->decimal('height', 5, 2)->nullable(); // in cm
            $table->decimal('weight', 5, 2)->nullable(); // in kg
            $table->decimal('wingspan', 5, 2)->nullable(); // in cm
            $table->decimal('body_fat_percentage', 4, 2)->nullable();
            $table->enum('dominant_hand', ['left', 'right', 'ambidextrous'])->nullable();
            $table->enum('dominant_foot', ['left', 'right', 'both'])->nullable();
            $table->string('position_role')->nullable();
            $table->integer('jersey_number')->nullable();

            // Sport Details
            $table->string('primary_sport')->nullable();
            $table->json('secondary_sports')->nullable(); // array of sports
            $table->string('discipline_event')->nullable();
            $table->enum('level', ['youth', 'amateur', 'semi-pro', 'professional', 'elite'])->nullable();
            $table->integer('years_active')->nullable();
            $table->string('club_team_name')->nullable();
            $table->string('league_federation')->nullable();

            // Performance & Statistics
            $table->json('key_performance_metrics')->nullable();
            $table->json('personal_bests')->nullable();
            $table->json('seasonal_statistics')->nullable();
            $table->json('career_statistics')->nullable();
            $table->json('rankings')->nullable();
            $table->json('competition_history')->nullable();

            // Training Information
            $table->string('training_location')->nullable();
            $table->string('strength_conditioning_program')->nullable();
            $table->integer('weekly_training_hours')->nullable();
            $table->json('recovery_methods')->nullable();

            // Medical & Health (Restricted Access)
            $table->json('injury_history')->nullable();
            $table->json('current_injuries')->nullable();
            $table->json('medical_conditions')->nullable();
            $table->string('rehabilitation_status')->nullable();
            $table->date('last_physical_examination')->nullable();
            $table->string('clearance_status')->nullable();

            // Achievements & Honors
            $table->json('titles_won')->nullable();
            $table->json('medals_awards')->nullable();
            $table->json('records_held')->nullable();
            $table->json('notable_performances')->nullable();
            $table->json('scholarships_grants')->nullable();

            // Education & Background
            $table->string('education_level')->nullable();
            $table->string('school_university')->nullable();
            $table->json('sports_academies_attended')->nullable();
            $table->json('certifications')->nullable();

            // Media & Branding
            $table->string('profile_photo')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
