<?php

class DepartemenModel {
    private $db;
    private $table = "tb_departemen";

    public function __construct($dbConn) {
        $this->db = $dbConn;
    }

    public function getDepartemenById($id) {
        $query = "SELECT * FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}