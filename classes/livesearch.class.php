<?php
    include_once 'db.class.php';
    class LiveSearch extends Db{
        private $query;
        private $category;

        function __construct($query, $category) {
            $this->query = $query;
            $this->category = $category;
        }

        function executeQuery(){
            if ($this->query != "") {
                if ($this->category == 0) {
                    $sql = "SELECT * FROM products
                    WHERE name LIKE ?
                    OR id LIKE ?
                    ";
                    $stmt = $this->connect()->prepare($sql);  
                    $stmt->execute(array("%$this->query%", "%$this->query%"));
                    $results = $stmt->fetchAll();
                    return $results;

                }
                else {
                    $sql = "SELECT * FROM products
                    WHERE name LIKE ? AND type = ?
                    OR id LIKE ?
                    AND type = ?";
                    $stmt = $this->connect()->prepare($sql);                                                                                                                                                       
                    $stmt->execute(array("%$this->query%", $this->category, "%$this->query%", $this->category));
                    $results = $stmt->fetchAll();
                    return $results;
                }
            }
            else {
                if ($this->category != 0) {
                    $sql = "SELECT * FROM products WHERE type = ?";
                     $stmt = $this->connect()->prepare($sql);                                                                                                                                                               
                     $stmt->execute([$this->category]);
                     $results = $stmt->fetchAll();
                     return $results;
                }
                else {
                    $sql = "SELECT * FROM products ORDER BY id LIMIT 20";
                    $stmt = $this->connect()->prepare($sql);                                                                                                                                                               
                    $stmt->execute([]);
                    $results = $stmt->fetchAll();
                    return $results;
                }
            }

        }
    }