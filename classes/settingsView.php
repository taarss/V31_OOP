<?php
    include_once 'settings.class.php';
    class SettingsView extends Settings{
        public function viewAllSettings(){
            return $this->readSettings();
        }
    }