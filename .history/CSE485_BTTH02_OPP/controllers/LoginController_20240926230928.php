<?php 
    include("services/LoginService.php");
    class LoginController{
        public function index(){
            include("views/login_form.php");
        } 
        public function login() {
            $userName = $_POST['username'] ?? ''; // Thêm ?? để đảm bảo biến không null
            $pw = $_POST['password'] ?? ''; // Thêm ?? để đảm bảo biến không null
            
            $userObj = new LoginService();
            $getUser = $userObj->getUser($userName);
        
            if ($getUser == null) {
                header("Location: index.php?controller=login&msg=Vui lòng nhập đúng tên người dùng");
                exit; // Thêm exit sau header để dừng thực thi
            } else {
                if ($userObj->verifyPw($userName, $pw)) {
                    header("Location: index.php?controller=admin");
                    exit; // Thêm exit sau header để dừng thực thi
                } else {
                    header("Location: index.php?controller=login&msg=Vui lòng nhập đúng mật khẩu");
                    exit; // Thêm exit sau header để dừng thực thi
                }
            }
        }
        
    }
?>