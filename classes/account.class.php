<?php
    include_once 'db.class.php';
    class Account extends Db{
        //View
        public function getAccountFromEmail($email){
            $sql = "SELECT * FROM accounts WHERE email = ?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$email]);
            $results = $stmt->fetchAll();
            return $results;
        }
        public function getAccountFromEmailAndResetCode($email, $code){
            $sql = "SELECT * FROM accounts WHERE email = ? AND reset = ?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$email, $code]);
            $results = $stmt->fetchAll();
            return $results;
        }

        //controller
        public function updateResetCode($code, $email){
            $sql = "UPDATE accounts SET reset = ? WHERE email = ?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$code, $email]);
        }
        public function updateAccountPassword($password, $email){
            $password = password_hash($password, PASSWORD_DEFAULT);
            $sql = 'UPDATE accounts SET password = ?, reset = "" WHERE email = ?';
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$password, $email]);
        }

    }