<?php
    include_once 'categories.class.php';
    class CategoriesView extends Categories {
        public function listCategories(){
            $results = $this->getCategories();
            foreach ($results as $category) {
                echo '<li><a href="products.php?category='.$category['id'].'">' . $category['name'] . '</a></li>';
            }
        }
        public function getAllCategories(){
            $results = $this->getCategories();
            return $results;
        }
    }