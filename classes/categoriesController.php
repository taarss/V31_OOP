<?php
    include_once 'categories.class.php';
    include_once 'accesslevel.class.php';
    class CategoriesController extends Categories{
        private $AccessLevel;
        function __construct() {
            $this->AccessLevel = new AccessLevel($_SESSION['id']);
        }
        public function updateCategories($name, $id, $icon){
            if ($this->AccessLevel->validateLevel('manage_categories')) {
                $image = null;
                if ($icon['post_img']['error'] != 4) {
                    $upload = new Image($icon);
                    $image = realpath($upload->uploadImage());
                }
                $this->updateCategory($name, $id, $image);
                header('Location: ../adminPanel.php');
            }
            else {
                echo 'You do not have permission to perform this action';
            }
            
        }
        public function createNewCategory($name, $icon){
            if ($this->AccessLevel->validateLevel('manage_categories')) {
                $upload = new Image($icon);
                $image = realpath($upload->uploadImage());
                $this->createCategory($name, $image);
                header('Location: ../adminPanel.php');
            }
            else {
                echo 'You do not have permission to perform this action';
            }
        }
        public function deleteCategories($id, $productRelation){
            if ($this->AccessLevel->validateLevel('manage_categories')) {
                $this->deleteCategory($id, $productRelation);
                header('Location: ../adminPanel.php');
            }
            else {
                echo 'You do not have permission to perform this action';
            }
        }
    }