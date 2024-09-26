<?php 
include("configs/DBConnection.php");
include("models/Login.php");
    class LoginService {
        
        public function getUser($username){
            $dbConn = new DBConnection();
            $conn = $dbConn->getConnection();

            $sql = "SELECT * FROM tai_khoan WHERE ten = :username";
            $temp = $conn-> prepare($sql);
            $temp -> execute(['username' => $username]);
            
            $users = $temp->fetch();
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