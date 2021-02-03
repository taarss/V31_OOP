<?php
    include_once 'db.class.php';
    class Categories extends Db{
        //Get all categories
        protected function getCategories(){
            $sql = "SELECT * FROM categories";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute();
            $results = $stmt->fetchAll();
            return $results;
        }
        //Update category
        protected function updateCategory($name, $id, $icon){
            if ($icon != null) {
                $sql = "UPDATE categories SET name = ?, icon = ? WHERE id = ?";
                $stmt = $this->connect()->prepare($sql);
                $stmt->execute([$name, $icon, $id]);
            }
            else {
                $sql = "UPDATE categories SET name = ? WHERE id = ?";
                $stmt = $this->connect()->prepare($sql);
                $stmt->execute([$name, $id]);
            }
        }
        protected function createCategory($name, $icon){
            $sql = "INSERT INTO categories (name, icon) VALUES (?, ?)";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$name, $icon]);
        }
        //Delete category
        protected function deleteCategory($id, $productRelation){
            $sql = "DELETE FROM categories WHERE id = ?";
            if ($productRelation == "1") {
                $sql = "DELETE categories, products FROM categories  
                INNER JOIN products ON categories.id=products.type  
                WHERE categories.id = ?";
            }
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$id]);
        }
    }