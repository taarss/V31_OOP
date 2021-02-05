<?php
    include_once 'db.class.php';
    include_once 'accountview.class.php';
    class AccessLevel extends Db{
        private $id;

        function __construct($id){
            $this->id = $id['id'];
        }

        public function validateLevel($request){
            $accountView = new AccountView;
            $adminLevel = $accountView->getAdminLevel($this->id);
            switch ($request) {
                case 'manage_products':
                    $sql = "SELECT manage_products FROM accessLevel WHERE id = ?";
                    break;
                case 'manage_categories':
                    $sql = "SELECT manage_categories FROM accessLevel WHERE id = ?";
                    break;
                case 'manage_api':
                    $sql = "SELECT manage_api FROM accesLevel WHERE id = ?";
                    break;
                case 'manage_accessLevel':
                    $sql = "SELECT manage_accessLevel FROM accessLevel WHERE id = ?";
                    break;
            }
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$adminLevel[0]['adminLevel']]);
            $results = $stmt->fetchAll();
            if ($results[0][$request] == 1) {
                return true;
            }
            else {
                return false;
            }
        }

        public function getAllAccessLevels(){
            $sql = "SELECT * FROM accessLevel";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute();
            $results = $stmt->fetchAll();
            return $results;
        }

        public function updateAccessLevel($manageProducts,  $manageCategories, $manageApi, $manageAccessLevel, $id){
            if ($this->validateLevel("manage_accessLevel")) {
                if ($manageCategories == null) {
                    $manageCategories = 0;
                }
                if ($manageProducts == null) {
                    $manageProducts = 0;
                }
                if ($manageApi == null) {
                    $manageApi = 0;
                }
                if ($manageAccessLevel == null) {
                    $manageAccessLevel = 0;
                }
                $sql = "UPDATE accessLevel SET manage_products = ?, manage_categories = ?, manage_api = ?, manage_accessLevel = ? WHERE id = ?";
                $stmt = $this->connect()->prepare($sql);
                $stmt->execute([$manageProducts, $manageCategories, $manageApi, $manageAccessLevel, $id]);
            }
            else {
                echo 'You do not have permission to perform this action';
            }
            

        }

        
    }