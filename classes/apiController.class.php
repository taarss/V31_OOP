<?php
include_once 'api.class.php';
include_once 'logController.class.php';
    class ApiController extends Api{
        public $LogController;
        function __construct() {
            $this->AccessLevel = new AccessLevel($_SESSION['id']);
            $this->LogController = new LogController();
        }
        public function deleteApiKey($id){
            if ($this->AccessLevel->validateLevel('manage_api')) {
                $this->deleteKey($id);
                $this->LogController->createNewLog("deleted api key[" . $id ."]");
            }
            else {
                echo 'You do not have permission to perform this action';
            }
        }
        public function generateNewKey(){
            if ($this->AccessLevel->validateLevel('manage_api')) {
                $bytes = random_bytes(24);
                $key = bin2hex($bytes);
                $this->generateKey($key);
                $this->LogController->createNewLog("generated a new api key");
                header('Location: ../adminPanel.php');
            }
            else {
                echo 'You do not have permission to perform this action';
            }
        }
        public function updateApiLock($bool){
            if ($this->AccessLevel->validateLevel('manage_api')) {
                $this->updateLock($bool);
                $this->LogController->createNewLog("updated the api lock to bool(". $bool .")");

            }
            else {
                echo 'You do not have permission to perform this action';
            }
        }
    }