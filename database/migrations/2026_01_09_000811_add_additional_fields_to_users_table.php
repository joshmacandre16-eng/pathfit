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
            if (!Schema::hasColumn('users', 'fname')) {
                $table->string('fname')->nullable();
            }
            if (!Schema::hasColumn('users', 'mname')) {
                $table->string('mname')->nullable();
            }
            if (!Schema::hasColumn('users', 'lname')) {
                $table->string('lname')->nullable();
            }
            if (!Schema::hasColumn('users', 'course')) {
                $table->string('course')->nullable();
            }
            if (!Schema::hasColumn('users', 'gender')) {
                $table->string('gender')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $columns = ['fname', 'mname', 'lname', 'course', 'gender'];
            $existingColumns = [];
            foreach ($columns as $column) {
                if (Schema::hasColumn('users', $column)) {
                    $existingColumns[] = $column;
                }
            }
            if (!empty($existingColumns)) {
                $table->dropColumn($existingColumns);
            }
        });
    }
};
