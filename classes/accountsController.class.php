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
        public function createAccount($username, $password, $email, $uniqid){
            $this->createNewAccount($username, $password, $email, $uniqid);
        }
        public function updateAcivateCode($email, $code){
            $this->updateAcivationCode($email, $code);
        }
        public function updateAccountAdminStatus($id, $status){
            $this->updateAdminStatus($id, $status);
        }
        public function updateUserBan($banUpdate, $id){
            $this->updateBan($banUpdate, $id);
        }
    }