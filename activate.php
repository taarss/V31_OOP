<?php
include_once 'classes/accountview.class.php';
include_once 'classes/accountsController.class.php';
$msg = '';
if (isset($_GET['email'], $_GET['code']) && !empty($_GET['code'])) {
	$accountView = new AccountView();
	if ($accountView->getAccountFromActivateCode($_GET['email'], $_GET['code'])) {
		$accountController = new AccountController();
		$accountController->updateAcivateCode($_GET['email'], $_GET['code']);
		$msg = 'Your account is now activated, you can now login!<br><a href="index.php">Login</a>';
	} else {
		$msg = 'The account is already activated or doesn\'t exist!';
	}
} else {
	$msg = 'No code and/or email was specified!';
}
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,minimum-scale=1">
	<title>Activate Account</title>
	<link href="style.css" rel="stylesheet" type="text/css">
</head>

<body class="loggedin">
	<div class="content">
		<p><?= $msg ?></p>
	</div>
</body>

</html>