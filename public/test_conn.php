<?php
    require_once '../config/Database.php';

    $db = new Database();
    $connection = $db->getConnection();
    if ($connection) {
        echo "Connection successful!";
    } else {
        echo "Connection failed!";
    }
?>