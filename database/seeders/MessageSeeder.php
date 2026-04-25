<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Message;
use App\Models\User;

class MessageSeeder extends Seeder
{
    public function run(): void
    {
        $coaches = User::where('role', 'Coach')->pluck('id')->toArray();
        $athletes = User::where('role', 'Athlete')->pluck('id')->toArray();
        
        if (empty($coaches) || empty($athletes)) {
            return; // Skip if no coaches or athletes exist
        }

        $messages = [
            [
                'sender_id' => $coaches[0] ?? 1,
                'receiver_id' => $athletes[0] ?? 2,
                'content' => 'Great job in today\'s basketball training! Your shooting form has improved significantly.',
                'is_read' => false,
            ],
            [
                'sender_id' => $athletes[0] ?? 2,
                'receiver_id' => $coaches[0] ?? 1,
                'content' => 'Thank you coach! I\'ve been practicing the drills you showed me. When is our next session?',
                'is_read' => true,
            ],
            [
                'sender_id' => $coaches[1] ?? $coaches[0],
                'receiver_id' => $athletes[1] ?? $athletes[0],
                'content' => 'Remember to focus on your breathing technique during swimming. It will help with your endurance.',
                'is_read' => false,
            ],
            [
                'sender_id' => $athletes[2] ?? $athletes[0],
                'receiver_id' => $coaches[0] ?? 1,
                'content' => 'Coach, I won\'t be able to make it to tomorrow\'s football practice due to a family emergency.',
                'is_read' => true,
            ],
            [
                'sender_id' => $coaches[2] ?? $coaches[0],
                'receiver_id' => $athletes[3] ?? $athletes[0],
                'content' => 'Your tennis serve has gotten much more consistent. Keep up the excellent work!',
                'is_read' => false,
            ],
            [
                'sender_id' => $athletes[4] ?? $athletes[0],
                'receiver_id' => $coaches[1] ?? $coaches[0],
                'content' => 'I achieved a personal best in the 100m sprint today! Thank you for the training tips.',
                'is_read' => true,
            ],
            [
                'sender_id' => $coaches[0] ?? 1,
                'receiver_id' => $athletes[1] ?? $athletes[0],
                'content' => 'Don\'t forget to bring your volleyball knee pads to tomorrow\'s practice session.',
                'is_read' => false,
            ],
            [
                'sender_id' => $athletes[3] ?? $athletes[0],
                'receiver_id' => $coaches[2] ?? $coaches[0],
                'content' => 'Could we schedule an extra badminton session this week? I want to work on my backhand.',
                'is_read' => true,
            ],
            [
                'sender_id' => $coaches[1] ?? $coaches[0],
                'receiver_id' => $athletes[2] ?? $athletes[0],
                'content' => 'Your boxing stance has improved dramatically. Focus on keeping your guard up during sparring.',
                'is_read' => false,
            ],
            [
                'sender_id' => $athletes[0] ?? 2,
                'receiver_id' => $coaches[2] ?? $coaches[0],
                'content' => 'The martial arts forms you taught me have really helped with my balance and flexibility.',
                'is_read' => true,
            ]
        ];

        foreach ($messages as $message) {
            Message::create($message);
        }
    }
}