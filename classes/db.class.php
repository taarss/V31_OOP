<?php
    session_start();
    class Db{
        private $DATABASE_HOST = 'localhost';
        private $DATABASE_USER = 'christianvillads_techv31';
        private $DATABASE_PASS = 'Aspit12345';
        private $DATABASE_NAME = 'christianvillads_techv31';

        protected function connect(){
            $dsn = 'mysql:host=' . $this->DATABASE_HOST . ';dbname='. $this->DATABASE_NAME;
            $pdo = new PDO($dsn, $this->DATABASE_USER, $this->DATABASE_PASS);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            return $pdo;
        }
    }