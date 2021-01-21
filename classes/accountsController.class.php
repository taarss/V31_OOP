<?php 
    include_once 'account.class.php';
    class AccountController extends Account{
        public function updateAccountResetCode($code, $email)
        {
            $this->updateResetCode($code, $email);
        }
        public function updatePassword($password, $email){
            $this->updateAccountPassword($password, $email);
        }
    }