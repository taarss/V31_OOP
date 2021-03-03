<?php
    include_once '../classes/settingsController.php';
    if (isset($_POST['websiteName'])) {
        $settingsController = new SettingsController();
        $settingsController->writeSetting($_POST);
        unlink('installSettings.php');
        header("Location: ../index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="installSettings">
    <div>
        <h3>Enter site infomation</h3>
        <div>
            <form method="POST" enctype="multipart/form-data" action="installSettings.php">
                <label>
                    <p>Site name</p>
                    <input type="text" placeholder="my awesome website..." required name="websiteName">
                </label>
                <label>
                    <p>Logo  50x50 px</p>
                    <input type="file" required name="post_img">
                </label>
                <label>
                    <p>Address</p>
                    <input type="text" placeholder="Cool place 23 9400" required name="address">
                </label>
                <label>
                    <p>Slogan</p>
                    <input type="text" placeholder="Buy our stuff idk..." required name="slogan">
                </label>
                <label>
                    <p>Contact email</p>
                    <input type="text" placeholder="Your Email address" required name="email">
                </label>
                <input class="submit" type="submit" value="Submit">
            </form>
        </div>
    </div>
</body>
</html>