<?php 
    include_once 'account.class.php';
    class AccountView extends Account{
        public function getAccountFromEmailAssoc($email){
            $result = $this->getAccountFromEmail($email);
            return $result;
        }
        public function getAccountFromEmailAndReset($email, $reset){
            $result = $this->getAccountFromEmailAndResetCode($email, $reset);
            return $result;
        }
        public function getAccountFromEmailAndUsername($email, $username){
            $result = $this->getAccountFromUsernameAndEmail($username, $email);
            return $result;
        }
        public function getAccountFromActivateCode($email, $code){
            $result = $this->getAccountActivateCode($email, $code);
            return $result;
        }
        public function getAdminLevel($id){
            $result = $this->getAccountAdminLevel($id);
            return $result;
        }
        public function checkLoggedIn(){
            $this->checkIfLoggedIn();
        }
    }