<!-- public/register.php -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Register</title>
</head>
<body>
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
        <!-- CSRF token could be added here -->
        <input type="submit" value="Register">
    </form>
    
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
