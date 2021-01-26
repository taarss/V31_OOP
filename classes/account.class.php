<?php
    include_once 'db.class.php';
    class Account extends Db{
        //View
        protected function getAccountFromEmail($email){
            $sql = "SELECT * FROM accounts WHERE email = ?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$email]);
            $results = $stmt->fetchAll();
            return $results;
        }
        protected function getAccountFromEmailAndResetCode($email, $code){
            $sql = "SELECT * FROM accounts WHERE email = ? AND reset = ?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$email, $code]);
            $results = $stmt->fetchAll();
            return $results;
        }
        protected function getAccountActivateCode($email, $activasion_code){
            $sql = "SELECT * FROM accounts WHERE email = ? AND activation_code = ?";
            $stmt = $this->connect()->prepare($sql);                                                                                                                                                               
            $stmt->execute([$email, $activasion_code]);
            $results = $stmt->fetchAll();
            return $results;
        }
        protected function getAccountFromUsernameAndEmail($username, $email){
            $sql = "SELECT * FROM accounts WHERE email = ? OR email = ?";
            $stmt = $this->connect()->prepare($sql);                                                                                                                                                               
            $stmt->execute([$username, $email]);
            $results = $stmt->fetchAll();
            return $results;
        }
        protected function getAccountAdminLevel($id){
            $sql = "SELECT adminLevel FROM accounts WHERE id = ?";
            $stmt = $this->connect()->prepare($sql);                                                                                                                                                               
            $stmt->execute([$id]);
            $results = $stmt->fetchAll();
            return $results;
        }

        //controller
        protected function updateResetCode($code, $email){
            $sql = "UPDATE accounts SET reset = ? WHERE email = ?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$code, $email]);
        }
        protected function updateAcivationCode($email, $code){
            $sql = "UPDATE accounts SET activation_code = ? WHERE email = ? AND activation_code = ?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute(['activated',$email, $code]);
        }
        protected function updateAccountPassword($password, $email){
            $password = password_hash($password, PASSWORD_DEFAULT);
            $sql = 'UPDATE accounts SET password = ?, reset = "" WHERE email = ?';
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$password, $email]);            
        }
        protected function createNewAccount($username, $password, $email, $uniqid){
            $sql = 'INSERT INTO accounts SET username = ?, password = ?, email = ?, activation_code = ?';
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$username, $password, $email, $uniqid]);
        }


        //Methods
        protected function checkIfLoggedIn(){
            if (!isset($_SESSION['loggedin'])) {
                header('Location: index.php');
                exit;
            }
        }
    }