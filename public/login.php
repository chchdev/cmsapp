<!-- public/login.php -->
 <?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['user_id'])) {
    // User is already logged in, redirect to dashboard or home page
    header('Location: index.php');
    exit();
}

require_once __DIR__ . '/../src/middleware/CsrfMiddleware.php';
$csrfMiddleware = new CsrfMiddleware();
$csrfToken = $csrfMiddleware->generateToken();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel=stylesheet href="assets/css/auth.css">
</head>
<body>
    <div class="auth-container">
        <h2>Login</h2>
        <form action="login.php" method="post">
            <label>Username:
                <input type="text" name="username" required>
            </label>
            <br>
            <label>Password:
                <input type="password" name="password" required>
            </label>
            <br>
            <!-- Add the CSRF token as a hidden input -->
            <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($csrfToken); ?>">
            <input type="submit" value="Login">
        </form>
    </div>
    

    <?php
    // Process login if form is submitted
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        require_once __DIR__ . '/../src/controllers/AuthController.php';
        $auth = new AuthController();
        echo $auth->login();
    }
    ?>
</body>
</html>
