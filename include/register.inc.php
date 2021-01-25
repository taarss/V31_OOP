<?php
    include '../classes/accountview.class.php';
    include '../classes/accountsController.class.php';
    include '../classes/email.class.php';

    //Validate Input
    if (!isset($_POST['username'], $_POST['password'], $_POST['email'])) {
        echo var_dump($_POST);
        exit('Please complete the registration form!');
    }
    if (empty($_POST['username']) || empty($_POST['password']) || empty($_POST['email'])) {
        exit('Please complete the registration form');
    }
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        exit('Email is not valid!');
    }
    if (preg_match('/[A-Za-z0-9]+/', $_POST['username']) == 0) {
        exit('Username is not valid!');
    }
    if (strlen($_POST['password']) > 20 || strlen($_POST['password']) < 5) {
        exit('Password must be between 5 and 20 characters long!');
    }
    $accountView = new AccountView();
    if($accountView->getAccountFromEmailAndUsername($_POST['email'], $_POST['username'])){
        exit('Username and/or email already exists');
    }
    else {
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $uniqid = uniqid();
        $accountController = new AccountController();
        $accountController->createAccount($_POST['username'], $password, $_POST['email'], $uniqid);
        $activate_link = 'https://Christianvillads.tech/opgaver/V31_OOP/activate.php?email=' . $_POST['email'] . '&code=' . $uniqid;
        $email = new Email("Account Activation Required", $activate_link, 'Please click the following link to activate your account:', $_POST['email']);
        $email->sendEmail();
        
    }