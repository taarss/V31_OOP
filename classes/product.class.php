<?php
    include_once 'db.class.php';
    class Product extends Db{
        //View
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

        //Controller
        protected function addProduct($name, $price, $description, $manufactur, $type, $gender, $file_path){
            echo $file_path;
            $sql = "INSERT INTO products (name, price, description, manufactur, type, img, sex, createdBy) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $this->connect()->prepare($sql);                                                                                                                                                               
            $stmt->execute([$name, $price, $description, $manufactur, $type, $file_path, $gender, $_SESSION['id']]);
            echo 'done';
        }

    }