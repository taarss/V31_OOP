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
    }