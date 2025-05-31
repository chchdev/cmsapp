<!-- public/login.php -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
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
        <input type="submit" value="Login">
    </form>

    <?php
    // Process login if form is submitted
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        require_once __DIR__ . '/../src/controllers/AuthController.php';
        $auth = new AuthController();
        $auth->login();
    }
    ?>
</body>
</html>
