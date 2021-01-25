<?php
include 'classes/resetpassword.class.php';
if (isset($_GET['email'], $_GET['code']) && !empty($_GET['code'])) {
    if (isset($_POST['npassword'], $_POST['cpassword'])) {
        $resetPassword = new Resetpassword($_POST['npassword'], $_GET['email'], $_POST['cpassword'], $_GET['code']);
        $resetPassword->validateReset();
        echo $resetPassword->errMsg;
    }
}
else {
    exit('Please provide the email and code');
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,minimum-scale=1">
    <title>Reset Password</title>
    <link href="style.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
</head>

<body>
    <div class="login">
        <h1>Reset Password</h1>
        <form class="forgotPassword" action="resetpassword.php?email=<?= $_GET['email'] ?>&code=<?= $_GET['code'] ?>" method="post">
            <input type="password" name="npassword" placeholder="New Password" id="npassword" required>
            <input type="password" name="cpassword" placeholder="Confirm Password" id="cpassword" required>
            <div class="msg"><?= $msg ?></div>
            <input type="submit" value="Submit">
        </form>
    </div>
</body>

</html>