<?php
// Authentication Controller

require_once __DIR__ . '/../../config/Database.php';
require_once __DIR__ . '/../middleware/CsrfMiddleware.php';

class AuthController {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validate CSRF Token
            $csrf = new CsrfMiddleware();
            if (!isset($_POST['csrf_token']) || !$csrf->validateToken($_POST['csrf_token'])) {
                return json_encode([
                    'status'  => 'error', 
                    'message' => 'Invalid CSRF token.'
                ]);
            }
            
            // Retrieve and validate form data
            $username = trim($_POST['username'] ?? '');
            $password = $_POST['password'] ?? '';
            $email    = trim($_POST['email'] ?? '');

            if (empty($username) || empty($password) || empty($email)) {
                return json_encode([
                    'status'  => 'error', 
                    'message' => 'All fields are required.'
                ]);
            }

            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
            $stmt = $this->conn->prepare("INSERT INTO users (username, password, email) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $username, $hashedPassword, $email);

            if ($stmt->execute()) {
                return json_encode([
                    'status'  => 'success', 
                    'message' => 'User registered successfully.'
                ]);
            } else {
                return json_encode([
                    'status'  => 'error', 
                    'message' => 'Registration failed.'
                ]);
            }
        }
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validate CSRF Token
            $csrf = new CsrfMiddleware();
            if (!isset($_POST['csrf_token']) || !$csrf->validateToken($_POST['csrf_token'])) {
                return json_encode([
                    'status'  => 'error', 
                    'message' => 'Invalid CSRF token.'
                ]);
            }
            
            $username = trim($_POST['username'] ?? '');
            $password = $_POST['password'] ?? '';

            if (empty($username) || empty($password)) {
                return json_encode([
                    'status'  => 'error', 
                    'message' => 'Username and password are required.'
                ]);
            }

            // Retrieve user record based on username
            $stmt = $this->conn->prepare("SELECT id, password FROM users WHERE username = ?");
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                $stmt->bind_result($userId, $hashedPassword);
                $stmt->fetch();

                if (password_verify($password, $hashedPassword)) {
                    if (session_status() === PHP_SESSION_NONE) {
                        session_start();
                    }
                    $_SESSION['user_id'] = $userId;
                    return json_encode([
                        'status'  => 'success', 
                        'message' => 'Login successful.'
                    ]);
                } else {
                    return json_encode([
                        'status'  => 'error', 
                        'message' => 'Invalid password.'
                    ]);
                }
            } else {
                return json_encode([
                    'status'  => 'error', 
                    'message' => 'User not found.'
                ]);
            }
        }
    }

    public function logout() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            session_unset();
            session_destroy();
            return json_encode([
                'status'  => 'success', 
                'message' => 'Logged out successfully.'
            ]);
        }
    }
}
?>
