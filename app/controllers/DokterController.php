<?php

class DokterController {
    private $db;
    private $dokterModel;

    public function __construct($dbConn) {
        $this->db = $dbConn;
        
        require_once '../app/models/DokterModel.php';        
        $this->dokterModel = new DokterModel($this->db);
    }

    public function index(){
        include '../app/views/dokter/dokter.php';
    }

    // public function showProfile($id) {
    //     $dokter = $this->dokterModel->getDokterById($id);
        
    //     if ($dokter) {
    //         include '../app/views/dokter/detail.php';
    //     } else {
    //         echo "Dokter tidak ditemukan.";
    //     }
    // }
}