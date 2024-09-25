<?php
// models/UserModel.php

class UserModel {
    private $conn;

    public function __construct($dbConnection) {
        $this->conn = $dbConnection;
    }

    // Hàm kiểm tra thông tin đăng nhập
    public function checkLogin($username, $password) {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }
}
