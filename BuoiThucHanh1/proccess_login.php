<?php
session_start();
include("Admin/db.php"); // Đảm bảo đường dẫn tới db.php là chính xác

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Truy vấn để lấy thông tin người dùng
    $stmt = $conn->prepare("SELECT id, ten_dang_nhap, mat_khau FROM tai_khoan WHERE ten_dang_nhap = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Kiểm tra mật khẩu
        if (password_verify($password, $user['mat_khau'])) { 
            // Lưu thông tin người dùng vào session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['ten_dang_nhap'];

            // Chuyển hướng đến trang chính admin
            header("Location: Admin/index.php"); // Đảm bảo đường dẫn đúng
            exit();
        } else {
            $error = "Mật khẩu không đúng!";
        }
    } else {
        $error = "Người dùng không tồn tại!";
    }
    
    // Đóng kết nối
    $stmt->close();
}
?>
