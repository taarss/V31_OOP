<?php
    include_once 'api.class.php';
    class ApiView extends Api{
        public function getAllApiKeys(){
            $result = $this->getApiKeys();
            return $result;
        }
        public function validateApiKey($key){
            $result = $this->validateKey($key);
            if ($result) {
                return true;
            }
            else {
                return false;
            }
        }
    }