<?php
    include_once 'log.class.php';
    class LogController extends Log{
        public function createNewLog($text){
            $this->createLog($_SESSION['name']." " . $text);
        }
    }