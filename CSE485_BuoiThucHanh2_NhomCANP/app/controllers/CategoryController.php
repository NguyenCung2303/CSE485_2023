<?php
require_once '../models/CategoryModel.php';

class CategoryController {
    private $categoryModel;

    public function __construct($db) {
        $this->categoryModel = new CategoryModel($db);
    }

    public function index() {
        $categories = $this->categoryModel->getAllCategories();
        include '../views/category/index.php';
    }
}
?>