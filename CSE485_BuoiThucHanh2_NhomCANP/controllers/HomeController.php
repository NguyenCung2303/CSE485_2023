<?php
<<<<<<< HEAD
include_once "services/ArticleService.php";
include_once "services/CategoryService.php";
class HomeController{
    // Hàm xử lý hành động index
    public function index(){
        //Article
        // Nhiệm vụ 1: Tương tác với Services/Models
         $articelService = new ArticleService();
         $articles = $articelService->getAllArticles();
        // Nhiệm vụ 2: Tương tác với View

        //Category
        // Nhiệm vụ 1: Tương tác với Services/Models
        $categoryService = new CategoryService();
        $categorys = $categoryService->getAllCategory();
        // Nhiệm vụ 2: Tương tác với View
        include "/xampp/htdocs/CANP/CSE485_BuoiThucHanh2_NhomCANP/views/home/index.php";
=======
class HomeController{
    // Hàm xử lý hành động index
    public function index(){
        include("views/home/index.php");
>>>>>>> origin/btth02_qa
    }
}