<?php
require_once '../../config/db.php'; // Kết nối cơ sở dữ liệu

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $catId = $_POST['txtCatId'] ?? null;
    $catName = $_POST['txtCatName'] ?? '';

    if ($catId && $catName) {
        $conn = getDatabaseConnection();

        // Cập nhật thông tin thể loại
        $sql = "UPDATE theloai SET ten_tloai = ? WHERE ma_tloai = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $catName, $catId);

        if ($stmt->execute()) {
            // Chuyển hướng về trang danh sách thể loại sau khi sửa thành công
            header("Location: ../views/category.php?success=Sửa thể loại thành công.");
            exit();
        } else {
            header("Location: ../views/edit_category.php?id=" . $catId . "&error=Lỗi khi sửa thể loại.");
            exit();
        }
    } else {
        header("Location: ../views/category.php?error=Thông tin không hợp lệ.");
        exit();
    }
} else {
    header("Location: ../views/category.php?error=Yêu cầu không hợp lệ.");
    exit();
}
?>
