<?php
class Category{
    // Thuộc tính

    private $category_id;
    private $category_name;


    public function __construct($category_id,$category_name){
        $this->category_id = $category_id;
        $this->category_name = $category_name;
    }

    // Setter và Getter
    public function get_Category_id(){
        return $this->category_id;
    }
}