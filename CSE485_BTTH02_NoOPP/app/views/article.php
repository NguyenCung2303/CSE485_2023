<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Music for Life</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/style_login.css">
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary shadow p-3 bg-white rounded">
            <div class="container-fluid">
                <div class="h3">
                    <a class="navbar-brand" href="#">Administration</a>
                </div>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="./">Trang chủ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../../index.php">Trang ngoài</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="category.php">Thể loại</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="author.php">Tác giả</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active fw-bold" href="article.php">Bài viết</a>
                    </li>
                </ul>
                </div>
            </div>
        </nav>

    </header>
    <main class="container mt-5 mb-5">
    <div class="row">
            <div class="col-sm">
                
                <table class="table">
                <thead>
                        <tr>
                        <a href="../../app/controllers/add_article.php" class="btn btn-success">Thêm mới</a>
                            <th scope="col">#</th>
                            <th scope="col">Tiêu đề</th>
                            <th scope="col">Tên thể loại</th>
                            <th scope="col">Tác giả</th>
                            <th>Sửa</th>
                            <th>Xóa</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        require_once '../../config/db.php';                       
                        class Article {
                            public static function getAll() {
                                $conn = getDatabaseConnection(); // Kết nối tới cơ sở dữ liệu
                                $sql = "SELECT 
                                    bv.ma_bviet,
                                    bv.tieude,
                                    bv.tomtat,
                                    bv.ngayviet,
                                    tg.ten_tgia AS ten_tac_gia,
                                    tl.ten_tloai AS ten_the_loai
                                FROM 
                                    baiviet bv
                                JOIN 
                                    tacgia tg ON bv.ma_tgia = tg.ma_tgia
                                JOIN 
                                    theloai tl ON bv.ma_tloai = tl.ma_tloai
                                ORDER BY bv.ma_bviet ASC;";
                                $result = $conn->query($sql);
                                $articles = []; // Khởi tạo mảng tác giả

                                if ($result) {
                                    while ($row = $result->fetch_assoc()) {
                                        $articles[] = $row; // Đưa bài viết vào mảng
                                    }
                                }
                                return $articles; // Trả về mảng bài viết
                            }
                        }
                        
                        class ArticleController {
                            public function index() {
                                $articles = Article::getAll();
                                return $articles;
                            }
                        }
    
                        // Gọi ArticleController để lấy danh sách bài viết
                        $controller = new ArticleController();
                        $articles = $controller->index();
    
                        if (!empty($articles)) {
                            foreach ($articles as $article) {
                                echo "<tr>";
                                echo "<th scope='row'>" . htmlspecialchars($article['ma_bviet']) . "</th>";
                                echo "<td>" . htmlspecialchars($article['tieude']) . "</td>";
                                echo "<td>" . htmlspecialchars($article['ten_the_loai']) . "</td>";
                                echo "<td>" . htmlspecialchars($article['ten_tac_gia']) . "</td>";
                                echo "<td><a href='../controllers/edit_article.php?id=" . $article['ma_bviet']  . "'><i class='fa-solid fa-pen-to-square'></i></a></td>";
                                echo "<td><a href='../controllers/delete_article.php?id=" . $article['ma_bviet'] . "' onclick='return confirm(\"Bạn có chắc chắn muốn xóa bài viết này?\");'><i class='fa-solid fa-trash'></i></a></td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='6'>Không có bài viết nào.</td></tr>";
                        }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
    
    <footer class="bg-white d-flex justify-content-center align-items-center border-top border-secondary  border-2" style="height:80px">
        <h4 class="text-center text-uppercase fw-bold">TLU's music garden</h4>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>