<?php 
    class AccountView extends Account{
        public function getAccountFromEmailAssoc($email){
            $account = $this->getAccountFromEmail($email);
            return $account;
        }
    }