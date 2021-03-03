<?php
    include_once 'settings.class.php';
    class SettingsController extends Settings{
        public function writeSetting($settings){
            $this->writeSettings($settings);
        }
    }