<?php
include_once '../classes/analyticsController.php';
if (!$_SESSION['loggedin']) {
    session_start(); 
}
if(isset($_POST['checkIfSessionExists'])){
    if(!$_SESSION['location']){
        echo 'false';
    }
    else {
        echo 'true';
    }
}

if(isset($_POST['setLocation'])){
    $_SESSION['location'] = 1;
    $analyticsController = new analyticsController();
    $analyticsController->setVisitorLocation($_POST['city'], $_POST['region']);
    echo "efdfdf";
}