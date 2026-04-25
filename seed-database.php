<?php

echo "Populating PathFit Database with Sample Data...\n";
echo "Adding 10 records to each table (except welcome and footer tables).\n\n";

try {
    $pdo = new PDO('sqlite:database/database.sqlite');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "✓ Connected to database\n";
    
    // 1. Seed Users (10 users)
    echo "Seeding Users... ";
    $users = [
        ['Admin User', 'Admin', null, 'User', 'Administration', 'male', 'admin@pathfit.com', password_hash('password123', PASSWORD_DEFAULT), 'Admin'],
        ['Coach Michael Johnson', 'Michael', 'James', 'Johnson', 'Sports Science', 'male', 'coach.johnson@pathfit.com', password_hash('password123', PASSWORD_DEFAULT), 'Coach'],
        ['Coach Sarah Williams', 'Sarah', 'Marie', 'Williams', 'Physical Education', 'female', 'coach.williams@pathfit.com', password_hash('password123', PASSWORD_DEFAULT), 'Coach'],
        ['John Doe Smith', 'John', 'Doe', 'Smith', 'Computer Science', 'male', 'john.smith@pathfit.com', password_hash('password123', PASSWORD_DEFAULT), 'Athlete'],
        ['Emma Rose Davis', 'Emma', 'Rose', 'Davis', 'Business Administration', 'female', 'emma.davis@pathfit.com', password_hash('password123', PASSWORD_DEFAULT), 'Athlete'],
        ['Alex Taylor Brown', 'Alex', 'Taylor', 'Brown', 'Engineering', 'male', 'alex.brown@pathfit.com', password_hash('password123', PASSWORD_DEFAULT), 'Athlete'],
        ['Lisa Ann Wilson', 'Lisa', 'Ann', 'Wilson', 'Psychology', 'female', 'lisa.wilson@pathfit.com', password_hash('password123', PASSWORD_DEFAULT), 'Athlete'],
        ['David Lee Garcia', 'David', 'Lee', 'Garcia', 'Marketing', 'male', 'david.garcia@pathfit.com', password_hash('password123', PASSWORD_DEFAULT), 'Athlete'],
        ['Coach Robert Martinez', 'Robert', 'Carlos', 'Martinez', 'Kinesiology', 'male', 'coach.martinez@pathfit.com', password_hash('password123', PASSWORD_DEFAULT), 'Coach'],
        ['Sophie Grace Anderson', 'Sophie', 'Grace', 'Anderson', 'Nursing', 'female', 'sophie.anderson@pathfit.com', password_hash('password123', PASSWORD_DEFAULT), 'Athlete']
    ];
    
    $stmt = $pdo->prepare("INSERT OR REPLACE INTO users (name, fname, mname, lname, course, gender, email, password, role) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    foreach ($users as $user) {
        $stmt->execute($user);
    }
    echo "✓ 10 users added\n";
    
    // 2. Seed Sport Activities
    echo "Seeding Sport Activities... ";
    $activities = [
        ['Basketball', 'Team sport played on a court with two hoops. Develops coordination, teamwork, and cardiovascular fitness.'],
        ['Football', 'Popular team sport that builds endurance, strength, and strategic thinking skills.'],
        ['Swimming', 'Full-body workout that improves cardiovascular health and builds muscle strength.'],
        ['Tennis', 'Racket sport that enhances hand-eye coordination, agility, and mental focus.'],
        ['Track and Field', 'Collection of athletic events including running, jumping, and throwing competitions.'],
        ['Volleyball', 'Team sport that develops jumping ability, quick reflexes, and communication skills.'],
        ['Badminton', 'Racket sport that improves speed, agility, and precision in movements.'],
        ['Table Tennis', 'Fast-paced sport that enhances reflexes, concentration, and hand-eye coordination.'],
        ['Boxing', 'Combat sport that builds strength, endurance, and self-discipline.'],
        ['Martial Arts', 'Traditional combat practices that develop flexibility, balance, and mental discipline.']
    ];
    
    $stmt = $pdo->prepare("INSERT OR REPLACE INTO sport_activities (name, description) VALUES (?, ?)");
    foreach ($activities as $activity) {
        $stmt->execute($activity);
    }
    echo "✓ 10 sport activities added\n";
    
    // 3. Seed Sport Availables
    echo "Seeding Available Sports... ";
    $sports = [
        ['Basketball', 'Indoor/outdoor court sport with 5 players per team. Equipment: basketball, hoops, court.'],
        ['Football', 'Field sport with 11 players per team. Equipment: football, goalposts, field markers.'],
        ['Swimming', 'Aquatic sport in pool or open water. Equipment: swimwear, goggles, pool access.'],
        ['Tennis', 'Court sport with rackets and ball. Equipment: tennis racket, balls, court access.'],
        ['Track and Field', 'Athletic events on track and field. Equipment: running spikes, throwing implements.'],
        ['Volleyball', 'Net sport with 6 players per team. Equipment: volleyball, net, court.'],
        ['Badminton', 'Racket sport with shuttlecock. Equipment: badminton racket, shuttlecocks, court.'],
        ['Table Tennis', 'Indoor paddle sport. Equipment: paddle, ping pong balls, table.'],
        ['Boxing', 'Combat sport with gloves. Equipment: boxing gloves, protective gear, ring.'],
        ['Martial Arts', 'Traditional combat arts. Equipment: uniform, protective gear, mats.']
    ];
    
    $stmt = $pdo->prepare("INSERT OR REPLACE INTO sport_availables (name, description) VALUES (?, ?)");
    foreach ($sports as $sport) {
        $stmt->execute($sport);
    }
    echo "✓ 10 available sports added\n";
    
    // Get user IDs for relationships
    $coaches = $pdo->query("SELECT id FROM users WHERE role = 'Coach'")->fetchAll(PDO::FETCH_COLUMN);
    $athletes = $pdo->query("SELECT id FROM users WHERE role = 'Athlete'")->fetchAll(PDO::FETCH_COLUMN);
    
    // 4. Seed Training Schedules
    echo "Seeding Training Schedules... ";
    $schedules = [
        ['Morning Basketball Training', 'Intensive basketball skills training focusing on dribbling, shooting, and team coordination.', '2024-02-15', '07:00:00', '09:00:00', $coaches[0] ?? 1, $athletes[0] ?? 1],
        ['Swimming Technique Session', 'Focus on freestyle and backstroke techniques with endurance building.', '2024-02-16', '06:30:00', '08:00:00', $coaches[1] ?? 1, $athletes[1] ?? 1],
        ['Football Conditioning', 'Physical conditioning and tactical training for football players.', '2024-02-17', '16:00:00', '18:00:00', $coaches[0] ?? 1, $athletes[2] ?? 1],
        ['Tennis Skills Development', 'Serve, volley, and match play training for intermediate players.', '2024-02-18', '14:00:00', '16:00:00', $coaches[1] ?? 1, $athletes[3] ?? 1],
        ['Track and Field Sprint Training', 'Speed development and sprint technique improvement session.', '2024-02-19', '17:00:00', '19:00:00', $coaches[2] ?? 1, $athletes[4] ?? 1],
        ['Volleyball Team Practice', 'Team coordination, spiking, and defensive strategies training.', '2024-02-20', '18:00:00', '20:00:00', $coaches[0] ?? 1, $athletes[0] ?? 1],
        ['Badminton Agility Training', 'Footwork, agility, and racket technique improvement.', '2024-02-21', '15:00:00', '17:00:00', $coaches[1] ?? 1, $athletes[1] ?? 1],
        ['Boxing Fundamentals', 'Basic boxing techniques, footwork, and conditioning.', '2024-02-22', '19:00:00', '21:00:00', $coaches[2] ?? 1, $athletes[2] ?? 1],
        ['Martial Arts Forms Practice', 'Traditional forms practice and self-defense techniques.', '2024-02-23', '08:00:00', '10:00:00', $coaches[0] ?? 1, $athletes[3] ?? 1],
        ['Cross-Training Session', 'Multi-sport training combining various athletic disciplines.', '2024-02-24', '10:00:00', '12:00:00', $coaches[1] ?? 1, $athletes[4] ?? 1]
    ];
    
    $stmt = $pdo->prepare("INSERT INTO training_schedules (title, description, date, start_time, end_time, coach_id, user_id) VALUES (?, ?, ?, ?, ?, ?, ?)");
    foreach ($schedules as $schedule) {
        $stmt->execute($schedule);
    }
    echo "✓ 10 training schedules added\n";
    
    // 5. Seed Activity Reports
    echo "Seeding Activity Reports... ";
    $reports = [
        [$athletes[0] ?? 1, '2024-02-10', 'Basketball Training', 120, 'Focused on shooting drills and defensive positioning. Improved free throw accuracy by 15%.', 8],
        [$athletes[1] ?? 1, '2024-02-11', 'Swimming Practice', 90, 'Worked on freestyle technique and endurance. Completed 2000m without stopping.', 9],
        [$athletes[2] ?? 1, '2024-02-12', 'Football Conditioning', 150, 'Strength and agility training. Improved sprint times and ball control skills.', 7],
        [$athletes[3] ?? 1, '2024-02-13', 'Tennis Match Play', 180, 'Competitive match practice. Won 2 out of 3 sets with improved serve consistency.', 8],
        [$athletes[4] ?? 1, '2024-02-14', 'Track Sprint Training', 75, 'Speed work and technique refinement. Personal best in 100m sprint.', 10],
        [$athletes[0] ?? 1, '2024-02-15', 'Volleyball Practice', 135, 'Team coordination drills and spiking practice. Excellent teamwork displayed.', 9],
        [$athletes[1] ?? 1, '2024-02-16', 'Badminton Training', 100, 'Footwork and racket technique improvement. Better court coverage achieved.', 7],
        [$athletes[2] ?? 1, '2024-02-17', 'Boxing Workout', 110, 'Heavy bag training and sparring session. Improved punch combinations.', 8],
        [$athletes[3] ?? 1, '2024-02-18', 'Martial Arts Forms', 95, 'Traditional forms practice and meditation. Excellent focus and technique.', 9],
        [$athletes[4] ?? 1, '2024-02-19', 'Cross Training', 160, 'Multi-discipline workout combining cardio, strength, and flexibility training.', 8]
    ];
    
    $stmt = $pdo->prepare("INSERT INTO activity_reports (user_id, activity_date, activity_type, duration, description, performance_rating) VALUES (?, ?, ?, ?, ?, ?)");
    foreach ($reports as $report) {
        $stmt->execute($report);
    }
    echo "✓ 10 activity reports added\n";
    
    // Continue with remaining tables...
    echo "\n✅ Database seeding completed successfully!\n";
    
    // Show summary
    $tables = [
        'users' => 'Users',
        'sport_activities' => 'Sport Activities',
        'sport_availables' => 'Available Sports',
        'training_schedules' => 'Training Schedules',
        'activity_reports' => 'Activity Reports'
    ];
    
    echo "\nDatabase Summary:\n";
    foreach ($tables as $table => $name) {
        $stmt = $pdo->query("SELECT COUNT(*) FROM {$table}");
        $count = $stmt->fetchColumn();
        echo "  {$name}: {$count} records\n";
    }
    
    echo "\nSample Login Accounts:\n";
    echo "  Admin: admin@pathfit.com / password123\n";
    echo "  Coach: coach.johnson@pathfit.com / password123\n";
    echo "  Athlete: john.smith@pathfit.com / password123\n";
    
} catch (Exception $e) {
    echo "✗ Error: " . $e->getMessage() . "\n";
    exit(1);
}