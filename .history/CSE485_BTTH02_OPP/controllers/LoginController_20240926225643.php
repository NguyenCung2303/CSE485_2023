<?php
session_start(); // Bắt đầu phiên
include '../config/DBconn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once '../config/DBconn.php';
    require_once '../models/model_article.php';
    require_once '../models/model_author.php';
    require_once '../models/model_category.php';

    $userName = $_POST['username'];
    $pw = $_POST['password'];


    // Truy vấn để tìm user theo username
     
    $sql = "SELECT * FROM users WHERE userName = ?";
    $temp = $conn->prepare($sql);
    $temp->bind_param("s", $userName);
    $temp->execute();
    $result = $temp->get_result();
    
    if ($result->num_rows > 0) {
        $users = $result->fetch_assoc();        
        if ($pw == $users['pw']) {
            header("Location: ../views/admin"); 
            exit();
        } else {
            $error = "Sai mật khẩu!";
        }
    } else {
        $error = "Không tìm thấy người dùng!";
    }

    $temp->close();
}
?>

<?php
if (isset($error)) {
    echo "<script>alert('$error'); window.history.back();</script>";
}
?>