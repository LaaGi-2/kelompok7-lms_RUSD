<?php

class DokterModel {
    private $db;
    private $table = "tb_dokter";

    public function __construct($dbConn) {
        $this->db = $dbConn;
    }

    public function getDokterById($id) {
        // 1. Membuat string query dengan prepared statement
        $stmt = $this->db->prepare("SELECT * FROM " . $this->table . " WHERE id_dokter = :id");
        
        $stmt->bindParam(':id', $id);
        
        try {
            $stmt->execute();
            
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            
            return $stmt->fetch();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
    public function getAllDokter() {
        $stmt = $this->db->prepare("SELECT * FROM " . $this->table);
        
        try {
            $stmt->execute();
            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return [];
        }
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM " . $this->table . " WHERE id_dokter = :id");
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function insert($data) {
        $sql = "INSERT INTO " . $this->table . " (no_str, nama_dokter, spesialisasi, email_resmi, ruangan_praktek) 
                VALUES (:no_str, :nama_dokter, :spesialisasi, :email_resmi, :ruangan_praktek)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':no_str'         => $data['no_str'],
            ':nama_dokter'    => $data['nama_dokter'],
            ':spesialisasi'   => $data['spesialisasi'],
            ':email_resmi'    => $data['email_resmi'],
            ':ruangan_praktek' => $data['ruangan_praktek']
        ]);
    }

    public function update($data) {
        $sql = "UPDATE " . $this->table . " SET 
                    no_str          = :no_str, 
                    nama_dokter     = :nama_dokter, 
                    spesialisasi    = :spesialisasi, 
                    email_resmi     = :email_resmi, 
                    ruangan_praktek = :ruangan_praktek 
                WHERE id_dokter = :id_dokter";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':no_str'         => $data['no_str'],
            ':nama_dokter'    => $data['nama_dokter'],
            ':spesialisasi'   => $data['spesialisasi'],
            ':email_resmi'    => $data['email_resmi'],
            ':ruangan_praktek' => $data['ruangan_praktek'],
            ':id_dokter'      => $data['id_dokter']
        ]);
    }
}