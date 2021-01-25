<?php 
    include_once 'product.class.php';
    class ProductView extends Product{
        public function getProductOfCategory($category){
            $result = $this->getAllProductsOfCategory($category);
            return $result;
        }
        public function getAllproducts(){
            $result = $this->getEveryProduct();
            return $result;
        }
    }