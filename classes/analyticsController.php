<?php
    include_once 'analytics.class.php';
    class analyticsController extends analytics{
        public function frequentlyViewedProductAddition($productId){
            $this->frequentProductAddition($productId);
        }
        public function setVisitorLocation($city, $region){
            $this->visitorLocation($city, $region);
        }
    }