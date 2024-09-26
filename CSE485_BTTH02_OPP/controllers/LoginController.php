<?php
// controllers/LoginController.php
include("services/LoginService.php");

class LoginController {
    
    public function showForm() {
        // Hiển thị form đăng nhập
        include("views/login_form.php");
    }

    // Xử lý đăng nhập
    public function authenticate() {
        session_start();
        $loginService = new LoginService();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['ten_dang_nhap'] ?? '';
            $password = $_POST['mat_khau'] ?? '';

            // Sử dụng LoginService để xác thực
            $user = $loginService->authenticate($username, $password); // Đã sửa ở đây
            if ($user) {
                $_SESSION['ten_dang_nhap'] = $user['ten_dang_nhap'];
                header('Location: index.php?controller=homepage&action=showHomepage');
                exit(); // Đảm bảo dừng script
            } else {
                $error = "Tên đăng nhập hoặc mật khẩu không chính xác!";
                include 'views/login_form.php';
            }
        }
    }
}
