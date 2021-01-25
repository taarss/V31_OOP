<?php
    include_once 'db.class.php';
    class Categories extends Db{
        protected function getCategories(){
            $sql = "SELECT * FROM categories";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute();
            $results = $stmt->fetchAll();
            return $results;
        }
    }