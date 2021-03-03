<?php
    include_once 'db.class.php';
    class Product extends Db{
        //View
        //Get all products of specifed category
        protected function getAllProductsOfCategory($category){
            $sql = "SELECT * FROM products WHERE type = ?";
            $stmt = $this->connect()->prepare($sql);                                                                                                                                                               
            $stmt->execute([$category]);
            $results = $stmt->fetchAll();
            return $results;
        }
        //Get all products
        protected function getEveryProduct(){
            $sql = "SELECT * FROM products";
            $stmt = $this->connect()->prepare($sql);                                                                                                                                                               
            $stmt->execute();
            $results = $stmt->fetchAll();
            return $results;
        }
        //Get all showcase products
        protected function getShowcaseProducts(){
            $sql = "SELECT productId FROM product_showcase";
            $stmt = $this->connect()->prepare($sql);                                                                                                                                                               
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_COLUMN);
            return $results;
        }
        //Get all products of given id/ids
        protected function getProductsOfId($id){

            $sql = "SELECT * FROM products WHERE id IN (" . implode(',', array_map('intval', $id)) . ')';
            $stmt = $this->connect()->prepare($sql);                                                                                                                                                               
            $stmt->execute($id);
            $results = $stmt->fetchAll();
            return $results;
        }
        protected function getRandomProducts($category){
            $sql = "SELECT * FROM products WHERE type = ? ORDER BY RAND()
            LIMIT 6";
             $stmt = $this->connect()->prepare($sql);                                                                                                                                                               
             $stmt->execute([$category]);
             $results = $stmt->fetchAll();
             return $results;
        }
        //Controller
        //Add new Product
        protected function addProduct($name, $price, $description, $manufactur, $type, $gender, $file_path){
            $sql = "INSERT INTO products (name, price, description, manufactur, type, img, sex, createdBy) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $this->connect()->prepare($sql);                                                                                                                                                               
            $stmt->execute([$name, $price, $description, $manufactur, $type, $file_path, $gender, $_SESSION['id']['id']]);;
        }
        //Update product
        protected function updateProduct($name, $price, $description, $manufactur, $type, $gender, $file_path, $id){
            if ($file_path != null) {
                $sql = "UPDATE products SET name = ?, price = ?, description = ?, manufactur = ?, type = ?, img = ?, sex = ? WHERE id = ?"; 
                $stmt = $this->connect()->prepare($sql);                                                                                                                                                               
                $stmt->execute([$name, $price, $description, $manufactur, $type, $file_path, $gender, $id]);
            }
            else{
                $sql = "UPDATE products SET name = ?, price = ?, description = ?, manufactur = ?, type = ?, sex = ? WHERE id = ?"; 
                $stmt = $this->connect()->prepare($sql);                                                                                                                                                               
                $stmt->execute([$name, $price, $description, $manufactur, $type, $gender, $id]);
            }
            
        }
        //Delete product
        protected function deleteProduct($id){
            $sql = "DELETE FROM products WHERE id = ?";
            $stmt = $this->connect()->prepare($sql);                                                                                                                                                               
            $stmt->execute([$id]);
        }
        protected function updateShowcase($productIdArray){
            $index = 1;
            foreach ($productIdArray as $key) {
                $sql = "UPDATE product_showcase SET productId = ? WHERE id = ?";
                $stmt = $this->connect()->prepare($sql);                                                                                                                                                               
                $stmt->execute([$key, $index]);
                $index++;
            }
        }

    }