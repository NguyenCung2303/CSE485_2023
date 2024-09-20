<?php
// Khởi động phiên
session_start();

// Kết nối đến cơ sở dữ liệu
$servername = "localhost"; // Tên máy chủ
$username = "root"; // Tên người dùng MySQL
$password = ""; // Mật khẩu MySQL (thay đổi nếu cần)
$dbname = "BTTH01_CSE485"; // Tên cơ sở dữ liệu của bạn

// Tạo kết nối
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    error_log("Kết nối thất bại: " . $conn->connect_error);
    die("Có lỗi xảy ra. Vui lòng thử lại sau.");
}

// Tạo CSRF token nếu chưa có
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Kiểm tra nếu form đã được submit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Kiểm tra CSRF token
    if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        die("CSRF token không hợp lệ.");
    }

    // Lấy dữ liệu từ form
    $ten_tloai = $_POST['txtCatName'];
    
    // Kiểm tra xem tên thể loại có trống hay không
    if (!empty($ten_tloai)) {
        // Chuẩn bị truy vấn SQL để thêm thể loại
        $sql = "INSERT INTO theloai (ten_tloai) VALUES (?)";
        $stmt = $conn->prepare($sql);
        
        if ($stmt === false) {
            error_log("Lỗi chuẩn bị truy vấn: " . $conn->error);
            die("Có lỗi xảy ra. Vui lòng thử lại sau.");
        }

        $stmt->bind_param("s", $ten_tloai);

        // Thực thi truy vấn
        if ($stmt->execute()) {
            // Nếu thành công, chuyển hướng về trang danh sách thể loại
            header("Location: category.php");
            exit(); // Đảm bảo script dừng sau khi chuyển hướng
        } else {
            // Nếu xảy ra lỗi khi thêm thể loại
            echo "Lỗi khi thêm thể loại: " . $stmt->error;
        }

        // Đóng statement
        $stmt->close();
    } else {
        // Nếu tên thể loại trống
        echo "<script>alert('Vui lòng nhập tên thể loại'); window.history.back();</script>";
    }
}

// Đóng kết nối
$conn->close();
?>