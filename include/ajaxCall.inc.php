<?php
    include_once '../classes/categoriesview.class.php';
    include_once '../classes/productController.php';
    include_once '../classes/livesearch.class.php';
    $categoryView = new CategoriesView();
    $productController = new ProductController();
    //Get All Categories
    if (isset($_POST['getCategories'])) {
        $result = $categoryView->getAllCategories();
        echo json_encode($result);
    }
    //Add new product
    if (isset($_POST['post_price'])) {
        $productController->addNewProduct($_SESSION['id'], $_POST['post_name'], $_POST['post_price'], $_POST['post_description'], $_POST['post_manufactur'], $_POST['post_type'], $_POST['clothingsex'], $_FILES);      
    }
    //Delete a product
    if (isset($_POST['deleteProduct'])) {
        
    }
    if (isset($_POST['livesearch'])) {
        $search = new LiveSearch($_POST['query'], $_POST['category']);
        echo json_encode($search->executeQuery());
    }
    