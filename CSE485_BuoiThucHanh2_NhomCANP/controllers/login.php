<?php
// controllers/LoginController.php

<<<<<<< HEAD:CSE485_BuoiThucHanh2_NhomCANP/app/controllers/login.php
require_once(__DIR__ . '/../models/login.php');
=======
require_once 'models/UserModel.php';
>>>>>>> 342b362e51794a912690b08b676e9dcdf1f728e1:CSE485_BuoiThucHanh2_NhomCANP/controllers/login.php

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
