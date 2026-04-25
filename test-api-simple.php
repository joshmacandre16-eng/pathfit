<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make('Illuminate\Contracts\Http\Kernel');

echo "===========================================\n";
echo "API REGISTRATION ENDPOINT TEST\n";
echo "===========================================\n\n";

// Create test request
$testData = [
    'fname' => 'TestAPI',
    'lname' => 'User',
    'course' => 'IT',
    'gender' => 'male',
    'email' => 'apitest' . time() . '@test.com',
    'password' => 'password123',
    'password_confirmation' => 'password123'
];

$request = \Illuminate\Http\Request::create(
    '/api/register',
    'POST',
    [],
    [],
    [],
    ['CONTENT_TYPE' => 'application/json'],
    json_encode($testData)
);

$request->headers->set('Accept', 'application/json');
$request->headers->set('Content-Type', 'application/json');

try {
    $response = $kernel->handle($request);
    $statusCode = $response->getStatusCode();
    $content = $response->getContent();
    $data = json_decode($content, true);
    
    echo "Status Code: $statusCode\n";
    echo "Response:\n";
    echo json_encode($data, JSON_PRETTY_PRINT) . "\n\n";
    
    if ($statusCode === 201 && isset($data['success']) && $data['success']) {
        echo "✓ API REGISTRATION: SUCCESS\n";
        echo "  User ID: " . $data['data']['user']['id'] . "\n";
        echo "  Name: " . $data['data']['user']['name'] . "\n";
        echo "  Email: " . $data['data']['user']['email'] . "\n";
        echo "  Role: " . $data['data']['user']['role'] . "\n";
        echo "  Token: " . substr($data['data']['token'], 0, 30) . "...\n\n";
        
        // Verify in database
        $user = \App\Models\User::find($data['data']['user']['id']);
        if ($user) {
            echo "✓ User stored in database\n";
            echo "  Password hashed: " . (strlen($user->password) === 60 ? 'Yes' : 'No') . "\n\n";
            
            // Cleanup
            $user->tokens()->delete();
            $user->delete();
            echo "✓ Test user cleaned up\n\n";
        }
        
        echo "===========================================\n";
        echo "✓ API REGISTRATION WORKING!\n";
        echo "===========================================\n";
    } else {
        echo "✗ API REGISTRATION FAILED\n";
        if (isset($data['errors'])) {
            echo "Errors:\n";
            print_r($data['errors']);
        }
    }
    
} catch (\Exception $e) {
    echo "✗ ERROR: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . ":" . $e->getLine() . "\n";
}

echo "\n===========================================\n";
echo "API ENDPOINT INFORMATION\n";
echo "===========================================\n";
echo "URL: http://localhost:8000/api/register\n";
echo "Method: POST\n";
echo "Content-Type: application/json\n\n";
echo "Example Request:\n";
echo json_encode($testData, JSON_PRETTY_PRINT) . "\n";
echo "===========================================\n";
