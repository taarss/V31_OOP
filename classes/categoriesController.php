<?php
    include_once 'categories.class.php';
    include_once 'accesslevel.class.php';
    include_once 'logController.class.php';
    class CategoriesController extends Categories{
        private $AccessLevel;
        public $LogController;
        function __construct() {
            $this->AccessLevel = new AccessLevel($_SESSION['id']);
            $this->LogController = new LogController();
        }
        public function updateCategories($name, $id, $icon){
            if ($this->AccessLevel->validateLevel('manage_categories')) {
                $image = null;
                if ($icon['post_img']['error'] != 4) {
                    $upload = new Image($icon);
                    $image = realpath($upload->uploadImage());
                }
                $this->LogController->createNewLog("updated category[" . $id ."] to " . $name);
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
                $this->LogController->createNewLog("created category[" . $name ."]");
                header('Location: ../adminPanel.php');
            }
            else {
                echo 'You do not have permission to perform this action';
            }
        }
        public function deleteCategories($id, $productRelation){
            if ($this->AccessLevel->validateLevel('manage_categories')) {
                $this->deleteCategory($id, $productRelation);
                $this->LogController->createNewLog("deleted category[" . $id ."]");
                header('Location: ../adminPanel.php');
            }
            else {
                echo 'You do not have permission to perform this action';
            }
        }
    }