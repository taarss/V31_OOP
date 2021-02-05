<?php

use function PHPSTORM_META\elementType;

    include_once 'account.class.php';
    include_once 'accesslevel.class.php';
    class AccountController extends Account{
        public $AccessLevel;
        function __construct() {
            $this->AccessLevel = new AccessLevel($_SESSION['id']);
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
            }
            else {
                echo 'You do not have permission to perform this action';
            }
        }
        public function updateUserBan($banUpdate, $id){
            if ($this->AccessLevel->validateLevel('manage_accessLevel')) {
                $this->updateBan($banUpdate, $id);
            }
            else {
                echo 'You do not have permission to perform this action';
            }
        }
        public function updateAdministratorLevel($id, $level){
            if ($this->AccessLevel->validateLevel('manage_accessLevel')) {
                $this->updateAdminLevel($id, $level);
            }
            else {
                echo 'You do not have permission to perform this action';
            }
        }
    }