<?php
include 'db.php'; // Kết nối đến cơ sở dữ liệu

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Nhận dữ liệu từ biểu mẫu
    $catId = $_POST['txtCatId'];
    $catName = $_POST['txtCatName'];

    // Xác thực và an toàn dữ liệu nhập
    $catName = trim($catName);
    if (empty($catName)) {
        echo "Tên thể loại không được để trống.";
        exit;
    }

    // Truy vấn cập nhật thể loại
    $sql = "UPDATE the_loai SET ten_tloai = ? WHERE ma_tloai = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $catName, $catId);

    if ($stmt->execute()) {
        echo "Cập nhật thành công!";
        // Chuyển hướng người dùng về trang danh sách thể loại
        header("Location: category.php");
        exit;
    } else {
        echo "Có lỗi xảy ra khi cập nhật: " . $stmt->error;
    }
}
?>