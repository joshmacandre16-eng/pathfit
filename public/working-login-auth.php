<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login - PathFit</title>
<style>
* { margin: 0; padding: 0; box-sizing: border-box; }
body { font-family: Arial, sans-serif; background: #0D0F0A; color: #E8EDE0; display: flex; justify-content: center; align-items: center; min-height: 100vh; padding: 20px; }
.container { background: #1E2418; padding: 40px; border-radius: 10px; max-width: 450px; width: 100%; }
h1 { color: #10b981; margin-bottom: 10px; }
.subtitle { color: #8A9480; margin-bottom: 30px; font-size: 14px; }
.form-group { margin-bottom: 20px; }
label { display: block; margin-bottom: 5px; font-size: 12px; color: #8A9480; text-transform: uppercase; }
input { width: 100%; padding: 12px; background: #0D0F0A; border: 1px solid #4A5240; border-radius: 5px; color: #E8EDE0; font-size: 14px; }
input:focus { outline: none; border-color: #10b981; }
button { width: 100%; padding: 15px; background: #10b981; color: #0D0F0A; border: none; border-radius: 5px; font-weight: bold; cursor: pointer; font-size: 14px; text-transform: uppercase; }
button:hover { background: #0ea572; }
.alert { padding: 12px; border-radius: 5px; margin-bottom: 20px; font-size: 13px; }
.alert-success { background: rgba(16,185,129,.12); border: 1px solid rgba(16,185,129,.28); color: #10b981; }
.alert-error { background: rgba(255,107,107,.12); border: 1px solid rgba(255,107,107,.28); color: #ff6b6b; }
.link { text-align: center; margin-top: 20px; font-size: 13px; }
.link a { color: #10b981; text-decoration: none; }
.link a:hover { text-decoration: underline; }
</style>
</head>
<body>
<div class="container">
<h1>Welcome Back</h1>
<p class="subtitle">Login to PathFit AI Platform</p>

<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        require __DIR__ . '/../vendor/autoload.php';
        $app = require_once __DIR__ . '/../bootstrap/app.php';
        $kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
        $kernel->bootstrap();
        
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        
        if (empty($email) || empty($password)) {
            $error = 'Email and password are required.';
        } else {
            // Attempt Laravel authentication
            if (Auth::attempt(['email' => $email, 'password' => $password])) {
                $user = Auth::user();
                
                // Redirect based on role
                switch ($user->role) {
                    case 'Administrator':
                        header('Location: /admin/dashboard');
                        exit;
                    case 'Athlete':
                        header('Location: /athlete/dashboard');
                        exit;
                    case 'Coach':
                        header('Location: /coach/dashboard');
                        exit;
                    default:
                        Auth::logout();
                        $error = 'Unauthorized role. Please contact administrator.';
                }
            } else {
                $error = 'Invalid email or password. Please try again.';
            }
        }
        
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}
?>

<?php if ($error): ?>
<div class="alert alert-error"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>

<form method="POST">
    <div class="form-group">
        <label>Email</label>
        <input type="email" name="email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required>
    </div>
    
    <div class="form-group">
        <label>Password</label>
        <input type="password" name="password" required>
    </div>
    
    <button type="submit">Login</button>
</form>

<div class="link">
    Don't have an account? <a href="working-register.php">Register</a>
</div>

</div>
</body>
</html>
