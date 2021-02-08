<?php
header("Content-Type:application/json");
    include_once 'include/startSession.php';
    include_once 'classes/apiview.class.php';
    include_once 'classes/productview.php';
    $key= $_GET['key'];
    if ($key == null) {
        echo "NO API KEY GIVEN ERR 400";
    }
    else {
        $apiView = new ApiView();
        if (!$apiView->validateApiKey($key)) {
            echo "INCORRECT API KEY ERR 401";
        }
        else {
            $productView = new ProductView();
            $result = $productView->getAllproducts();
            $json=json_encode($result, JSON_PRETTY_PRINT);
            echo $json;
        }
    }
