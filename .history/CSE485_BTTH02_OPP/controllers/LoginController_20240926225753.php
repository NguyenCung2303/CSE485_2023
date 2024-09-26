<?php 
    include("services/UserService.php");
    class UserController{
        public function index(){
            include("views/login/index.php");
        } 
        public function login(){
            $userName = $_POST['username'];
            $pw = $_POST['password'];
            $userObj = new UserService();
            $getUser = $userObj -> getUser($userName);
            if($getUser == null){
                header("Location: index.php?controller=user&msg=Vui lòng nhập đúng tên người dùng");
            }
            else{
                if($userObj->verifyPw($userName,$pw)){
                    header("Location: index.php?controller=admin");
                }
                else{
                    header("Location: index.php?controller=user&msg=Vui lòng nhập đúng mật khẩu");
                }
            }
        }
    }
?>