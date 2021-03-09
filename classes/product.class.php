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
        //Get head category of products
        protected function getAllProductsOfHeadAndSub($headcategory, $subcategory){
            //Select all products where their sub category is apart of the given head category
            /*$sql = "SELECT * FROM products INNER JOIN categories ON products.type = categories.id 
            WHERE categories.headCategory = ?";*/
            $sql = "";
            if ($subcategory == 0) {
                $sql = "SELECT p.id, p.name, p.price, p.img FROM products AS p INNER JOIN categories AS s ON p.type = s.id WHERE
                s.headCategory = ? ";
                $stmt = $this->connect()->prepare($sql);                                                                                                                                                               
                $stmt->execute([$headcategory]);
                $results = $stmt->fetchAll(); 
                return $results;
            }
            else{
                $sql = "SELECT p.id, p.name, p.price, p.img FROM products AS p INNER JOIN categories AS s ON p.type = s.id WHERE
                s.headCategory = ? AND s.id = ?";
                $stmt = $this->connect()->prepare($sql);                                                                                                                                                               
                $stmt->execute([$headcategory, $subcategory]);
                $results = $stmt->fetchAll(); 
                return $results;
            }
        }
        //Controller
        //Add new Product
        protected function addProduct($name, $price, $description, $manufactur, $type, $file_path){
            
            $sql = "INSERT INTO products (name, price, description, manufactur, type, img,  createdBy) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $this->connect()->prepare($sql);                                                                                                                                                               
            $stmt->execute([$name, $price, $description, $manufactur, $type, $file_path,  $_SESSION['id']['id']]);;
        }
        //Update product
        protected function updateProduct($name, $price, $description, $manufactur, $type,  $file_path, $id){
            if ($file_path != null) {
                $sql = "UPDATE products SET name = ?, price = ?, description = ?, manufactur = ?, type = ?, img = ? WHERE id = ?"; 
                $stmt = $this->connect()->prepare($sql);                                                                                                                                                               
                $stmt->execute([$name, $price, $description, $manufactur, $type, $file_path, $id]);
            }
            else{
                $sql = "UPDATE products SET name = ?, price = ?, description = ?, manufactur = ?, type = ? WHERE id = ?"; 
                $stmt = $this->connect()->prepare($sql);                                                                                                                                                               
                $stmt->execute([$name, $price, $description, $manufactur, $type,  $id]);
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