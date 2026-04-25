<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Register - PathFit</title>
<style>
* { margin: 0; padding: 0; box-sizing: border-box; }
body { font-family: Arial, sans-serif; background: #0D0F0A; color: #E8EDE0; display: flex; justify-content: center; align-items: center; min-height: 100vh; padding: 20px; }
.container { background: #1E2418; padding: 40px; border-radius: 10px; max-width: 500px; width: 100%; }
h1 { color: #10b981; margin-bottom: 10px; }
.subtitle { color: #8A9480; margin-bottom: 30px; font-size: 14px; }
.form-group { margin-bottom: 20px; }
label { display: block; margin-bottom: 5px; font-size: 12px; color: #8A9480; text-transform: uppercase; }
input, select { width: 100%; padding: 12px; background: #0D0F0A; border: 1px solid #4A5240; border-radius: 5px; color: #E8EDE0; font-size: 14px; }
input:focus, select:focus { outline: none; border-color: #10b981; }
.name-row { display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 10px; }
button { width: 100%; padding: 15px; background: #10b981; color: #0D0F0A; border: none; border-radius: 5px; font-weight: bold; cursor: pointer; font-size: 14px; text-transform: uppercase; }
button:hover { background: #0ea572; }
.alert { padding: 12px; border-radius: 5px; margin-bottom: 20px; font-size: 13px; }
.alert-success { background: rgba(16,185,129,.12); border: 1px solid rgba(16,185,129,.28); color: #10b981; }
.alert-error { background: rgba(255,107,107,.12); border: 1px solid rgba(255,107,107,.28); color: #ff6b6b; }
.link { text-align: center; margin-top: 20px; font-size: 13px; }
.link a { color: #10b981; text-decoration: none; }
.link a:hover { text-decoration: underline; }
.result { background: #0D0F0A; padding: 15px; border-radius: 5px; margin-top: 20px; border: 1px solid #4A5240; }
.result h3 { color: #10b981; margin-bottom: 10px; font-size: 16px; }
.result p { font-size: 13px; margin: 5px 0; }
</style>
</head>
<body>
<div class="container">
<h1>Create Account</h1>
<p class="subtitle">Register for PathFit AI Platform</p>

<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$result = null;
$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        require __DIR__ . '/../vendor/autoload.php';
        $app = require_once __DIR__ . '/../bootstrap/app.php';
        $kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
        $kernel->bootstrap();
        
        // Validate
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
            $error = implode('<br>', $validator->errors()->all());
        } else {
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
            
            $result = [
                'id' => $userId,
                'name' => $fullName,
                'email' => $_POST['email'],
                'role' => 'Athlete'
            ];
        }
        
    } catch (Exception $e) {
        if (isset($userId)) DB::rollBack();
        $error = $e->getMessage();
    }
}
?>

<?php if ($result): ?>
<div class="alert alert-success">
    ✓ Registration successful! User created.
</div>
<div class="result">
    <h3>Account Created</h3>
    <p><strong>ID:</strong> <?= $result['id'] ?></p>
    <p><strong>Name:</strong> <?= $result['name'] ?></p>
    <p><strong>Email:</strong> <?= $result['email'] ?></p>
    <p><strong>Role:</strong> <?= $result['role'] ?></p>
</div>
<div class="link">
    <a href="working-login.php">→ Login Now</a>
</div>
<?php else: ?>

<?php if ($error): ?>
<div class="alert alert-error"><?= $error ?></div>
<?php endif; ?>

<form method="POST">
    <div class="name-row">
        <div class="form-group">
            <label>First Name</label>
            <input type="text" name="fname" value="<?= $_POST['fname'] ?? '' ?>" required>
        </div>
        <div class="form-group">
            <label>Middle</label>
            <input type="text" name="mname" value="<?= $_POST['mname'] ?? '' ?>">
        </div>
        <div class="form-group">
            <label>Last Name</label>
            <input type="text" name="lname" value="<?= $_POST['lname'] ?? '' ?>" required>
        </div>
    </div>
    
    <div class="form-group">
        <label>Course</label>
        <input type="text" name="course" value="<?= $_POST['course'] ?? '' ?>" placeholder="e.g. BS Physical Education" required>
    </div>
    
    <div class="form-group">
        <label>Gender</label>
        <select name="gender" required>
            <option value="">Select gender</option>
            <option value="male" <?= ($_POST['gender'] ?? '') === 'male' ? 'selected' : '' ?>>Male</option>
            <option value="female" <?= ($_POST['gender'] ?? '') === 'female' ? 'selected' : '' ?>>Female</option>
        </select>
    </div>
    
    <div class="form-group">
        <label>Email</label>
        <input type="email" name="email" value="<?= $_POST['email'] ?? '' ?>" required>
    </div>
    
    <div class="form-group">
        <label>Password</label>
        <input type="password" name="password" required>
    </div>
    
    <div class="form-group">
        <label>Confirm Password</label>
        <input type="password" name="password_confirmation" required>
    </div>
    
    <button type="submit">Create Account</button>
</form>

<div class="link">
    Already have an account? <a href="working-login.php">Login</a>
</div>
<?php endif; ?>

</div>
</body>
</html>
