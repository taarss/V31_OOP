<?php
    include 'product.class.php';
    include 'uploadImage.class.php';
    include_once 'accesslevel.class.php';
    class ProductController extends Product{
        public $AccessLevel;
        function __construct() {
            $this->AccessLevel = new AccessLevel($_SESSION['id']);
        }
        public function addNewProduct($id, $productName, $price, $description, $manufactur, $category, $gender, $file){
            if ($this->AccessLevel->validateLevel('manage_products')) {
                $upload = new Image($file);
                $image = realpath($upload->uploadImage());
                $this->addProduct($productName,$price, $description, $manufactur, $category,$gender,$image);
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
                header('Location: ../adminPanel.php');
                }
            else {
                echo 'You do not have permission to perform this action';
            }
            
        }
        public function deleteNewProduct($id){
            if ($this->AccessLevel->validateLevel('manage_products')) {
                $this->deleteProduct($id);
                header('Location: ../adminPanel.php');
            }
            else {
                echo 'You do not have permission to perform this action';
            }
            
        }
        public function updateProductShowcase($productIdArray){
            if ($this->AccessLevel->validateLevel('manage_accessLevel')) {
                $this->updateShowcase($productIdArray);
                header('Location: ../adminPanel.php');
            }
            else {
                echo 'You do not have permission to perform this action';
            }
        }
    }