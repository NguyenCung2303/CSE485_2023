<?php
session_start(); // Khởi động PHP session
include "./Admin/db.php"; // Kết nối đến cơ sở dữ liệu

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Nhận thông tin đăng nhập
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    
    // Truy vấn để lấy thông tin người dùng
    $sql = "SELECT * FROM tai_khoan WHERE ten_dang_nhap=?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        // Kiểm tra xem có người dùng nào với tên đăng nhập này không
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            // Kiểm tra mật khẩu
            if (password_verify($password, $row['mat_khau'])) { // Chỉnh sửa tên cột cho đúng
                // Đăng nhập thành công, lưu vào session
                $_SESSION['user_id'] = $row['id']; // Lưu ID người dùng
                $_SESSION['username'] = $username;
                $_SESSION['success_message'] = 'Đăng nhập thành công.';
                // Chuyển hướng đến trang admin
                header("Location: ./admin/index.php");
                exit();
            } else {
                $error_message = 'Mật khẩu không đúng.';
            }
        } else {
            $error_message = 'Tài khoản không tồn tại.';
        }
    } else {
        $error_message = 'Đã có lỗi xảy ra trong quá trình xác thực.';
    }
}

$conn->close();
?>

<!-- Hiển thị thông báo lỗi nếu có -->
<?php if (isset($error_message)): ?>
    <script>
        alert('<?php echo $error_message; ?>');
        window.location.href = "login.php"; // Thay đổi thành trang đăng nhập của bạn
    </script>
<?php endif; ?>