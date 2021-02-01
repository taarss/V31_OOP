<?php
    include 'product.class.php';
    include 'uploadImage.class.php';
    class ProductController extends Product{
        public function addNewProduct($id, $productName, $price, $description, $manufactur, $category, $gender, $file){
            $upload = new Image($file);
            $image = realpath($upload->uploadImage());
            $this->addProduct($productName,$price, $description, $manufactur, $category,$gender,$image);
            header('Location: ../adminPanel.php');
        }
         public function updateNewProduct($productName, $price, $description, $manufactur, $category, $gender, $file, $id){
            $image = null;
            if ($file['post_img']['error'] != 4) {
                $upload = new Image($file);
                $image = realpath($upload->uploadImage());
            }
            $this->updateProduct($productName,$price, $description, $manufactur, $category,$gender,$image, $id);
            header('Location: ../adminPanel.php');
        }
        public function deleteNewProduct($id){
            $this->deleteProduct($id);
            header('Location: ../adminPanel.php');
        }
    }