<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'name' => 'Admin User',
                'fname' => 'Admin',
                'mname' => null,
                'lname' => 'User',
                'course' => 'Administration',
                'gender' => 'male',
                'email' => 'admin@pathfit.com',
                'password' => Hash::make('password123'),
                'role' => 'Admin'
            ],
            [
                'name' => 'Coach Michael Johnson',
                'fname' => 'Michael',
                'mname' => 'James',
                'lname' => 'Johnson',
                'course' => 'Sports Science',
                'gender' => 'male',
                'email' => 'coach.johnson@pathfit.com',
                'password' => Hash::make('password123'),
                'role' => 'Coach'
            ],
            [
                'name' => 'Coach Sarah Williams',
                'fname' => 'Sarah',
                'mname' => 'Marie',
                'lname' => 'Williams',
                'course' => 'Physical Education',
                'gender' => 'female',
                'email' => 'coach.williams@pathfit.com',
                'password' => Hash::make('password123'),
                'role' => 'Coach'
            ],
            [
                'name' => 'John Doe Smith',
                'fname' => 'John',
                'mname' => 'Doe',
                'lname' => 'Smith',
                'course' => 'Computer Science',
                'gender' => 'male',
                'email' => 'john.smith@pathfit.com',
                'password' => Hash::make('password123'),
                'role' => 'Athlete'
            ],
            [
                'name' => 'Emma Rose Davis',
                'fname' => 'Emma',
                'mname' => 'Rose',
                'lname' => 'Davis',
                'course' => 'Business Administration',
                'gender' => 'female',
                'email' => 'emma.davis@pathfit.com',
                'password' => Hash::make('password123'),
                'role' => 'Athlete'
            ],
            [
                'name' => 'Alex Taylor Brown',
                'fname' => 'Alex',
                'mname' => 'Taylor',
                'lname' => 'Brown',
                'course' => 'Engineering',
                'gender' => 'male',
                'email' => 'alex.brown@pathfit.com',
                'password' => Hash::make('password123'),
                'role' => 'Athlete'
            ],
            [
                'name' => 'Lisa Ann Wilson',
                'fname' => 'Lisa',
                'mname' => 'Ann',
                'lname' => 'Wilson',
                'course' => 'Psychology',
                'gender' => 'female',
                'email' => 'lisa.wilson@pathfit.com',
                'password' => Hash::make('password123'),
                'role' => 'Athlete'
            ],
            [
                'name' => 'David Lee Garcia',
                'fname' => 'David',
                'mname' => 'Lee',
                'lname' => 'Garcia',
                'course' => 'Marketing',
                'gender' => 'male',
                'email' => 'david.garcia@pathfit.com',
                'password' => Hash::make('password123'),
                'role' => 'Athlete'
            ],
            [
                'name' => 'Coach Robert Martinez',
                'fname' => 'Robert',
                'mname' => 'Carlos',
                'lname' => 'Martinez',
                'course' => 'Kinesiology',
                'gender' => 'male',
                'email' => 'coach.martinez@pathfit.com',
                'password' => Hash::make('password123'),
                'role' => 'Coach'
            ],
            [
                'name' => 'Sophie Grace Anderson',
                'fname' => 'Sophie',
                'mname' => 'Grace',
                'lname' => 'Anderson',
                'course' => 'Nursing',
                'gender' => 'female',
                'email' => 'sophie.anderson@pathfit.com',
                'password' => Hash::make('password123'),
                'role' => 'Athlete'
            ]
        ];

        foreach ($users as $userData) {
            User::updateOrCreate(
                ['email' => $userData['email']],
                $userData
            );
        }
    }
}