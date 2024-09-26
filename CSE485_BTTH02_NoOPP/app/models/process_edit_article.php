<?php
require_once '../../config/db.php'; // Kết nối cơ sở dữ liệu

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lấy dữ liệu từ form
    $articleId = $_POST['articleId'] ?? '';
    $title = $_POST['title'] ?? '';
    $summary = $_POST['summary'] ?? '';

    // Cập nhật vào cơ sở dữ liệu
    $conn = getDatabaseConnection();

    // Chuẩn bị câu lệnh SQL
    $stmt = $conn->prepare("UPDATE baiviet SET tieude = ?, tomtat = ? WHERE ma_bviet = ?");
    $stmt->bind_param("ssi", $title, $summary, $articleId);

    if ($stmt->execute()) {
        header("Location: ../views/article.php?success=Cập nhật bài viết thành công");
        exit();
    } else {
        $errorMsg = "Có lỗi xảy ra khi cập nhật bài viết. Vui lòng thử lại: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
