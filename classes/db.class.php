<?php
    include_once 'crypt.php';
    session_start();
    class Db{
        private $DATABASE_HOST = '';
        private $DATABASE_USER = '';
        private $DATABASE_PASS = '';
        public $DATABASE_NAME = '';

        protected function connect(){
            $this->decryptCredentials();
            $dsn = 'mysql:host=' . $this->DATABASE_HOST . ';dbname='. $this->DATABASE_NAME;
            $pdo = new PDO($dsn, $this->DATABASE_USER, $this->DATABASE_PASS);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        }

        protected function decryptCredentials(){
            $crypt = new Crypt();
            $key = "5L3yq&@{B*@BG}!6";
            $myfile = fopen(dirname(__FILE__). "/" . "../install/dbinfo.txt", "r") or die("Unable to open file!");
            $credentials = preg_split('/\s+/', $crypt->decrypt(fgets($myfile), $key), -1, PREG_SPLIT_NO_EMPTY);
            $this->DATABASE_HOST = $credentials[1];
            $this->DATABASE_USER = $credentials[2];
            $this->DATABASE_PASS = $credentials[3];
            $this->DATABASE_NAME = $credentials[0];
        }
    }