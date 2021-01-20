<?php
spl_autoload_register('myAutoLoader');
    function myAutoLoader($class){
        $url = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        $extension = ".class.php";
        $path = null;
        if (strpos($url, 'includes') !== false) {
            $path = "../classes/";
        }
        else{
            $path = "classes/";
        }
        require_once  $path . strtolower($class) . $extension;
    }