<?php

echo "Completing PathFit Database Seeding...\n";
echo "Adding remaining tables: Messages, Session Schedules, and Sport Requirements.\n\n";

try {
    $pdo = new PDO('sqlite:database/database.sqlite');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Get user IDs for relationships
    $coaches = $pdo->query("SELECT id FROM users WHERE role = 'Coach'")->fetchAll(PDO::FETCH_COLUMN);
    $athletes = $pdo->query("SELECT id FROM users WHERE role = 'Athlete'")->fetchAll(PDO::FETCH_COLUMN);
    $sports = $pdo->query("SELECT id FROM sport_availables")->fetchAll(PDO::FETCH_COLUMN);
    
    // 6. Seed Messages
    echo "Seeding Messages... ";
    $messages = [
        [$coaches[0] ?? 1, $athletes[0] ?? 2, 'Great job in today\'s basketball training! Your shooting form has improved significantly.', 0],
        [$athletes[0] ?? 2, $coaches[0] ?? 1, 'Thank you coach! I\'ve been practicing the drills you showed me. When is our next session?', 1],
        [$coaches[1] ?? 1, $athletes[1] ?? 2, 'Remember to focus on your breathing technique during swimming. It will help with your endurance.', 0],
        [$athletes[2] ?? 2, $coaches[0] ?? 1, 'Coach, I won\'t be able to make it to tomorrow\'s football practice due to a family emergency.', 1],
        [$coaches[2] ?? 1, $athletes[3] ?? 2, 'Your tennis serve has gotten much more consistent. Keep up the excellent work!', 0],
        [$athletes[4] ?? 2, $coaches[1] ?? 1, 'I achieved a personal best in the 100m sprint today! Thank you for the training tips.', 1],
        [$coaches[0] ?? 1, $athletes[1] ?? 2, 'Don\'t forget to bring your volleyball knee pads to tomorrow\'s practice session.', 0],
        [$athletes[3] ?? 2, $coaches[2] ?? 1, 'Could we schedule an extra badminton session this week? I want to work on my backhand.', 1],
        [$coaches[1] ?? 1, $athletes[2] ?? 2, 'Your boxing stance has improved dramatically. Focus on keeping your guard up during sparring.', 0],
        [$athletes[0] ?? 2, $coaches[2] ?? 1, 'The martial arts forms you taught me have really helped with my balance and flexibility.', 1]
    ];
    
    $stmt = $pdo->prepare("INSERT INTO messages (sender_id, receiver_id, content, is_read) VALUES (?, ?, ?, ?)");
    foreach ($messages as $message) {
        $stmt->execute($message);
    }
    echo "✓ 10 messages added\n";
    
    // 7. Seed Session Schedules
    echo "Seeding Session Schedules... ";
    $sessions = [
        ['Individual Basketball Coaching', 'One-on-one basketball skills development session focusing on shooting and ball handling.', '2024-02-25', '09:00:00', '10:30:00', $coaches[0] ?? 1, $athletes[0] ?? 2, 90, 'scheduled', 'Focus on free throw consistency and defensive positioning.'],
        ['Swimming Technique Session', 'Personal swimming coaching to improve stroke technique and breathing.', '2024-02-26', '07:00:00', '08:00:00', $coaches[1] ?? 1, $athletes[1] ?? 2, 60, 'scheduled', 'Work on freestyle and backstroke techniques.'],
        ['Football Skills Training', 'Individual football coaching session for skill development.', '2024-02-27', '16:30:00', '18:00:00', $coaches[0] ?? 1, $athletes[2] ?? 2, 90, 'completed', 'Excellent progress in ball control and passing accuracy.'],
        ['Tennis Match Preparation', 'Intensive tennis coaching to prepare for upcoming tournament.', '2024-02-28', '14:00:00', '16:00:00', $coaches[2] ?? 1, $athletes[3] ?? 2, 120, 'scheduled', 'Focus on serve consistency and match strategy.'],
        ['Sprint Training Session', 'Track and field sprint technique and speed development.', '2024-03-01', '17:00:00', '18:30:00', $coaches[1] ?? 1, $athletes[4] ?? 2, 90, 'scheduled', 'Work on starting blocks and acceleration phase.'],
        ['Volleyball Skills Development', 'Individual volleyball coaching for spiking and serving improvement.', '2024-03-02', '11:00:00', '12:30:00', $coaches[0] ?? 1, $athletes[0] ?? 2, 90, 'completed', 'Great improvement in spike timing and accuracy.'],
        ['Badminton Agility Training', 'Focused badminton session on footwork and court movement.', '2024-03-03', '15:00:00', '16:00:00', $coaches[2] ?? 1, $athletes[1] ?? 2, 60, 'scheduled', 'Concentrate on quick directional changes and racket positioning.'],
        ['Boxing Fundamentals', 'Basic boxing technique and conditioning session.', '2024-03-04', '19:00:00', '20:30:00', $coaches[1] ?? 1, $athletes[2] ?? 2, 90, 'scheduled', 'Focus on proper stance, jab, and cross techniques.'],
        ['Martial Arts Forms Practice', 'Traditional martial arts forms and self-defense techniques.', '2024-03-05', '08:00:00', '09:30:00', $coaches[0] ?? 1, $athletes[3] ?? 2, 90, 'completed', 'Excellent form execution and mental focus demonstrated.'],
        ['Cross-Training Session', 'Multi-discipline training combining various sports elements.', '2024-03-06', '10:00:00', '11:30:00', $coaches[2] ?? 1, $athletes[4] ?? 2, 90, 'scheduled', 'Combine cardio, strength, and flexibility training elements.']
    ];
    
    $stmt = $pdo->prepare("INSERT INTO session_schedules (title, description, date, start_time, end_time, coach_id, athlete_id, duration, status, notes) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    foreach ($sessions as $session) {
        $stmt->execute($session);
    }
    echo "✓ 10 session schedules added\n";
    
    // 8. Seed Sport Requirements
    echo "Seeding Sport Requirements... ";
    $requirements = [
        [$coaches[0] ?? 1, $sports[0] ?? 1, 16, 25, null, 160.0, 220.0, 50.0, 120.0, 0, 'beginner', '["Point Guard", "Shooting Guard", "Center"]', '["No heart conditions", "No knee injuries"]', 1],
        [$coaches[1] ?? 1, $sports[1] ?? 1, 18, 30, 'male', 165.0, 200.0, 60.0, 100.0, 1, 'intermediate', '["Forward", "Midfielder", "Defender", "Goalkeeper"]', '["No concussion history", "No ankle injuries"]', 1],
        [$coaches[0] ?? 1, $sports[2] ?? 1, 14, 35, null, 150.0, 200.0, 40.0, 90.0, 0, 'beginner', '["Freestyle", "Backstroke", "Breaststroke", "Butterfly"]', '["No respiratory issues", "Must be able to swim"]', 1],
        [$coaches[2] ?? 1, $sports[3] ?? 1, 12, 40, null, 140.0, 210.0, 35.0, 100.0, 0, 'beginner', '["Singles", "Doubles"]', '["No shoulder injuries", "No wrist problems"]', 1],
        [$coaches[1] ?? 1, $sports[4] ?? 1, 15, 28, null, 150.0, 200.0, 45.0, 85.0, 0, 'beginner', '["Sprints", "Distance", "Jumps", "Throws"]', '["No leg injuries", "Good cardiovascular health"]', 1],
        [$coaches[0] ?? 1, $sports[5] ?? 1, 16, 30, null, 160.0, 210.0, 50.0, 95.0, 0, 'beginner', '["Setter", "Spiker", "Libero", "Middle Blocker"]', '["No finger injuries", "No back problems"]', 1],
        [$coaches[2] ?? 1, $sports[6] ?? 1, 10, 45, null, 130.0, 200.0, 30.0, 90.0, 0, 'beginner', '["Singles", "Doubles", "Mixed Doubles"]', '["No elbow injuries", "Good hand-eye coordination"]', 1],
        [$coaches[1] ?? 1, $sports[7] ?? 1, 8, 50, null, 120.0, 200.0, 25.0, 100.0, 0, 'beginner', '["Offensive", "Defensive", "All-round"]', '["No wrist injuries", "Good reflexes required"]', 1],
        [$coaches[0] ?? 1, $sports[8] ?? 1, 18, 35, null, 150.0, 200.0, 50.0, 120.0, 0, 'beginner', '["Lightweight", "Middleweight", "Heavyweight"]', '["No head injuries", "Medical clearance required"]', 1],
        [$coaches[2] ?? 1, $sports[9] ?? 1, 12, 60, null, 130.0, 200.0, 35.0, 120.0, 0, 'beginner', '["Forms", "Sparring", "Self-Defense"]', '["No joint problems", "Good flexibility preferred"]', 1]
    ];
    
    $stmt = $pdo->prepare("INSERT INTO sport_requirements (coach_id, sport_available_id, min_age, max_age, required_gender, min_height, max_height, min_weight, max_weight, min_experience_years, required_level, required_positions, medical_restrictions, is_active) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    foreach ($requirements as $requirement) {
        $stmt->execute($requirement);
    }
    echo "✓ 10 sport requirements added\n";
    
    echo "\n✅ All database seeding completed successfully!\n";
    
    // Show final summary
    $tables = [
        'users' => 'Users',
        'sport_activities' => 'Sport Activities',
        'sport_availables' => 'Available Sports',
        'training_schedules' => 'Training Schedules',
        'activity_reports' => 'Activity Reports',
        'messages' => 'Messages',
        'session_schedules' => 'Session Schedules',
        'sport_requirements' => 'Sport Requirements'
    ];
    
    echo "\nFinal Database Summary:\n";
    foreach ($tables as $table => $name) {
        $stmt = $pdo->query("SELECT COUNT(*) FROM {$table}");
        $count = $stmt->fetchColumn();
        echo "  {$name}: {$count} records\n";
    }
    
    echo "\n🎯 PathFit Database is now fully populated!\n";
    echo "Ready for testing and development.\n";
    
} catch (Exception $e) {
    echo "✗ Error: " . $e->getMessage() . "\n";
    exit(1);
}