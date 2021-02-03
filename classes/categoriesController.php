<?php
    include_once 'categories.class.php';
    class CategoriesController extends Categories{
        public function updateCategories($name, $id, $icon){
            $image = null;
            if ($icon['post_img']['error'] != 4) {
                $upload = new Image($icon);
                $image = realpath($upload->uploadImage());
            }
            $this->updateCategory($name, $id, $image);
            header('Location: ../adminPanel.php');
        }
        public function createNewCategory($name, $icon){
            $upload = new Image($icon);
            $image = realpath($upload->uploadImage());
            $this->createCategory($name, $image);
            header('Location: ../adminPanel.php');
        }
        public function deleteCategories($id, $productRelation){
            $this->deleteCategory($id, $productRelation);
            header('Location: ../adminPanel.php');
        }
    }