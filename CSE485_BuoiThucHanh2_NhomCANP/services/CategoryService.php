<?php
<<<<<<< HEAD
include_once("configs/DBConnection.php");
=======
include("configs/DBConnection.php");
>>>>>>> origin/btth02_qa
include("models/Category.php");
class CategoryService{
    public function getAllCategory(){
        // 4 bước thực hiện
       $dbConn = new DBConnection();
       $conn = $dbConn->getConnection();

        // B2. Truy vấn
<<<<<<< HEAD
        $sql = "SELECT * FROM theloai";
=======
        $sql = "SELECT * FROM theloai ";
>>>>>>> origin/btth02_qa
        $stmt = $conn->query($sql);

        // B3. Xử lý kết quả
        $categorys = [];
        while($row = $stmt->fetch()){
<<<<<<< HEAD
            $category = new Category($row['ma_tloai'], $row['ten_tloai']);// [2, nhac tre]
            array_push($categorys,$category);
            
            // {
            //     [0]{
            //         [2, nhac tre]
            //     }
            //     [1]{
            //         [3, nhac tre]
            //     }
            // }
=======
            $category = new Category($row['ma_tloai'], $row['ten_tloai']);
            array_push($categorys,$category);
            $categorys[] = $category;
>>>>>>> origin/btth02_qa
        }
        // Mảng (danh sách) các đối tượng Category Model

        return $categorys;
    }
}