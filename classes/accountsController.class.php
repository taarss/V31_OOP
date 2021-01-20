<?php 
    class AccountController extends Account{
        public function updateAccountResetCode($code, $email)
        {
            $this->updateResetCode($code, $email);
        }
    }