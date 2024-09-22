<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Music for Life</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary shadow p-3 bg-white rounded">
            <div class="container-fluid">
                <div class="my-logo">
                    <a class="navbar-brand" href="#">
                        <img src="images/logo2.png" alt="" class="img-fluid">
                    </a>
                </div>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="./">Trang chủ</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="./login.php">Đăng nhập</a>
                    </li>
                </ul>
                <form class="d-flex" role="search" action="search.php" method="GET">
                    <input class="form-control me-2" type="search" name="query" placeholder="Nội dung cần tìm" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Tìm</button>
                </form>
                </div>
            </div>
        </nav>
    </header>

    <main class="container mt-5">
        <?php
        include 'Admin/db.php'; // Kết nối CSDL

        // Kiểm tra nếu ID đã được truyền qua URL
        if (isset($_GET['id'])) {
            $ma_bviet = intval($_GET['id']); // Lấy ID bài hát

            // Truy vấn lấy bài hát theo ID
            $sql = "SELECT 
                        bv.ma_bviet, 
                        bv.ten_bhat, 
                        bv.tomtat, 
                        bv.noidung, 
                        tg.ten_tgia AS ten_tac_gia, 
                        tl.ten_tloai AS ten_the_loai
                    FROM 
                        baiviet bv
                    JOIN 
                        tacgia tg ON bv.ma_tgia = tg.ma_tgia
                    JOIN 
                        theloai tl ON bv.ma_tloai = tl.ma_tloai 
                    WHERE 
                        bv.ma_bviet = $ma_bviet"; // Lọc bài hát theo ID

            $result = $conn->query($sql);

            if ($result && $result->num_rows > 0) {
                $row = $result->fetch_assoc(); // Lấy một hàng dữ liệu
        ?>
                <div class="row mb-5">
                    <div class="col-sm-4">
                        <img src="images/songs/longme.jpg" class="img-fluid" alt="<?php echo htmlspecialchars($row['ten_bhat']); ?>">
                    </div>
                    <div class="col-sm-8">
                        <h5 class="card-title mb-2">
                            <a href="proccess_detail.php?id=<?php echo htmlspecialchars($row['ma_bviet']); ?>" class="text-decoration-none"><?php echo htmlspecialchars($row['ten_bhat']); ?></a>
                        </h5>
                        <p class="card-text"><span class="fw-bold">Bài hát: </span><?php echo htmlspecialchars($row['ten_bhat']); ?></p>
                        <p class="card-text"><span class="fw-bold">Thể loại: </span><?php echo htmlspecialchars($row['ten_the_loai']); ?></p>
                        <p class="card-text"><span class="fw-bold">Tóm tắt: </span><?php echo htmlspecialchars($row['tomtat']); ?></p>
                        <p class="card-text"><span class="fw-bold">Nội dung: </span><?php echo htmlspecialchars($row['noidung']); ?></p>
                        <p class="card-text"><span class="fw-bold">Tác giả: </span><?php echo htmlspecialchars($row['ten_tac_gia']); ?></p>
                    </div>
                </div>
        <?php
            } else {
                echo "<p class='text-center'>Không có bài hát nào.</p>";
            }
        } else {
            echo "<p class='text-center'>ID bài hát không được cung cấp.</p>";
        }

        // Đóng kết nối
        $conn->close();
        ?>
    </main>

    <footer class="bg-white d-flex justify-content-center align-items-center border-top border-secondary border-2" style="height:80px">
        <h4 class="text-center text-uppercase fw-bold">TLU's music garden</h4>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>
