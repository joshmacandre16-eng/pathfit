<?php
// Upload to: public/test-manual-register.php
// Visit: https://pathfit.online/test-manual-register.php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "<h1>Manual Registration Test</h1><hr>";

// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo "<h2>Form Submitted!</h2>";
    echo "<h3>Received Data:</h3>";
    echo "<pre>" . print_r($_POST, true) . "</pre>";
    
    try {
        // Simulate RegisterController logic
        $validator = Validator::make($_POST, [
            'fname' => 'required|string|max:255',
            'mname' => 'nullable|string|max:255',
            'lname' => 'required|string|max:255',
            'course' => 'required|string|max:255',
            'gender' => 'required|in:male,female',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);
        
        if ($validator->fails()) {
            echo "<h3 style='color:red;'>Validation Failed:</h3>";
            echo "<pre>" . print_r($validator->errors()->all(), true) . "</pre>";
        } else {
            echo "<h3 style='color:green;'>✓ Validation Passed</h3>";
            
            // Try to create user
            DB::beginTransaction();
            
            $fullName = trim($_POST['fname'] . ' ' . ($_POST['mname'] ?? '') . ' ' . $_POST['lname']);
            
            $userId = DB::table('users')->insertGetId([
                'name' => $fullName,
                'email' => $_POST['email'],
                'password' => Hash::make($_POST['password']),
                'fname' => $_POST['fname'],
                'mname' => $_POST['mname'] ?? null,
                'lname' => $_POST['lname'],
                'course' => $_POST['course'],
                'gender' => $_POST['gender'],
                'role' => 'Athlete',
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            
            DB::commit();
            
            echo "<h3 style='color:green; font-size:20px;'>✓ USER CREATED SUCCESSFULLY!</h3>";
            echo "User ID: <strong>$userId</strong><br>";
            echo "Email: <strong>{$_POST['email']}</strong><br>";
            
            // Verify
            $user = DB::table('users')->where('id', $userId)->first();
            echo "<h3>User Data in Database:</h3>";
            echo "<pre>" . print_r($user, true) . "</pre>";
        }
        
    } catch (Exception $e) {
        DB::rollBack();
        echo "<h3 style='color:red;'>ERROR:</h3>";
        echo "<p><strong>Message:</strong> " . $e->getMessage() . "</p>";
        echo "<pre>" . $e->getTraceAsString() . "</pre>";
    }
    
} else {
    // Show form
    echo "<h2>Fill out this form to test manual registration:</h2>";
    ?>
    <form method="POST" style="max-width:500px;">
        <table>
            <tr>
                <td>First Name:</td>
                <td><input type="text" name="fname" value="Manual" required></td>
            </tr>
            <tr>
                <td>Middle Name:</td>
                <td><input type="text" name="mname" value="Test"></td>
            </tr>
            <tr>
                <td>Last Name:</td>
                <td><input type="text" name="lname" value="User<?php echo time(); ?>" required></td>
            </tr>
            <tr>
                <td>Course:</td>
                <td><input type="text" name="course" value="Test Course" required></td>
            </tr>
            <tr>
                <td>Gender:</td>
                <td>
                    <select name="gender" required>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Email:</td>
                <td><input type="email" name="email" value="manual<?php echo time(); ?>@test.com" required></td>
            </tr>
            <tr>
                <td>Password:</td>
                <td><input type="password" name="password" value="Test1234" required></td>
            </tr>
            <tr>
                <td>Confirm Password:</td>
                <td><input type="password" name="password_confirmation" value="Test1234" required></td>
            </tr>
            <tr>
                <td colspan="2">
                    <button type="submit" style="padding:10px 20px; background:green; color:white; border:none; font-size:16px; cursor:pointer;">
                        Register Test User
                    </button>
                </td>
            </tr>
        </table>
    </form>
    
    <hr>
    <h3>This test will show:</h3>
    <ul>
        <li>If the form data is received correctly</li>
        <li>If validation passes</li>
        <li>If the user is created in the database</li>
        <li>Any errors that occur</li>
    </ul>
    <?php
}
