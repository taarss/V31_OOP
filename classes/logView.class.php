<?php
    include_once 'log.class.php';
    class LogView extends Log{
        public function viewAllLogs(){
            $result = $this->viewLogs();
            return $result;
        }
        public function viewAmountLogs($num){
            $result = $this->viewNumberOfLogs($num);
            return $result;
        }
        public function viewLogsOfDate($date){
            $result = $this->viewLogsFromDate($date);
            return $result;
        }
    }