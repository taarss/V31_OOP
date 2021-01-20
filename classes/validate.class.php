<?php
    include 'db.class.php';
    class Validate extends Db {
        private $_passed = false;
        private $_errorMsg = null;

        protected function validateLogin($attemptUsername, $attemptPassword){
            if ($this->accountExists($attemptUsername)) {
                $this->_passed = true;
            }
            else {
                $this->_passed = false;
                $this->_errorMsg = "No account with the given username exists";
            }
            if ($this->passwordMatch($attemptUsername, $attemptPassword)) {
                session_regenerate_id();
                $_SESSION['loggedin'] = TRUE;
                $_SESSION['name'] =$attemptUsername;
                $_SESSION['id'] = $this->getIdFromUsername($attemptUsername);
                return array(true);
            }
            else{
                $this->_passed = false;
                return array(false, $this->_errorMsg);
            }
        }

        protected function accountExists($attemptUsername){
            $sql = "SELECT username FROM accounts WHERE username = ?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$attemptUsername]);
            $results = $stmt->fetch();
            if ($results) {
                return true;
            }
            else {
                return false;
            }
        }

        protected function passwordMatch($attemptUsername, $attemptPassword){
            $sql = "SELECT password, activation_code, isBanned FROM accounts WHERE username = ?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$attemptUsername]);
            $results = $stmt->fetch();
            $password = $results['password'];
            if (password_verify($attemptPassword, $password)) {
                if ($results['activation_code'] == 'activated') {
                    if ($results['isBanned'] == 0) {
                       return true;
                    }
                    else {
                        $this->_errorMsg = "Your account is permanently banned";
                        return false;
                    }
                }
                else {
                    $this->_errorMsg = "You must activate your account before logging in";
                    return false;
                }
            }
            else {
                $this->_errorMsg = "Incorrect password";
                return false;
            }
        }

        protected function getIdFromUsername($username){
            $sql = "SELECT id FROM accounts WHERE username = ?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$username]);
            $results = $stmt->fetch();
            return $results;
        }
    }