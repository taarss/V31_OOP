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
        protected function getfrequentProduct(){
            $sql = "SELECT  `product_id`,
            COUNT(`product_id`) AS `value_occurrence` 
            FROM     `ANALYTICS_frequent_products`
            GROUP BY `product_id`
            ORDER BY `value_occurrence` DESC 
            LIMIT 10";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute();
            $results = $stmt->fetchAll();
            return $results;
        }
        protected function getvisitorLocation(){
            $sql = "SELECT  `city`, `region`,
            COUNT(`city`) AS `value_occurrence` 
            FROM     `ANALYTICS_frequent_visitors`
            GROUP BY `city`
            ORDER BY `value_occurrence` DESC 
            LIMIT 10";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute();
            $results = $stmt->fetchAll();
            return $results;
        }
        
    }