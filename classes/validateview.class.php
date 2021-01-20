<?php 
    include 'validate.class.php';
    class ValidateView extends Validate{
        public function login($username, $password){
            $result = $this->validateLogin($username, $password);
            if ($result[0] == true) {
                header('Location: ../index.php');
            }
            else {
                echo $result[1];
            }
            
        }
    }