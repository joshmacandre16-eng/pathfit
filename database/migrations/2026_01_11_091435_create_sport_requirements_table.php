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
        Schema::create('sport_requirements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sport_available_id')->constrained()->onDelete('cascade');
            $table->foreignId('coach_id')->constrained('users')->onDelete('cascade');
            $table->string('sport_name')->nullable(); // For display purposes
            $table->integer('min_height')->nullable(); // in cm
            $table->integer('max_height')->nullable(); // in cm
            $table->integer('min_weight')->nullable(); // in kg
            $table->integer('max_weight')->nullable(); // in kg
            $table->integer('min_age')->nullable();
            $table->integer('max_age')->nullable();
            $table->enum('required_gender', ['male', 'female', 'both'])->default('both');
            $table->integer('min_experience_years')->nullable();
            $table->string('required_level')->nullable(); // beginner, intermediate, advanced, professional
            $table->json('required_positions')->nullable(); // array of positions
            $table->json('preferred_attributes')->nullable(); // array of preferred physical attributes
            $table->json('medical_restrictions')->nullable(); // array of medical conditions that disqualify
            $table->text('additional_notes')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->unique(['sport_available_id', 'coach_id']); // One requirement per sport per coach
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sport_requirements');
    }
};
