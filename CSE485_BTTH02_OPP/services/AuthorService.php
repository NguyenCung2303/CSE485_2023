<?php
include("configs/DBConnection.php");
include("models/Author.php");
class AuthorService{
    public function getAllAuthors(){
        // 4 bước thực hiện
       $dbConn = new DBConnection();
       $conn = $dbConn->getConnection();

        // B2. Truy vấn
        $sql = "SELECT * FROM tacgia ";
        $stmt = $conn->query($sql);

        // B3. Xử lý kết quả
        $authors = [];
        while($row = $stmt->fetch()){
            $author = new Author($row['ma_tgia'],$row['ten_tgia']);
            array_push($authors,$author);
        }
        // Mảng (danh sách) các đối tượng Article Model

        return $authors;
    }
}