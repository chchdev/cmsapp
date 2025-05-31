<?php
// logout.php

// Process logout when form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    require_once __DIR__ . '/../src/controllers/AuthController.php';
    $auth = new AuthController();
    
    // Optionally, set the header to inform the client that a JSON response is returned
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
        <!-- In a real-world scenario, you would include a CSRF token here -->
        <input type="submit" value="Logout">
    </form>
</body>
</html>
