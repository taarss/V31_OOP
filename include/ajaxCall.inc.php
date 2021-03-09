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
    //API
    include_once '../classes/apiController.class.php';
    include_once '../classes/apiview.class.php';
    //Logs
    include_once '../classes/logView.class.php';
    $categoryView = new CategoriesView();
    $categoryController = new CategoriesController();
    $productController = new ProductController();
    $productView = new ProductView();
    $accountView = new AccountView();
    $accountController = new AccountController();
    $accessLevel = new AccessLevel($_SESSION['id']);
    $apiController = new ApiController();
    $apiView = new ApiView();
    $logsView = new LogView();
    //Create initial admin
    if (isset($_POST['createInitialAdmin'])) {
        $accountController->createInitialAdmin($_POST['adminName']);
    }
    //Get All Categories
    if (isset($_POST['getCategories'])) {
        $result = $categoryView->getAllCategories();
        echo json_encode($result);
    }
    //Get all head categories
    if (isset($_POST['getHeadCategories'])) {
        $result = $categoryView->getAllHeadCategories();
        echo json_encode($result);
    }
    //Get all categories of the given head category
    if (isset($_POST['getCategoriesOfHead'])) {
        $result = $categoryView->getAllCategoriesOfHeadCategory($_POST['headCategory']);
        echo json_encode($result);

    }
    //Add new product
    if (isset($_POST['post_price'])) {
        $productController->addNewProduct($_SESSION['id'], $_POST['post_name'], $_POST['post_price'], $_POST['post_description'], $_POST['post_manufactur'], $_POST['post_type'], $_FILES);      
    }
    //Delete a product
    if (isset($_POST['deleteProduct'])) {
        $productController->deleteNewProduct($_POST['id']);
    }
    //Update product
    if (isset($_POST['updateProduct'])) {
        $productController->updateNewProduct($_POST['name'], $_POST['price'], $_POST['description'], $_POST['manufactur'], $_POST['category'], $_FILES, $_POST['id']);
    }
    //Query livesearch result
    if (isset($_POST['livesearch'])) {
        $search = new LiveSearch($_POST['query'], $_POST['category'], $_POST['isNav']);
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
        $categoryController->updateCategories($_POST['name'], $_POST['id'], $_FILES, $_POST['headcategory']);
    }
    //Update head category
    if (isset($_POST['updateHeadCategory'])) {
        $categoryController->updateHeadCategories($_POST['name'], $_POST['id'], $_FILES);
    }
    //Create new category
    if (isset($_POST['createCategory'])) {
        $categoryController->createNewCategory($_POST['post_name'], $_FILES, $_POST['category_header']);
    }
    //Delete category
    if (isset($_POST['deleteCategory'])) {
        $categoryController->deleteCategories($_POST['id'], $_POST['productRealation']);
    }
    //Delete head catecory
    if (isset($_POST['deleteHeadCategory'])) {
        $categoryController->deleteHeadCategoriess($_POST['id'], $_POST['productRealation']);
    }
    //Create new head category
    if (isset($_POST['createHeadCategory'])) {
        $categoryController->createNewHeadCategory($_POST['post_name'], $_FILES);
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
        $result = $accessLevel->updateAccessLevel($_POST['manageProductsRadio'], $_POST['manageCategoriesRadio'], $_POST['manageApiRadio'], $_POST['manageAccessLevelRadio'], $_POST['id']);
    }
    //Get all api keys
    if (isset($_POST['getAllApiKeys'])) {
        $result = $apiView->getAllApiKeys();
        echo json_encode($result);
    }
    //Delete api key
    if (isset($_POST['deleteApiKey'])) {
        $apiController->deleteApiKey($_POST['id']);
    }
    //Generate new api key
    if (isset($_POST['generateNewApiKey'])) {
        $apiController->generateNewKey();
    }
    //Check if api is locked
    if (isset($_POST['getApiLock'])) {
        $result = $apiView->checkApiLock();
        echo $result;
    }
    //Update Api lock
    if (isset($_POST['updateApiLock'])) {
        $apiController->updateApiLock($_POST['bool']);
    }
    //Get logs
    if (isset($_POST['getLogs'])) {
        if ($_POST['limit'] == "") {
            $result = $logsView->viewAllLogs();
            echo json_encode($result);
        }
    }

    