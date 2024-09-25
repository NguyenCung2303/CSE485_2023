<?php
require_once '../../config/db.php';  // Kết nối đến cơ sở dữ liệu

if (isset($_GET['id'])) {
    $catId = $_GET['id'];

    // Kiểm tra xem tác giả có tồn tại không
    $conn = getDatabaseConnection();
    $sql_check = "SELECT COUNT(*) as total FROM tacgia WHERE ma_tgia = ?";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param("i", $catId);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();
    $row_check = $result_check->fetch_assoc();

    if ($row_check['total'] > 0) {
        // Xóa tác giả
        $sql = "DELETE FROM tacgia WHERE ma_tgia = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $catId);

        if ($stmt->execute()) {
            // Chuyển hướng về trang danh sách tác giả với thông báo thành công
            header("Location: ../views/author.php?msg=Xóa tác giả thành công!");
            exit;
        } else {
            header("Location: ../views/author.php?msg=Lỗi khi xóa tác giả: " . $stmt->error);
            exit;
        }

     
    } else {
        header("Location: ../views/author.php?msg=Tác giả không tồn tại.");
        exit;
    }
} else {
    header("Location: ../views/author.php?msg=ID tác giả không hợp lệ.");
    exit;
}
?>
