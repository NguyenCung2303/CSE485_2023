<?php
require_once '../../config/db.php'; // Kết nối đến cơ sở dữ liệu

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lấy dữ liệu từ form
    $authorName = $_POST['txtCatName'] ?? '';

    // Thêm vào cơ sở dữ liệu
    $conn = getDatabaseConnection();

    // Chuẩn bị câu lệnh SQL
    $stmt = $conn->prepare("INSERT INTO tacgia (ten_tgia) VALUES (?)");
    $stmt->bind_param("s", $authorName);

    if ($stmt->execute()) {
        header("Location: ../views/author.php?success=Thêm thể loại thành công");
    } else {
        $errorMsg = "Có lỗi xảy ra khi thêm thể loại. Vui lòng thử lại: " . $stmt->error;
    }
    $stmt->close();
    $conn->close();
}
?>
