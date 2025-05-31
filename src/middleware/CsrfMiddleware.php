<?php

class CsrfMiddleware {
    private $csrfToken;

    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $this->csrfToken = $_SESSION['csrf_token'] ?? null;
    }

    public function generateToken() {
        if (!$this->csrfToken) {
            $this->csrfToken = bin2hex(random_bytes(32));
            $_SESSION['csrf_token'] = $this->csrfToken;
        }
        return $this->csrfToken;
    }

    public function validateToken($token) {
        if (!$this->csrfToken) {
            return false;
        }
        return hash_equals($this->csrfToken, $token);
    }
}
?>