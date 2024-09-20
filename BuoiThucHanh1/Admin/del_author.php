<?php
// Kết nối đến cơ sở dữ liệu
$servername = "localhost"; // Thay đổi nếu cần
$username = "root"; // Tên người dùng MySQL
$password = ""; // Mật khẩu MySQL
$dbname = "BTTH01_CSE485"; // Tên cơ sở dữ liệu của bạn

// Tạo kết nối
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Lấy id của thể loại từ URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // In ra id để kiểm tra
    echo "ID nhận được: " . $id . "<br>";

    // Kiểm tra xem thể loại này có liên kết với bài viết nào không
    $sql_check = "SELECT COUNT(*) as total FROM baiviet WHERE ma_tgia = ?";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param("i", $id);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();
    $row_check = $result_check->fetch_assoc();

    if ($row_check['total'] > 0) {
        // Nếu có bài viết liên quan, hiển thị thông báo lỗi
        echo "<script>alert('Không thể xóa thể loại vì vẫn còn bài viết liên quan. Vui lòng xóa hoặc cập nhật các bài viết trước.'); window.location.href = 'author.php';</script>";
    } else {
        // Nếu không có bài viết liên quan, thực hiện xóa tác giả   
        $sql = "DELETE FROM tacgia WHERE ma_tgia = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);

        // In ra câu lệnh SQL để kiểm tra
        echo "Câu lệnh SQL: DELETE FROM tacgia WHERE ma_tgia = $id<br>";

        if ($stmt->execute()) {
            // Chuyển hướng về trang author.php sau khi xóa thành công
            echo "Xóa thành công!<br>";
            header("Location: author.php");
            exit();
        } else {
            echo "Lỗi khi xóa thể loại: " . $conn->error;
        }
    }
} else {
    echo "Không tìm thấy mã thể loại.<br>";
}

// Đóng kết nối
$conn->close();
?>
