<?php
    include 'product.class.php';
    include 'uploadImage.class.php';
    class ProductController extends Product{
        public function addNewProduct($id, $productName, $price, $description, $manufactur, $category, $gender, $file){
            $upload = new Image($file);
            $image = realpath($upload->uploadImage());
            $this->addProduct($productName,$price, $description, $manufactur, $category,$gender,$image);
         }
    }