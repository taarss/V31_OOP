<?php
header("Content-Type:application/json");
    include_once 'include/startSession.php';
    include_once 'classes/apiview.class.php';
    include_once 'classes/productview.php';
    $key= $_GET['key'];
    $apiView = new ApiView();
    $isLocked = $apiView->checkApiLock();
    if ($key == null && $isLocked == 1) {
        echo "NO API KEY GIVEN ERR 400";
    }
    else {
        if (!$apiView->validateApiKey($key) && $isLocked == 1) {
            echo "INCORRECT API KEY ERR 401";
        }
        else {
            $productView = new ProductView();
            $result = $productView->getAllproducts();
            $json=json_encode($result, JSON_PRETTY_PRINT);
            echo $json;
        }
    }
