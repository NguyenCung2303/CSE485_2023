<?php
<<<<<<< HEAD
=======

>>>>>>> origin/btth02_qa
class CategoryController{
    // Hàm xử lý hành động index
    public function index(){
        // Nhiệm vụ 1: Tương tác với Services/Models
        echo "Tương tác với Services/Models from Category";
        // Nhiệm vụ 2: Tương tác với View
        echo "Tương tác với View from Category";
<<<<<<< HEAD
          }

     public function add(){
    // Nhiệm vụ 1: Tương tác với Services/Models
          echo "Tương tác với Services/Models from Category";
        
        include_once '/xampp/htdocs/CANP/CSE485_BuoiThucHanh2_NhomCANP/configs/DBConnection.php'; // Kết nối database

        // Xử lý form khi được gửi
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $catName = $_POST['txtCatName'];

            // Thêm thể loại vào cơ sở dữ liệu
            $sql = "INSERT INTO theloai (ten_tloai) VALUES (?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $catName);

            if ($stmt->execute()) {
                // Chuyển hướng về danh sách thể loại
                header("Location: category.php?msg=Thêm thể loại thành công!");
                exit;
            } else {
                echo "<div class='alert alert-danger'>Lỗi: " . $stmt->error . "</div>";
            }

            $stmt->close();
        }
       
         // Nhiệm vụ 2: Tương tác với View
        include("views/category/add_category.php");
     }

     public function list(){
       // Nhiệm vụ 1: Tương tác với Services/Models
          echo "Tương tác với Services/Models from Category";
        // Nhiệm vụ 2: Tương tác với View
         include "views/category/list_category.php";
     }
=======
    }

    public function add(){
        // Nhiệm vụ 1: Tương tác với Services/Models
        // echo "Tương tác với Services/Models from Category";
        // Nhiệm vụ 2: Tương tác với View
        include("views/article/add_article.php");
    }

    public function list(){
        // Nhiệm vụ 1: Tương tác với Services/Models
        // echo "Tương tác với Services/Models from Article";
        // Nhiệm vụ 2: Tương tác với View
        include("views/article/list_article.php");
    }
>>>>>>> origin/btth02_qa
}