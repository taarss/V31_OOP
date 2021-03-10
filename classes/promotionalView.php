<?php
    include_once 'promotional.class.php';
    class promotionalView extends promotionalMaterial{
        public function getSlideshowInfo(){
            $result = $this->getSlideshow();
            return $result;
        }
    }
