<?php
// Database connection class    
    class Database {
        private $connection;

        public function __construct() {
            $config = require 'config.php';
            $dbConfig = $config['database'];

            $this->connection = new mysqli(
                $dbConfig['host'],
                $dbConfig['username'],
                $dbConfig['password'],
                $dbConfig['database_name']
            );

            if ($this->connection->connect_error) {
                die("Connection failed: " . $this->connection->connect_error);
            }
        }

        public function getConnection() {
            return $this->connection;
        }

        public function getConnectionBool() {
            return $this->connection ? true : false;
        }

        public function closeConnection() {
            if ($this->connection) {
                $this->connection->close();
            }
        }
    }
?>