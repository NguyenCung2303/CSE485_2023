<?php
include 'db.php'; // Kết nối đến cơ sở dữ liệu

if (isset($_GET['id'])) {
    $articleId = $_GET['id'];

    // Truy vấn xóa bài viết
    $sql = "DELETE FROM baiviet WHERE ma_bviet = ?"; // Lưu ý đã sửa từ ma_bivet thành ma_bviet
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        // Kiểm tra và thông báo lỗi nếu không thể chuẩn bị câu lệnh
        echo "Lỗi chuẩn bị câu truy vấn: " . $conn->error;
        exit;
    }

    $stmt->bind_param("i", $articleId);

    if ($stmt->execute()) {
        // Chuyển hướng về trang danh sách bài viết với thông báo thành công
        header("Location: article.php?msg=Xóa bài viết thành công!");
        exit;
    } else {
        echo "Có lỗi xảy ra khi xóa bài viết: " . $stmt->error;
    }

    $stmt->close(); // Đóng câu lệnh đã chuẩn bị
} else {
    echo "ID bài viết không hợp lệ.";
}
?>
