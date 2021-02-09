<?php 
    include_once 'db.class.php';
    class Log extends Db{
        protected function createLog($text){
            $sql = 'INSERT INTO logs SET log = ?';
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$text]);
        }
        protected function viewLogs(){
            $sql = "SELECT * FROM logs";
            $stmt = $this->connect()->prepare($sql);                                                                                                                                                               
            $stmt->execute();
            $results = $stmt->fetchAll();
            return $results;
        }
        protected function viewNumberOfLogs($number){
            $sql = "SELECT * FROM logs ORDER BY id DESC LIMIT $number";
            $stmt = $this->connect()->prepare($sql);                                                                                                                                                               
            $stmt->execute();
            $results = $stmt->fetchAll();
            return $results;
        }
        protected function viewLogsFromDate($date){
            $sql = "SELECT * FROM logs WHERE logDate LIKE ?";
            $stmt = $this->connect()->prepare($sql);                                                                                                                                                               
            $stmt->execute(["%$date%"]);
            $results = $stmt->fetchAll();
            return $results;
        }
    }