<?php

use function PHPSTORM_META\elementType;
    include_once 'logController.class.php';
    include_once 'account.class.php';
    include_once 'accesslevel.class.php';
    class AccountController extends Account{
        public $AccessLevel;
        public $LogController;
        function __construct() {
            $this->AccessLevel = new AccessLevel($_SESSION['id']);
            $this->LogController = new LogController();
        }
        public function updateAccountResetCode($code, $email){
            $this->updateResetCode($code, $email);
        }
        public function updatePassword($password, $email){
            $this->updateAccountPassword($password, $email);
        }
        public function createAccount($username, $password, $email, $uniqid){
            $this->createNewAccount($username, $password, $email, $uniqid);
        }
        public function updateAcivateCode($email, $code){
            $this->updateAcivationCode($email, $code);
        }
        public function updateAccountAdminStatus($id, $status){
            if ($this->AccessLevel->validateLevel('manage_accessLevel')) {
                $this->updateAdminStatus($id, $status);
                $this->LogController->createNewLog("promoted a user[" . $id ."] to admin");
                
            }
            else {
                echo 'You do not have permission to perform this action';
            }
        }
        public function updateUserBan($banUpdate, $id){
            if ($this->AccessLevel->validateLevel('manage_accessLevel')) {
                $this->updateBan($banUpdate, $id);
                if ($banUpdate == 1) {
                    $this->LogController->createNewLog("banned a user[" . $id ."]");
                }
                else {
                    $this->LogController->createNewLog("unbanned a user[" . $id ."]");
                }
            }
            else {
                echo 'You do not have permission to perform this action';
            }
        }
        public function updateAdministratorLevel($id, $level){
            if ($this->AccessLevel->validateLevel('manage_accessLevel')) {
                $this->updateAdminLevel($id, $level);
                $this->LogController->createNewLog("updated admin[" . $id ."] access level to " . $level);
            }
            else {
                echo 'You do not have permission to perform this action';
            }
        }
    }