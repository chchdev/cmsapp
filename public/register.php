<!-- public/register.php -->
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
    <title>Register</title>
    <link rel=stylesheet href="assets/css/auth.css">
</head>
<body>
    <div class="auth-container">
<h2>Register</h2>
        <form action="register.php" method="post">
            <label>Username:
                <input type="text" name="username" required>
            </label>
            <br>
            <label>Email:
                <input type="email" name="email" required>
            </label>
            <br>
            <label>Password:
                <input type="password" name="password" required>
            </label>
            <br>
            <label>Confirm Password:
                <input type="password" name="confirm_password" required>
            </label>
            <br>
            <input type="submit" value="Register">
        </form>
    </div>
    <?php
    // Process registration if form is submitted
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        require_once __DIR__ . '/../src/controllers/AuthController.php';
        $auth = new AuthController();
        $auth->register();
    }
    ?>
</body>
</html>
