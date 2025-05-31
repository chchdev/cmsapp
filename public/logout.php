<?php
// logout.php

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
</head>
<body>
    <h2>Logout</h2>
    <p>Click the button below to log out.</p>
    <form action="logout.php" method="post">
        <input type="submit" value="Logout">
    </form>
</body>
</html>
