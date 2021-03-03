<?php
    include_once 'product.class.php';
    include_once 'uploadImage.class.php';
    include_once 'accesslevel.class.php';
    include_once 'logController.class.php';
    class ProductController extends Product{
        public $AccessLevel;
        public $LogController;
        function __construct() {
            $this->AccessLevel = new AccessLevel($_SESSION['id']);
            $this->LogController = new LogController();
        }
        public function addNewProduct($id, $productName, $price, $description, $manufactur, $category, $gender, $file){
            if ($this->AccessLevel->validateLevel('manage_products')) {
                $upload = new Image($file);
                $image = $upload->uploadImage();
                $this->addProduct($productName,$price, $description, $manufactur, $category,$gender,$image);
                $this->LogController->createNewLog("created product[" . $productName ."]");
                header('Location: ../adminPanel.php');
            }
            else {
                echo 'You do not have permission to perform this action';
            }
    
        }
         public function updateNewProduct($productName, $price, $description, $manufactur, $category, $gender, $file, $id){
            if ($this->AccessLevel->validateLevel('manage_products')) {
                $image = null;
                if ($file['post_img']['error'] != 4) {
                    $upload = new Image($file);
                    $image = realpath($upload->uploadImage());
                }
                $this->updateProduct($productName,$price, $description, $manufactur, $category,$gender,$image, $id);
                $this->LogController->createNewLog("updated product[" . $id ."]");
                header('Location: ../adminPanel.php');
                }
            else {
                echo 'You do not have permission to perform this action';
            }
            
        }
        public function deleteNewProduct($id){
            if ($this->AccessLevel->validateLevel('manage_products')) {
                $this->deleteProduct($id);
                $this->LogController->createNewLog("deleted product[" . $id ."]");
                header('Location: ../adminPanel.php');
            }
            else {
                echo 'You do not have permission to perform this action';
            }
            
        }
        public function updateProductShowcase($productIdArray){
            if ($this->AccessLevel->validateLevel('manage_accessLevel')) {
                $this->updateShowcase($productIdArray);
                $this->LogController->createNewLog("updated product showcase[" . implode(" ",$productIdArray) ."]");
                header('Location: ../adminPanel.php');
            }
            else {
                echo 'You do not have permission to perform this action';
            }
        }
    }