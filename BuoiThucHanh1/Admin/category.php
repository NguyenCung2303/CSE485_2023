<?php
include 'C:/xampp/htdocs/CANP/BuoiThucHanh1/Database/db.php'; // Kết nối CSDL

// Truy vấn lấy danh sách thể loại
$sql = "SELECT ma_tloai, ten_tloai FROM the_loai";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Hiển thị thể loại
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['ma_tloai'] . "</td>";
        echo "<td>" . $row['ten_tloai'] . "</td>";
        echo "</tr>";
    }
} else {
    echo "Không có thể loại nào.";
}
?>