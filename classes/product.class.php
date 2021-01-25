<?php
    include_once 'db.class.php';
    class Product extends Db{
        protected function getAllProductsOfCategory($category){
            $sql = "SELECT * FROM products WHERE type = ?";
            $stmt = $this->connect()->prepare($sql);                                                                                                                                                               
            $stmt->execute([$category]);
            $results = $stmt->fetchAll();
            return $results;
        }
        protected function getEveryProduct(){
            $sql = "SELECT * FROM products";
            $stmt = $this->connect()->prepare($sql);                                                                                                                                                               
            $stmt->execute();
            $results = $stmt->fetchAll();
            return $results;
        }
    }