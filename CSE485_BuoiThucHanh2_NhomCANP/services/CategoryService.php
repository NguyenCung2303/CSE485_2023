<?php
include_once("configs/DBConnection.php");
include("models/Category.php");
class CategoryService{
    public function getAllCategory(){
        // 4 bước thực hiện
       $dbConn = new DBConnection();
       $conn = $dbConn->getConnection();

        // B2. Truy vấn
        $sql = "SELECT * FROM theloai";
        $stmt = $conn->query($sql);

        // B3. Xử lý kết quả
        $categorys = [];
        while($row = $stmt->fetch()){
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
        }
        // Mảng (danh sách) các đối tượng Category Model

        return $categorys;
    }
}