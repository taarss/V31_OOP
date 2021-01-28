<?php
    include_once '../classes/categoriesview.class.php';
    include_once '../classes/productController.php';
    $categoryView = new CategoriesView();
    $productController = new ProductController();
    if (isset($_POST['getCategories'])) {
        $result = $categoryView->getAllCategories();
        echo json_encode($result);
    }
    if (isset($_POST['post_price'])) {
        $productController->addNewProduct($_SESSION['id'], $_POST['post_name'], $_POST['post_price'], $_POST['post_description'], $_POST['post_manufactur'], $_POST['post_type'], $_POST['clothingsex'], $_FILES);      
    }
    