<?php
// controllers/LoginController.php

require_once 'models/UserModel.php';

class LoginController {
    private $userModel;

    public function __construct($dbConnection) {
        $this->userModel = new UserModel($dbConnection);
    }

    // Hiển thị form đăng nhập
    public function showForm() {
        include 'views/login_form.php';
    }

    // Xử lý đăng nhập
    public function authenticate() {
        session_start();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $user = $this->userModel->checkLogin($username, $password);
            if ($user) {
                $_SESSION['username'] = $user['username'];
                header('Location: index.php?controller=home');
            } else {
                $error = "Tên đăng nhập hoặc mật khẩu không chính xác!";
                include 'views/login_form.php';
            }
        }
    }

    // Xử lý đăng xuất
    public function logout() {
        session_start();
        session_destroy();
        header('Location: index.php?controller=login&action=showForm');
    }
}
