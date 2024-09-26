<?php 
    include("services/LoginService.php");
    class LoginController{
        public function index(){
            include("views/login_form.php");
        } 
        public function login(){
            $userName = $_POST['username'];
            $pw = $_POST['password'];
            $userObj = new LoginService();
            $getUser = $userObj -> getUser($userName);
            if($getUser == null){
                header("Location: index.php?controller=login&msg=Vui lòng nhập đúng tên người dùng");
            }
            else{
                if($userObj->verifyPw($userName,$pw)){
                    header("Location: index.php?controller=admin");
                }
                else{
                    header("Location: index.php?controller=login&msg=Vui lòng nhập đúng mật khẩu");
                }
            }
        }
    }
?>