<?php
include_once 'api.class.php';
    class ApiController extends Api{
        public function deleteApiKey($id){
            $this->deleteKey($id);
        }
        public function generateNewKey(){
            $bytes = random_bytes(24);
            $key = bin2hex($bytes);
            $this->generateKey($key);
            header('Location: ../adminPanel.php');
        }
    }