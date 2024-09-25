<?php
require_once __DIR__ . '/../../config/db.php'; // Kết nối đến cơ sở dữ liệu

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lấy dữ liệu từ form
    $title = $_POST['title'] ?? '';
    $summary = $_POST['summary'] ?? '';
    $category_id = $_POST['ma_tloai'] ?? '';
    $author_id = $_POST['ma_tgia'] ?? '';

    // Kết nối đến cơ sở dữ liệu
    $conn = getDatabaseConnection();

    // Chuẩn bị câu lệnh SQL
    $stmt = $conn->prepare("INSERT INTO baiviet (tieude, tomtat, ma_tloai, ma_tgia) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssii", $title, $summary, $category_id, $author_id);

    // Xử lý thêm dữ liệu
    if ($stmt->execute()) {
        header("Location: ../views/article.php?success=Thêm bài viết thành công");
        exit();
    } else {
        $errorMsg = "Có lỗi xảy ra khi thêm bài viết: " . $stmt->error;
    }

    // Đóng kết nối
    $stmt->close();
    $conn->close();
}
?>
