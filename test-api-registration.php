<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "===========================================\n";
echo "API REGISTRATION TEST\n";
echo "===========================================\n\n";

// Test data
$testData = [
    'fname' => 'API',
    'mname' => 'Test',
    'lname' => 'User',
    'course' => 'Computer Science',
    'gender' => 'male',
    'email' => 'apitest_' . time() . '@example.com',
    'password' => 'Password123!',
    'password_confirmation' => 'Password123!',
];

echo "Testing API Registration Endpoint\n";
echo "-------------------------------------------\n";
echo "POST /api/register\n\n";

// Simulate API request
$request = \Illuminate\Http\Request::create('/api/register', 'POST', $testData);
$request->headers->set('Accept', 'application/json');
$request->headers->set('Content-Type', 'application/json');

try {
    $controller = new \App\Http\Controllers\Api\AuthController();
    $response = $controller->register($request);
    
    $statusCode = $response->getStatusCode();
    $content = json_decode($response->getContent(), true);
    
    echo "Status Code: $statusCode\n";
    echo "Response:\n";
    echo json_encode($content, JSON_PRETTY_PRINT) . "\n\n";
    
    if ($statusCode === 201 && $content['success']) {
        echo "✓ API Registration: SUCCESS\n";
        echo "  User ID: " . $content['data']['user']['id'] . "\n";
        echo "  Email: " . $content['data']['user']['email'] . "\n";
        echo "  Token: " . substr($content['data']['token'], 0, 20) . "...\n\n";
        
        // Verify in database
        $user = \App\Models\User::find($content['data']['user']['id']);
        if ($user) {
            echo "✓ User verified in database\n";
            echo "  Password hashed: " . (strlen($user->password) === 60 ? 'Yes' : 'No') . "\n\n";
            
            // Cleanup
            $user->tokens()->delete();
            $user->delete();
            echo "✓ Test user cleaned up\n\n";
        }
    } else {
        echo "✗ API Registration: FAILED\n";
        echo "  Error: " . ($content['message'] ?? 'Unknown error') . "\n\n";
    }
    
} catch (\Exception $e) {
    echo "✗ Exception: " . $e->getMessage() . "\n";
    echo "  File: " . $e->getFile() . ":" . $e->getLine() . "\n\n";
}

echo "===========================================\n";
echo "API ENDPOINT READY\n";
echo "===========================================\n";
echo "URL: http://localhost:8000/api/register\n";
echo "Method: POST\n";
echo "Headers:\n";
echo "  Content-Type: application/json\n";
echo "  Accept: application/json\n";
echo "\nBody (JSON):\n";
echo json_encode([
    'fname' => 'John',
    'mname' => 'M',
    'lname' => 'Doe',
    'course' => 'Computer Science',
    'gender' => 'male',
    'email' => 'john@example.com',
    'password' => 'password123',
    'password_confirmation' => 'password123'
], JSON_PRETTY_PRINT) . "\n";
echo "===========================================\n";
