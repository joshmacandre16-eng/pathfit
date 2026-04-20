<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Ensure all columns referenced in the User model's $fillable array exist
     * on the users table. Each column is guarded with hasColumn() so this
     * migration is safe to run even when some columns were already created by
     * earlier migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // ── Personal info ────────────────────────────────────────────────
            if (!Schema::hasColumn('users', 'fname')) {
                $table->string('fname')->nullable();
            }
            if (!Schema::hasColumn('users', 'mname')) {
                $table->string('mname')->nullable();
            }
            if (!Schema::hasColumn('users', 'lname')) {
                $table->string('lname')->nullable();
            }
            if (!Schema::hasColumn('users', 'gender')) {
                $table->string('gender')->nullable();
            }
            if (!Schema::hasColumn('users', 'date_of_birth')) {
                $table->date('date_of_birth')->nullable();
            }
            if (!Schema::hasColumn('users', 'age')) {
                $table->integer('age')->nullable();
            }
            if (!Schema::hasColumn('users', 'nationality')) {
                $table->string('nationality')->nullable();
            }
            if (!Schema::hasColumn('users', 'place_of_birth')) {
                $table->string('place_of_birth')->nullable();
            }
            if (!Schema::hasColumn('users', 'current_residence')) {
                $table->string('current_residence')->nullable();
            }
            if (!Schema::hasColumn('users', 'nickname')) {
                $table->string('nickname')->nullable();
            }
            if (!Schema::hasColumn('users', 'photo')) {
                $table->string('photo')->nullable();
            }

            // ── Athletic profile ─────────────────────────────────────────────
            if (!Schema::hasColumn('users', 'course')) {
                $table->string('course')->nullable();
            }
            if (!Schema::hasColumn('users', 'specialization')) {
                $table->string('specialization')->nullable();
            }
            if (!Schema::hasColumn('users', 'experience')) {
                $table->integer('experience')->nullable();
            }
            if (!Schema::hasColumn('users', 'level')) {
                $table->enum('level', ['youth', 'amateur', 'semi-pro', 'professional', 'elite'])->nullable();
            }
            if (!Schema::hasColumn('users', 'primary_sport')) {
                $table->string('primary_sport')->nullable();
            }
            if (!Schema::hasColumn('users', 'discipline_event')) {
                $table->string('discipline_event')->nullable();
            }
            if (!Schema::hasColumn('users', 'position_role')) {
                $table->string('position_role')->nullable();
            }
            if (!Schema::hasColumn('users', 'jersey_number')) {
                $table->integer('jersey_number')->nullable();
            }
            if (!Schema::hasColumn('users', 'years_active')) {
                $table->integer('years_active')->nullable();
            }

            // ── Physical attributes ──────────────────────────────────────────
            if (!Schema::hasColumn('users', 'height')) {
                $table->decimal('height', 5, 2)->nullable(); // cm
            }
            if (!Schema::hasColumn('users', 'weight')) {
                $table->decimal('weight', 5, 2)->nullable(); // kg
            }
            if (!Schema::hasColumn('users', 'wingspan')) {
                $table->decimal('wingspan', 5, 2)->nullable(); // cm
            }
            if (!Schema::hasColumn('users', 'body_fat_percentage')) {
                $table->decimal('body_fat_percentage', 4, 2)->nullable();
            }
            if (!Schema::hasColumn('users', 'dominant_hand')) {
                $table->enum('dominant_hand', ['left', 'right', 'ambidextrous'])->nullable();
            }
            if (!Schema::hasColumn('users', 'dominant_foot')) {
                $table->enum('dominant_foot', ['left', 'right', 'both'])->nullable();
            }

            // ── Team / Club info ─────────────────────────────────────────────
            if (!Schema::hasColumn('users', 'club_team_name')) {
                $table->string('club_team_name')->nullable();
            }
            if (!Schema::hasColumn('users', 'league_federation')) {
                $table->string('league_federation')->nullable();
            }
            if (!Schema::hasColumn('users', 'training_location')) {
                $table->string('training_location')->nullable();
            }
            if (!Schema::hasColumn('users', 'athlete_id')) {
                $table->string('athlete_id')->nullable()->unique();
            }
            if (!Schema::hasColumn('users', 'coach_id')) {
                $table->unsignedBigInteger('coach_id')->nullable();
                $table->foreign('coach_id')->references('id')->on('users')->onDelete('set null');
            }

            // ── Training ─────────────────────────────────────────────────────
            if (!Schema::hasColumn('users', 'strength_conditioning_program')) {
                $table->string('strength_conditioning_program')->nullable();
            }
            if (!Schema::hasColumn('users', 'weekly_training_hours')) {
                $table->integer('weekly_training_hours')->nullable();
            }
            if (!Schema::hasColumn('users', 'secondary_sports')) {
                $table->json('secondary_sports')->nullable();
            }
            if (!Schema::hasColumn('users', 'recovery_methods')) {
                $table->json('recovery_methods')->nullable();
            }

            // ── Performance ──────────────────────────────────────────────────
            if (!Schema::hasColumn('users', 'key_performance_metrics')) {
                $table->json('key_performance_metrics')->nullable();
            }
            if (!Schema::hasColumn('users', 'personal_bests')) {
                $table->json('personal_bests')->nullable();
            }
            if (!Schema::hasColumn('users', 'seasonal_statistics')) {
                $table->json('seasonal_statistics')->nullable();
            }
            if (!Schema::hasColumn('users', 'career_statistics')) {
                $table->json('career_statistics')->nullable();
            }
            if (!Schema::hasColumn('users', 'rankings')) {
                $table->json('rankings')->nullable();
            }
            if (!Schema::hasColumn('users', 'competition_history')) {
                $table->json('competition_history')->nullable();
            }

            // ── Health ───────────────────────────────────────────────────────
            if (!Schema::hasColumn('users', 'injury_history')) {
                $table->json('injury_history')->nullable();
            }
            if (!Schema::hasColumn('users', 'medical_conditions')) {
                $table->json('medical_conditions')->nullable();
            }
            if (!Schema::hasColumn('users', 'current_injuries')) {
                $table->json('current_injuries')->nullable();
            }
            if (!Schema::hasColumn('users', 'rehabilitation_status')) {
                $table->string('rehabilitation_status')->nullable();
            }
            if (!Schema::hasColumn('users', 'last_physical_examination')) {
                $table->date('last_physical_examination')->nullable();
            }
            if (!Schema::hasColumn('users', 'clearance_status')) {
                $table->string('clearance_status')->nullable();
            }

            // ── Achievements ─────────────────────────────────────────────────
            if (!Schema::hasColumn('users', 'certifications')) {
                $table->json('certifications')->nullable();
            }
            if (!Schema::hasColumn('users', 'scholarships_grants')) {
                $table->json('scholarships_grants')->nullable();
            }
            if (!Schema::hasColumn('users', 'medals_awards')) {
                $table->json('medals_awards')->nullable();
            }
            if (!Schema::hasColumn('users', 'records_held')) {
                $table->json('records_held')->nullable();
            }
            if (!Schema::hasColumn('users', 'notable_performances')) {
                $table->json('notable_performances')->nullable();
            }
            if (!Schema::hasColumn('users', 'titles_won')) {
                $table->json('titles_won')->nullable();
            }

            // ── Education ────────────────────────────────────────────────────
            if (!Schema::hasColumn('users', 'education_level')) {
                $table->string('education_level')->nullable();
            }
            if (!Schema::hasColumn('users', 'school_university')) {
                $table->string('school_university')->nullable();
            }

            // ── Other ────────────────────────────────────────────────────────
            if (!Schema::hasColumn('users', 'sports_academies_attended')) {
                $table->json('sports_academies_attended')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     * Only drops columns that were not present in any earlier migration so that
     * rolling back this migration does not destroy data added by those earlier
     * migrations.
     */
    public function down(): void
    {
        // This migration is purely additive / idempotent; rolling it back is a
        // no-op because the columns may have been created by earlier migrations
        // and dropping them here would break those migrations' down() methods.
    }
};
