<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('welcome_contents', function (Blueprint $table) {
            $table->id();
            $table->string('section'); // e.g., 'hero', 'features', 'how_it_works', 'coaches', 'cta', 'footer'
            $table->string('key'); // e.g., 'title', 'subtitle', 'description', 'image', 'badge_text'
            $table->string('value')->nullable(); // Text content or image path
            $table->text('content')->nullable(); // Longer content (descriptions)
            $table->integer('order')->default(0); // For ordering items within a section
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('welcome_contents');
    }
};

