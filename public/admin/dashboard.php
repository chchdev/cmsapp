<?php
// public/admin/dashboard.php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if(!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../login.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="en" class="admin-dashboard">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>
    <header id="admin-header">
        <h1>Admin Dashboard</h1>
    </header>

    <nav id="admin-nav">
        <ul class="admin-nav-list">
            <li class="nav-item"><a class="nav-link" href="users.php">Manage Users</a></li>
            <li class="nav-item"><a class="nav-link" href="posts.php">Manage Posts</a></li>
            <li class="nav-item"><a class="nav-link" href="comments.php">Manage Comments</a></li>
            <li class="nav-item"><a class="nav-link" href="categories.php">Manage Categories</a></li>
            <li class="nav-item"><a class="nav-link" href="media.php">Manage Media</a></li>
            <li class="nav-item"><a class="nav-link" href="settings.php">Settings</a></li>
            <li class="nav-item"><a class="nav-link" href="../logout.php">Logout</a></li>
        </ul>
    </nav>

    <section id="admin-content">
        <h2>Welcome, Admin!</h2>
        <p>You can manage users, posts, comments, categories, and media from this dashboard.</p>
        <!-- Further admin functionalities can be added here -->
    </section>

    <footer id="admin-footer">
        <p>&copy; <?php echo date("Y"); ?> CMS Admin. All rights reserved.</p>
    </footer>
</body>
</html>
