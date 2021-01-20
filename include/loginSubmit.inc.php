<?php 

    include '../classes/validateview.class.php';
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $login = new ValidateView();
        $login->login($_POST['username'], $_POST['password']);
    }
    