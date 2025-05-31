<?php

require_once 'Database.php';

class Setup {
    private $config;

    public function __construct() {
        $this->config = require 'config.php';
    }
    
    public function createTables() {
        $db = new Database();
        $connection = $db->getConnection();

        if ($connection) {
            $sql = "CREATE TABLE IF NOT EXISTS users (
                        id INT AUTO_INCREMENT PRIMARY KEY,
                        username VARCHAR(50) NOT NULL UNIQUE,
                        password VARCHAR(255) NOT NULL,
                        email VARCHAR(100) NOT NULL UNIQUE,
                        role ENUM('admin', 'editor', 'viewer') DEFAULT 'viewer',
                        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
                    );
                    
                    CREATE TABLE IF NOT EXISTS posts (
                        id INT AUTO_INCREMENT PRIMARY KEY,
                        user_id INT NOT NULL,
                        title VARCHAR(255) NOT NULL,
                        content TEXT NOT NULL,
                        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                        FOREIGN KEY (user_id) REFERENCES users(id)
                    );
                    
                    CREATE TABLE IF NOT EXISTS comments (
                        id INT AUTO_INCREMENT PRIMARY KEY,
                        post_id INT NOT NULL,
                        user_id INT NOT NULL,
                        content TEXT NOT NULL,
                        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                        FOREIGN KEY (post_id) REFERENCES posts(id),
                        FOREIGN KEY (user_id) REFERENCES users(id)
                    );

                    CREATE TABLE IF NOT EXISTS categories (
                        id INT AUTO_INCREMENT PRIMARY KEY,
                        name VARCHAR(100) NOT NULL
                    );

                    CREATE TABLE IF NOT EXISTS media (
                        id INT AUTO_INCREMENT PRIMARY KEY,
                        user_id INT NOT NULL,
                        file_path VARCHAR(255) NOT NULL,
                        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                        FOREIGN KEY (user_id) REFERENCES users(id)
                    );

                    CREATE TABLE IF NOT EXISTS settings (
                        id INT AUTO_INCREMENT PRIMARY KEY,
                        key_name VARCHAR(100) NOT NULL,
                        value TEXT NOT NULL
                    );

                    CREATE TABLE IF NOT EXISTS pfp (
                        id INT AUTO_INCREMENT PRIMARY KEY,
                        user_id INT NOT NULL,
                        file_path VARCHAR(255) NOT NULL,
                        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                        FOREIGN KEY (user_id) REFERENCES users(id)
                    );
                    
                    CREATE TABLE IF NOT EXISTS PAGES (
                        id INT AUTO_INCREMENT PRIMARY KEY,
                        user_id INT NOT NULL,
                        title VARCHAR(255) NOT NULL,
                        content TEXT NOT NULL,
                        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                        FOREIGN KEY (user_id) REFERENCES users(id)
                    );";

            if ($connection->multi_query($sql)) {
                do {
                    // Store first result set
                    if ($result = $connection->store_result()) {
                        $result->free();
                    }
                } while ($connection->next_result());
                
                echo "Tables created successfully.";
            } else {
                echo "Error creating tables: " . $connection->error;
            }
        } else {
            echo "Database connection failed.";
        }

        $db->closeConnection();
    }

    public function checkDbStatus() {
        $db = new Database();
        $connection = $db->getConnectionBool();

        if ($connection) {
            echo "Database connection is active.";
        } else {
            echo "Database connection is not active.";
        }
    }

    public function setupAdminAccount() {
        $db = new Database();
        $connection = $db->getConnection();

        if ($connection) {
            $username = "admin";
            $password = password_hash('admin', PASSWORD_BCRYPT);
            $email = "exampleemail@example.com";
            $role = 'admin';
            $stmt = $connection->prepare("INSERT INTO users (username, password, email, role) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $username, $password, $email, $role);
            if ($stmt->execute()) {
                echo "Admin account created successfully.";
            } else {
                echo "Error creating admin account: " . $stmt->error;
            }
            $stmt->close();
            $db->closeConnection();
        } 
        else {
            echo "Database connection failed.";
        }
    }
}
?>