<?php
    include_once 'db.class.php';
    class analytics extends Db{
        protected function frequentProductAddition($producId){
            $sql = "INSERT INTO ANALYTICS_frequent_products (product_id) VALUES (?)";
            $stmt = $this->connect()->prepare($sql);                                                                                                                                                               
            $stmt->execute([$producId[0]]);
        }
        protected function visitorLocation($city, $region){
            $sql = "INSERT INTO ANALYTICS_frequent_visitors (city, region) VALUES (?, ?)";
            $stmt = $this->connect()->prepare($sql);                                                                                                                                                               
            $stmt->execute([$city, $region]);
        }
        
    }