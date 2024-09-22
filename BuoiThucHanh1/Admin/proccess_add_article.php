
<?php
include 'db.php'; // Kết nối đến cơ sở dữ liệu

// Xử lý khi gửi form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Nhận dữ liệu từ form
    $title = $_POST['txtTitle'];
    $category_id = $_POST['category_id']; // ID của thể loại
    $author_id = $_POST['author_id']; // ID của tác giả
    $content = $_POST['txtContent'];
    $nameSong = $_POST['txtNameSong']; // Thêm biến tên bài hát

    // Thêm bài viết vào cơ sở dữ liệu
    $sql = "INSERT INTO baiviet (tieude, ten_bhat, ma_tloai, ma_tgia, tomtat) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssiis", $title, $nameSong, $category_id, $author_id, $content);
    echo "Title: " . htmlspecialchars($title) . "<br>";
    echo "Song Name: " . htmlspecialchars($nameSong) . "<br>";
    echo "Category ID: " . htmlspecialchars($category_id) . "<br>";
    echo "Author ID: " . htmlspecialchars($author_id) . "<br>";
    echo "Content: " . htmlspecialchars($content) . "<br>";

    if ($stmt->execute()) {
        header("Location: article.php?msg=Thêm bài viết thành công!");
        exit;
    } else {
        echo "<div class='alert alert-danger'>Lỗi: " . htmlspecialchars($stmt->error) . "</div>";
    }
    
    

    $stmt->close();
}
?>
