<?php
    include_once 'db.class.php';
    class Account extends Db{
        //View
        //Get account from email
        protected function getAccountFromEmail($email){
            $sql = "SELECT * FROM accounts WHERE email = ?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$email]);
            $results = $stmt->fetchAll();
            return $results;
        }
        //Get and validate account from email and given reset code
        protected function getAccountFromEmailAndResetCode($email, $code){
            $sql = "SELECT * FROM accounts WHERE email = ? AND reset = ?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$email, $code]);
            $results = $stmt->fetchAll();
            return $results;
        }
        //get account from email and given activation code
        protected function getAccountActivateCode($email, $activasion_code){
            $sql = "SELECT * FROM accounts WHERE email = ? AND activation_code = ?";
            $stmt = $this->connect()->prepare($sql);                                                                                                                                                               
            $stmt->execute([$email, $activasion_code]);
            $results = $stmt->fetchAll();
            return $results;
        }
        //Get account from username and email
        protected function getAccountFromUsernameAndEmail($username, $email){
            $sql = "SELECT * FROM accounts WHERE email = ? OR email = ?";
            $stmt = $this->connect()->prepare($sql);                                                                                                                                                               
            $stmt->execute([$username, $email]);
            $results = $stmt->fetchAll();
            return $results;
        }
        //Get the given accounts administrator level
        protected function getAccountAdminLevel($id){
            $sql = "SELECT adminLevel FROM accounts WHERE id = ?";
            $stmt = $this->connect()->prepare($sql);                                                                                                                                                               
            $stmt->execute([$id]);
            $results = $stmt->fetchAll();
            return $results;
        }
        //Get all none admin accounts
        protected function getNoneAdminAccounts(){
            $sql = "SELECT id, username, email, adminLevel, isBanned FROM accounts WHERE adminLevel > 3";
            $stmt = $this->connect()->prepare($sql);                                                                                                                                                               
            $stmt->execute();
            $results = $stmt->fetchAll();
            return $results;
        }

        //controller
        //Update reset code
        protected function updateResetCode($code, $email){
            $sql = "UPDATE accounts SET reset = ? WHERE email = ?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$code, $email]);
        }
        //Activate account
        protected function updateAcivationCode($email, $code){
            $sql = "UPDATE accounts SET activation_code = ? WHERE email = ? AND activation_code = ?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute(['activated',$email, $code]);
        }
        //Update password
        protected function updateAccountPassword($password, $email){
            $password = password_hash($password, PASSWORD_DEFAULT);
            $sql = 'UPDATE accounts SET password = ?, reset = "" WHERE email = ?';
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$password, $email]);            
        }
        //Create new account
        protected function createNewAccount($username, $password, $email, $uniqid){
            $sql = 'INSERT INTO accounts SET username = ?, password = ?, email = ?, activation_code = ?';
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$username, $password, $email, $uniqid]);
        }
        //Update admin status
        protected function updateAdminStatus($id, $status){
            $sql = 'UPDATE accounts SET adminLevel = ? WHERE id = ?';
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$status, $id]); 
            header('Location: ../adminPanel.php');
        }
        //Update ban
        protected function updateBan($banUpdate, $id){
            $sql = 'UPDATE accounts SET isBanned = ? WHERE id = ?';
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$banUpdate, $id]); 
            header('Location: ../adminPanel.php');
        }


        //Methods
        protected function checkIfLoggedIn(){
            if (!isset($_SESSION['loggedin'])) {
                header('Location: index.php');
                exit;
            }
        }
    }