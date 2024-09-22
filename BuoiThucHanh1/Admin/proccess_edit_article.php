<?php
include 'db.php'; // Kết nối cơ sở dữ liệu

if (isset($_POST['txtPostId'])) {
    // Nhận dữ liệu từ biểu mẫu
    $postId = $_POST['txtPostId']; // ID bài viết
    $title = trim($_POST['txtTitle']); // Tiêu đề bài viết
    $content = trim($_POST['txtContent']); // Tóm tắt bài viết
    $nameSong = trim($_POST['txtNameSong']); // Tên bài hát

    // Xác thực dữ liệu: bạn có thể thêm kiểm tra tại đây nếu cần
    if (empty($title) || empty($nameSong) || empty($content)) {
        header("Location: edit_article.php?id=$postId&error=Vui lòng điền đầy đủ thông tin.");
        exit;
    }

    // Truy vấn cập nhật bài viết
    $sql = "UPDATE baiviet SET tieude = ?, ten_bhat = ?, tomtat = ? WHERE ma_bviet = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        header("Location: edit_article.php?id=$postId&error=Lỗi chuẩn bị câu truy vấn: " . $conn->error);
        exit;
    }

    // Binding tham số
    $stmt->bind_param("sssi", $title, $nameSong, $content, $postId);

    if ($stmt->execute()) {
        // Chuyển hướng người dùng về trang danh sách bài viết
        header("Location: article.php?msg=Cập nhật thành công!");
        exit; // Ngăn chặn thực thi mã tiếp theo
    } else {
        header("Location: edit_article.php?id=$postId&error=Có lỗi xảy ra khi cập nhật: " . $stmt->error);
        exit;
    }

    $stmt->close(); // Đóng câu lệnh đã chuẩn bị
} else {
    header("Location: article.php?error=ID bài viết không hợp lệ.");
    exit;
}
?>
