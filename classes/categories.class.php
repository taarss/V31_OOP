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
        //Get all head categories
        protected function getHeadCategories(){
            $sql = "SELECT * FROM head_categories";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute();
            $results = $stmt->fetchAll();
            return $results;
        }
        //Get all categories within the given head category
        protected function getCategoriesOfHeadCategories($head){
            $sql = "SELECT * FROM categories WHERE headCategory = ?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$head]);
            $results = $stmt->fetchAll();
            return $results;
        }
        //Update category
        protected function updateCategory($name, $id, $icon, $headCategory){
            if ($icon != null) {
                $sql = "UPDATE categories SET name = ?, icon = ?, headCategory = ? WHERE id = ?";
                $stmt = $this->connect()->prepare($sql);
                $stmt->execute([$name, $icon, $headCategory, $id]);
            }
            else {
                $sql = "UPDATE categories SET name = ?, headCategory = ? WHERE id = ?";
                $stmt = $this->connect()->prepare($sql);
                $stmt->execute([$name, $headCategory, $id]);
            }
        }
        protected function updateHeadCategory($name, $id, $icon){
            if ($icon != null) {
                $sql = "UPDATE head_categories SET name = ?, icon = ? WHERE id = ?";
                $stmt = $this->connect()->prepare($sql);
                $stmt->execute([$name, $icon, $id]);
            }
            else {
                $sql = "UPDATE head_categories SET name = ? WHERE id = ?";
                $stmt = $this->connect()->prepare($sql);
                $stmt->execute([$name, $id]);
            }
        }
        //Create category
        protected function createCategory($name, $icon, $headCategory){
            $sql = "INSERT INTO categories (name, icon, headCategory) VALUES (?, ?, ?)";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$name, $icon, $headCategory]);
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
        //Delete head category
        protected function deleteHeadCategory($id, $productRelation){
            $sql = "DELETE FROM head_categories WHERE id = ?";
            if ($productRelation == "1") {
                $relation = "DELETE categories, products FROM categories  
                INNER JOIN products ON categories.id=products.type  
                WHERE categories.headCategory = ?";
                $stmt = $this->connect()->prepare($relation);
                $stmt->execute([$id]);
            }
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$id]);
        }
        //Create head category
        protected function createHeadCategory($name, $icon){
            $sql = "INSERT INTO head_categories (name, icon) VALUES (?, ?)";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$name, $icon]);
        }
    }

