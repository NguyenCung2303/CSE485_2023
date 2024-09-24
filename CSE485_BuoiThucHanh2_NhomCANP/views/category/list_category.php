<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <li><a href="./index.php?controller=category&action=list">Bài viết</a></li>
</head>
<body>
<main class="container mt-5 mb-5">
        <!-- <h3 class="text-center text-uppercase mb-3 text-primary">CẢM NHẬN VỀ BÀI HÁT</h3> -->
        <div class="row">
            <div class="col-sm">
                <a href="add_category.php" class="btn btn-success">Thêm mới</a>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Tên thể loại</th>
                            <th>Sửa</th>
                            <th>Xóa</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        <?php
                        include '/xampp/htdocs/CANP/CSE485_BuoiThucHanh2_NhomCANP/configs/DBConnection.php'; // Kết nối CSDL

                        // Truy vấn lấy danh sách thể loại
                        $sql = "SELECT ma_tloai, ten_tloai FROM theloai";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            // Hiển thị dữ liệu
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<th scope='row'>" . $row['ma_tloai'] . "</th>";
                                echo "<td>" . $row['ten_tloai'] . "</td>";
                                echo "<td><a href='edit_category.php?id=" . $row['ma_tloai'] . "'><i class='fa-solid fa-pen-to-square'></i></a></td>";
                                echo "<td><a href='del_category.php?id=" . $row['ma_tloai'] . "'><i class='fa-solid fa-trash'></i></a></td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='4' class='text-center'>Không có dữ liệu</td></tr>";
                        }
            ?>
                    </tbody>
                </table>
            </div>
        </div>
        
    </main>
</body>
</html>