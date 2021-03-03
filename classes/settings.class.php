<?php
    include_once 'uploadImage.class.php';
    class Settings{
        protected function readSettings(){
            $settings = fopen(dirname(__FILE__). "/" . "../install/settings.txt", "r") or die("Unable to open file!");
            $text = fread($settings,filesize(dirname(__FILE__). "/" . "../install/settings.txt"));
            fclose($settings);
            return $text;
        }
        protected function writeSettings($settingsData){
            $upload = new Image($_FILES);
            $image = $upload->uploadImage();
            $data = [
                "websiteName" => $settingsData['websiteName'],
                "logo" => $image,
                "address" => $settingsData['address'],
                "slogan" => $settingsData['slogan'],
                "email" => $settingsData['email']
            ];
            $settings = fopen("../install/settings.txt", "w") or die("Unable to open file!");
            fwrite($settings, json_encode($data));
            fclose($settings);
        }
    }