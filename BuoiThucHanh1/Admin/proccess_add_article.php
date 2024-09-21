<?php
include 'db.php'; // Kết nối đến cơ sở dữ liệu

// Xử lý khi gửi form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Nhận dữ liệu từ form
    $title = $_POST['txtTitle'];
    $category_id = $_POST['category_id']; // ID của thể loại
    $author_id = $_POST['author_id']; // ID của tác giả
    $content = $_POST['txtContent'];

    // Thêm bài viết vào cơ sở dữ liệu
    $sql = "INSERT INTO baiviet (tieude, ma_tloai, ma_tgia, noidung) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("siis", $title, $category_id, $author_id, $content);

    if ($stmt->execute()) {
        // Chuyển hướng về danh sách bài viết
        header("Location: article.php?msg=Thêm bài viết thành công!");
        exit;
    } else {
        echo "<div class='alert alert-danger'>Lỗi: " . $stmt->error . "</div>";
    }

    $stmt->close();
}
?>