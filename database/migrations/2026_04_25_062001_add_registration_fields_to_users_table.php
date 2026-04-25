<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'fname')) {
                $table->string('fname')->nullable()->after('name');
            }
            if (!Schema::hasColumn('users', 'mname')) {
                $table->string('mname')->nullable()->after('fname');
            }
            if (!Schema::hasColumn('users', 'lname')) {
                $table->string('lname')->nullable()->after('mname');
            }
            if (!Schema::hasColumn('users', 'course')) {
                $table->string('course')->nullable()->after('lname');
            }
            if (!Schema::hasColumn('users', 'gender')) {
                $table->string('gender')->nullable()->after('course');
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['fname', 'mname', 'lname', 'course', 'gender']);
        });
    }
};
