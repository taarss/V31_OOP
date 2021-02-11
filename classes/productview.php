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
        public function getAllShowcaseProducts(){
            $result = $this->getShowcaseProducts();
            return $result;
        }
        public function getAllProductsOfId($id){
            $result = $this->getProductsOfId($id);
            return $result;
        }
        public function getRandomProduct($category){
            $result = $this->getRandomProducts($category);
            return $result;
        }
    }