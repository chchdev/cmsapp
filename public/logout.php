<?php
// logout.php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    // User is not logged in, redirect to login page
    header('Location: login.php');
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    require_once __DIR__ . '/../src/controllers/AuthController.php';
    $auth = new AuthController();
    
    header('Content-Type: application/json');
    echo $auth->logout();
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Logout</title>
    <link rel=stylesheet href="assets/css/auth.css">
</head>
<body>
    <div class="auth-container">
            <h2>Logout</h2>
        <p>Click the button below to log out.</p>
        <form action="logout.php" method="post">
            <input type="submit" value="Logout">
        </form>
    </div>
    
</body>
</html>
