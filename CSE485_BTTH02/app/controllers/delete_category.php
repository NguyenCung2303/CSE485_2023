<?php
require_once '../../config/db.php';  // Kết nối CSDL

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // In ra id để kiểm tra
    // echo "ID nhận được: " . htmlspecialchars($id) . "<br>";

    // Kiểm tra xem thể loại này có liên kết với bài viết nào không
    $conn = getDatabaseConnection(); // Thêm dòng này để đảm bảo kết nối
    $sql_check = "SELECT COUNT(*) as total FROM baiviet WHERE ma_tloai = ?";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param("i", $id);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();
    $row_check = $result_check->fetch_assoc();

    if ($row_check['total'] > 0) {
        // Nếu có bài viết liên quan, hiển thị thông báo lỗi
        echo "<script>alert('Không thể xóa thể loại vì vẫn còn bài viết liên quan. Vui lòng xóa hoặc cập nhật các bài viết trước.'); window.location.href = '../views/category.php';</script>";
    } else {
        // Nếu không có bài viết liên quan, thực hiện xóa thể loại
        $sql = "DELETE FROM theloai WHERE ma_tloai = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            // Chuyển hướng về trang category.php sau khi xóa thành công
            header("Location: ../views/category.php?success=Xóa thể loại thành công");
            exit();
        } else {
            echo "Lỗi khi xóa thể loại: " . $stmt->error;
        }
    }
} else {
    echo "Không tìm thấy mã thể loại.<br>";
}
?>
