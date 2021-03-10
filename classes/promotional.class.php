<?php
    include_once 'db.class.php';
    class promotionalMaterial extends Db{
        protected function getSlideshow(){
            $sql = "SELECT * FROM promotional_material";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([]);
            $results = $stmt->fetchAll();
            return $results;
        }
        protected function updateSlideshow($id, $image){
            $sql = "UPDATE promotional_material SET img = ? WHERE id = ?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$image, $id]);
        }
        
    }