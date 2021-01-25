<?php 
include 'accountview.class.php';
include 'accountsController.class.php';
class Resetpassword{
    private $password;
    private $email;
    private $matchPassword;
    private $code;
    public $errMsg;

    function __construct($password, $email, $matchPassword, $code) {
        $this->password = $password;
        $this->email = $email;
        $this->matchPassword = $matchPassword;
        $this->code = $code;
      }
    
      function  validateReset(){
          $accountView = new AccountView;
          if ($accountView->getAccountFromEmailAndResetCode($this->email, $this->code)) {
            if (isset($this->email, $this->password)) {
                if (strlen($this->password) > 20 || strlen($this->password) < 5) {
                    $this->errMsg = 'Password must be between 5 and 20 characters long!';
                } else if ($this->password != $this->matchPassword) {
                    $this->errMsg = 'Passwords must match!';
                } else {
                    $accountController = new AccountController();
                    try {
                        $accountController->updatePassword($this->password, $this->email);
                        $this->errMsg = 'test';
                    }
                    catch(Exception $e) {
                        $this->errMsg = 'Message: ' . $e->getMessage();
                    }
                    $this->errMsg = 'Password has been reset! You can now <a href="index.php">login</a>!';
                }
            }
            }
            else {
                $this->errMsg = 'Incorrect email and/or code!';
            }
      }
    
}