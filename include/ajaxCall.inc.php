<?php
    include_once '../classes/categoriesController.php';
    include_once '../classes/categoriesview.class.php';
    include_once '../classes/productController.php';
    include_once '../classes/productview.php';
    include_once '../classes/livesearch.class.php';
    $categoryView = new CategoriesView();
    $categoryController = new CategoriesController();
    $productController = new ProductController();
    $productView = new ProductView();
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
        $productController->deleteNewProduct($_POST['id']);
    }
    //Update product
    if (isset($_POST['updateProduct'])) {
        $productController->updateNewProduct($_POST['name'], $_POST['price'], $_POST['description'], $_POST['manufactur'], $_POST['category'], $_POST['clothingsex'], $_FILES, $_POST['id']);
    }
    //Query livesearch result
    if (isset($_POST['livesearch'])) {
        $search = new LiveSearch($_POST['query'], $_POST['category']);
        echo json_encode($search->executeQuery());
    }
    //Get all info regarding showcase products
    if (isset($_POST['productShowcase'])) {
        $productIds = $productView->getAllShowcaseProducts();
        $frontPageProducts = $productView->getAllProductsOfId($productIds);
        echo json_encode($frontPageProducts);
    }
    //Update the frontpage product showcase
    if (isset($_POST['updateShowcase'])) {
        $productController->updateProductShowcase($_POST['productIdArray']);
    }
    if (isset($_POST['updateCategory'])) {
        echo var_dump($_POST);
        $categoryController->updateCategories($_POST['name'], $_POST['id'], $_FILES);
    }
    