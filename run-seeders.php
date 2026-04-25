<?php

echo "Running PathFit Database Seeders...\n";
echo "This will populate all tables with 10 sample records each.\n\n";

try {
    // Include Laravel bootstrap
    require_once 'vendor/autoload.php';
    
    $app = require_once 'bootstrap/app.php';
    $kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
    $kernel->bootstrap();
    
    // Run each seeder individually for better error tracking
    $seeders = [
        'UserSeeder' => 'Users (Admin, Coaches, Athletes)',
        'SportActivitySeeder' => 'Sport Activities',
        'SportAvailableSeeder' => 'Available Sports',
        'TrainingScheduleSeeder' => 'Training Schedules',
        'ActivityReportSeeder' => 'Activity Reports',
        'MessageSeeder' => 'Messages between users',
        'SessionScheduleSeeder' => 'Session Schedules',
        'SportRequirementSeeder' => 'Sport Requirements'
    ];
    
    foreach ($seeders as $seederClass => $description) {
        echo "Running {$seederClass}... ";
        
        $seeder = new ("Database\\Seeders\\{$seederClass}");
        $seeder->run();
        
        echo "✓ {$description} seeded\n";
    }
    
    echo "\n✅ All seeders completed successfully!\n";
    
    // Show summary
    $pdo = new PDO('sqlite:database/database.sqlite');
    
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
    echo "✗ Error running seeders: " . $e->getMessage() . "\n";
    echo "Stack trace: " . $e->getTraceAsString() . "\n";
    exit(1);
}