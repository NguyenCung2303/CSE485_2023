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
        
        // Khởi tạo kết nối cơ sở dữ liệu
        try {
            $db = new PDO('mysql:host=localhost;dbname=btth01_cse485', 'root', ''); // Cập nhật thông tin đăng nhập đúng
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die('Connection failed: ' . $e->getMessage());
        }
    
        // Khởi tạo LoginService với kết nối $db
        $loginService = new LoginService($db);
    
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['ten_dang_nhap'] ?? '';
            $password = $_POST['mat_khau'] ?? '';
    
            // Sử dụng LoginService để xác thực
            $user = $loginService->authenticate($username, $password); // Đây là nơi gọi phương thức authenticate
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
