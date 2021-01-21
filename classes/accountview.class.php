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
    }