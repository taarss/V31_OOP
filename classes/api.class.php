<?php 
    include_once 'db.class.php';
    include_once 'accountview.class.php';
    class Api extends Db{
        protected function getApiKeys(){
            $sql = "SELECT * FROM apiKey";
            $stmt = $this->connect()->prepare($sql);                                                                                                                                                               
            $stmt->execute();
            $results = $stmt->fetchAll();
            return $results;
        }
        protected function generateKey($key){
            $sql = 'INSERT INTO apiKey SET apiKey = ?';
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$key]);
        }
        protected function deleteKey($id){
            $sql = 'DELETE FROM apiKey WHERE id = ?';
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$id]);
        }
        protected function validateKey($key){
            $sql = "SELECT * FROM apiKey WHERE apiKey = ?";
            $stmt = $this->connect()->prepare($sql);                                                                                                                                                               
            $stmt->execute([$key]);
            $results = $stmt->fetchAll();
            return $results;
        }
    }