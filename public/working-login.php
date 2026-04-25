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
.result { background: #0D0F0A; padding: 20px; border-radius: 5px; margin-top: 20px; border: 1px solid #10b981; }
.result h3 { color: #10b981; margin-bottom: 15px; font-size: 18px; }
.result p { font-size: 14px; margin: 8px 0; }
.result .redirect-btn { display: inline-block; margin-top: 15px; padding: 10px 20px; background: #10b981; color: #0D0F0A; text-decoration: none; border-radius: 5px; font-weight: bold; }
.result .redirect-btn:hover { background: #0ea572; }
</style>
</head>
<body>
<div class="container">
<h1>Welcome Back</h1>
<p class="subtitle">Login to PathFit AI Platform</p>

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
        
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        
        if (empty($email) || empty($password)) {
            $error = 'Email and password are required.';
        } else {
            // Find user
            $user = DB::table('users')->where('email', $email)->first();
            
            if ($user && Hash::check($password, $user->password)) {
                // Login successful
                $dashboardUrl = '';
                $welcomeMsg = '';
                
                switch ($user->role) {
                    case 'Administrator':
                        $dashboardUrl = '/admin/dashboard';
                        $welcomeMsg = 'Welcome back, Administrator!';
                        break;
                    case 'Athlete':
                        $dashboardUrl = '/athlete/dashboard';
                        $welcomeMsg = 'Welcome back, ' . $user->fname . '!';
                        break;
                    case 'Coach':
                        $dashboardUrl = '/coach/dashboard';
                        $welcomeMsg = 'Welcome back, Coach ' . $user->lname . '!';
                        break;
                    default:
                        $error = 'Unauthorized role. Please contact administrator.';
                }
                
                if ($dashboardUrl) {
                    $result = [
                        'user' => $user,
                        'dashboard' => $dashboardUrl,
                        'message' => $welcomeMsg
                    ];
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

<?php if ($result): ?>
<div class="alert alert-success">
    ✓ Login successful!
</div>
<div class="result">
    <h3><?= htmlspecialchars($result['message']) ?></h3>
    <p><strong>Name:</strong> <?= htmlspecialchars($result['user']->name) ?></p>
    <p><strong>Email:</strong> <?= htmlspecialchars($result['user']->email) ?></p>
    <p><strong>Role:</strong> <?= htmlspecialchars($result['user']->role) ?></p>
    <p><strong>Dashboard:</strong> <?= htmlspecialchars($result['dashboard']) ?></p>
    <a href="<?= htmlspecialchars($result['dashboard']) ?>" class="redirect-btn">→ Go to Dashboard</a>
</div>
<div class="link">
    <a href="working-register.php">Create new account</a>
</div>
<?php else: ?>

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
<?php endif; ?>

</div>
</body>
</html>
