<?php
    include_once 'analytics.class.php';
    class analyticsView extends analytics{
        public function getAllfrequentProduct(){
            $result = $this->getfrequentProduct();
            return $result;
        }
        public function getAllFrequentVisitors(){
            $result = $this->getvisitorLocation();
            return $result;
        }
    }