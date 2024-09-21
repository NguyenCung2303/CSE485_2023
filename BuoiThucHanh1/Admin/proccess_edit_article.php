<?php
include 'db.php'; // Kết nối cơ sở dữ liệu

if (isset($_POST['txtPostId']) && isset($_POST['txtPostTitle']) && isset($_POST['txtPostContent'])) {
    $postId = $_POST['txtPostId']; // Lấy ID bài viết từ biểu mẫu
    $postTitle = trim($_POST['txtPostTitle']);
    $postContent = trim($_POST['txtPostContent']);

    // Xác thực dữ liệu
    if (empty($postTitle)) {
        header("Location: edit_baiviet.php?id=$postId&error=Tên bài viết không được để trống");
        exit;
    }

    // Truy vấn cập nhật bài viết
    $sql = "UPDATE baiviet SET tieu_de = ?, noi_dung = ? WHERE ma_bai_viet = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        header("Location: edit_baiviet.php?id=$postId&error=Lỗi chuẩn bị câu truy vấn: " . $conn->error);
        exit;
    }

    $stmt->bind_param("ssi", $postTitle, $postContent, $postId);

    if ($stmt->execute()) {
        // Chuyển hướng người dùng về trang danh sách bài viết
        header("Location: baiviet.php?msg=Cập nhật thành công!");
        exit; // Ngăn chặn thực thi mã tiếp theo
    } else {
        header("Location: edit_baiviet.php?id=$postId&error=Có lỗi xảy ra khi cập nhật: " . $stmt->error);
        exit;
    }

    $stmt->close(); // Đóng câu lệnh đã chuẩn bị
} else {
    header("Location: baiviet.php?error=ID bài viết không hợp lệ.");
    exit;
}
?>
