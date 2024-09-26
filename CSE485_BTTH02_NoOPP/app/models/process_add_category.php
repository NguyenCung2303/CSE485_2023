<?php
require_once '../../config/db.php'; // Kết nối đến cơ sở dữ liệu

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lấy dữ liệu từ form
    $categoryName = $_POST['txtCatName'] ?? '';

    // Thêm vào cơ sở dữ liệu
    $conn = getDatabaseConnection();

    // Chuẩn bị câu lệnh SQL
    $stmt = $conn->prepare("INSERT INTO theloai (ten_tloai) VALUES (?)");
    $stmt->bind_param("s", $categoryName);

    if ($stmt->execute()) {
        header("Location: ../views/category.php?success=Thêm thể loại thành công");
    } else {
        $errorMsg = "Có lỗi xảy ra khi thêm thể loại. Vui lòng thử lại: " . $stmt->error;
    }
    $stmt->close();
    $conn->close();
}
?>
