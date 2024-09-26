<?php
// services/LoginService.php
include("configs/DBConnection.php");

class LoginService {
    private $db;

    public function __construct() {
        $dbConn = new DBConnection();
        $conn = $dbConn->getConnection();
    }

    public function authenticate($username, $password) {
        $query = "SELECT * FROM tai_khoan WHERE ten_dang_nhap = :username LIMIT 1";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Kiểm tra mật khẩu (nên mã hóa mật khẩu trước khi lưu trữ trong CSDL)
        if ($user && password_verify($password, $user['password'])) {
            return $user; // Đăng nhập thành công
        }
        return false; // Đăng nhập thất bại
    }
}
