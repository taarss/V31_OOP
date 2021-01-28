<?php
    class Image{
        private $file;
        function __construct($file) {
            $this->file = $file;
        }
        function uploadImage(){
            $profile_pic = "";
            $uploadOk = 1;
            $allowed = array('jpg', 'jpeg', 'gif', 'png',strtolower(end(explode('.', $profile_pic))));
            $file_name = $this->file['post_img']['name'];
            $file_extn = strtolower(end(explode('.', $file_name)));
            $file_temp = $this->file['post_img']['tmp_name'];
            $check = getimagesize($this->file["post_img"]["tmp_name"]);       
            if($check !== false) {
              //echo "File is an image - " . $check["mime"] . "." ;
              $uploadOk = 1;
            } else {
             echo "File is not an image.";
              $uploadOk = 0;
              return false;
            }
            if (in_array($file_extn, $allowed) === true && $uploadOk == 1) {
                $file_path = "../uploads/" . substr(md5(time()), 0, 10) . '.' . $file_extn;
                echo $file_path;
                move_uploaded_file($file_temp, $file_path);
                return $file_path;
            }
            else {
                'unkown error';
            }
            if ($this->file["fileToUpload"]["size"] > 500000) {
                echo "Sorry, your file is too large.";
                return false;
                $uploadOk = 0;
              }                 
            elseif (in_array($file_extn, $allowed) === false) {
                echo 'Incorrect file type ';
                echo implode(',', $allowed);
                return false;
            } 
        }
    }