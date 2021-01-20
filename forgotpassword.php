<?php
include 'include/startSession.inc.php';
include 'classes/accountview.class.php';
    if(isset($_POST['email'])) {
        $account = new AccountView();
        if ($account->getAccountFromEmailAssoc($_POST['email'])) {
            $uniqid = uniqid();
            $updateAccount = new AccountController();
            $updateAccount->updateResetCode($uniqid, $_POST['email']);
            $reset_link = 'https://christianvillads.tech/opgaver/V31_Examen/resetpassword.php?email=' . $_POST['email'] . '&code=' . $uniqid;
            $email = new Email();
            $email->sendEmail('Password Reset', $reset_link ,'Please click the following link to reset your password', $_POST['email']);
            echo "An email with a reset link has been sent";
        }
        else {
            echo 'No account with that email could be found';
        }
    }
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,minimum-scale=1">
    <title>Forgot Password</title>
    <link href="style.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
</head>

<body>
    <div class="login">
        <h1>Forgot Password</h1>
        <form class="forgotPassword" action="forgotpassword.php" method="post">
            <input type="email" name="email" placeholder="Your Email" id="email" required>
            <div class="msg"><?= $msg ?></div>
            <input type="submit" value="Submit">
        </form>
    </div>
</body>

</html>