<?php
    //Categories
    include_once '../classes/categoriesController.php';
    include_once '../classes/categoriesview.class.php';
    //Products
    include_once '../classes/productController.php';
    include_once '../classes/productview.php';
    //Search
    include_once '../classes/livesearch.class.php';
    //Accounts
    include_once '../classes/accountview.class.php';
    include_once '../classes/accountsController.class.php';
    //Access Level
    include_once '../classes/accesslevel.class.php';
    $categoryView = new CategoriesView();
    $categoryController = new CategoriesController();
    $productController = new ProductController();
    $productView = new ProductView();
    $accountView = new AccountView();
    $accountController = new AccountController();
    $accessLevel = new AccessLevel($_SESSION['id']);
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
    //Update a category
    if (isset($_POST['updateCategory'])) {
        $categoryController->updateCategories($_POST['name'], $_POST['id'], $_FILES);
    }
    //Create new category
    if (isset($_POST['createCategory'])) {
        $categoryController->createNewCategory($_POST['post_name'], $_FILES);
    }
    //Delete category
    if (isset($_POST['deleteCategory'])) {
        $categoryController->deleteCategories($_POST['id'], $_POST['productRealation']);
    }
    //Get none administrator accounts
    if (isset($_POST['getNoneAdminAccounts'])) {
        $result = $accountView->getAllNoneAdminAccount();
        echo json_encode($result);
    }
    if (isset($_POST['getAllAdminAccounts'])) {
        $result = $accountView->getAllAdminAccounts();
        echo json_encode($result);
    }
    //Update admin status
    if (isset($_POST['updateAdminStatus'])) {
        $accountController->updateAccountAdminStatus($_POST['user'], $_POST['status']);
    }
    //Ban/unban user
    if (isset($_POST['updateBan'])) {
        $accountController->updateUserBan($_POST['banUpdate'], $_POST['user']);
    }
    //Update admin level
    if (isset($_POST['updateAdminLevel']) or isset($_POST['demoteAdmin'])) {
        $accountController->updateAdministratorLevel($_POST['user'], $_POST['level']);
    }
    //Get Access levels
    if (isset($_POST['getAccessLevels'])) {
        $result = $accessLevel->getAllAccessLevels();
        echo json_encode($result);
    }
    //Update Access level permissions
    if (isset($_POST['updateAccessLevelPermissions'])) {
        echo var_dump($_POST);
        $result = $accessLevel->updateAccessLevel($_POST['manageProductsRadio'], $_POST['manageCategoriesRadio'], $_POST['manageApiRadio'], $_POST['manageAccessLevelRadio'], $_POST['id']);
    }
    