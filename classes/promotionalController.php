<?php
    include_once 'promotional.class.php';
    include_once 'uploadImage.class.php';
    include_once 'accesslevel.class.php';
    include_once 'logController.class.php';
    class promotionalController extends promotionalMaterial{
        public $AccessLevel;
        public $LogController;
        function __construct() {
            $this->AccessLevel = new AccessLevel($_SESSION['id']);
            $this->LogController = new LogController();
        }
        public function updateSlideShowInfo($id, $image){
            if ($this->AccessLevel->validateLevel('manage_products')) {
                $upload = new Image($image);
                $image = $upload->uploadImage();
                $result = $this->updateSlideshow($id, $image);
                $this->LogController->createNewLog("added image to slideshow[" . $image."]");
                return $result;
            }
            else {
                echo 'You do not have permission to perform this action';
            }
           
        }
    }
