<?php
    include_once '../classes/categoriesview.class.php';
    $categoryView = new CategoriesView();
    if (isset($_POST['getCategories'])) {
        $result = $categoryView->getAllCategories();
        echo json_encode($result);
    }