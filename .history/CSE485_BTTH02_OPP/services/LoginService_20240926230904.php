<?php 
include("configs/DBConnection.php");
include("models/Login.php");
    class LoginService {
        
        public function getUser($username) {
            $dbConn = new DBConnection();
            $conn = $dbConn->getConnection();
        
            $sql = "SELECT * FROM tai_khoan WHERE ten_dang_nhap = :username";
            $temp = $conn->prepare($sql);
            $temp->execute(['username' => $username]);
        
            // Lấy dữ liệu người dùng
            $users = $temp->fetch(PDO::FETCH_ASSOC);
            
            // Kiểm tra nếu không tìm thấy người dùng
            if (!$users) {
                return null; // Nếu không có người dùng, trả về null
            }
            return $users;
        }
        

        public function verifyPw($usrname,$pw){
            $user = $this -> getUser($usrname);
            if($user && $pw === $user['pw']){
                return true;
            }
            else{
                return false;
            }
        }
    }
?>