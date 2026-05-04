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
        $semuaDokter = $this->dokterModel->getAllDokter();

        $dataDokter = $semuaDokter;
        include '../app/views/dokter/dokter.php';
    }

    public function showProfile($id) {
        $dokter = $this->dokterModel->getDokterById($id);
        
        if ($dokter) {
            include '../app/views/dokter/detail.php';
        } else {
            echo "Dokter tidak ditemukan.";
        }
    }
    public function delete($id) {
        if ($this->dokterModel->delete($id)) {
            header("Location: " . BASEURL . "/admin/dokter");
            exit;
        }
    }

   public function create() {
        include '../app/views/dokter/tambah.php';
    }

    public function edit($id) {
        $dokter = $this->dokterModel->getDokterById($id);
        if ($dokter) {
            include '../app/views/dokter/edit.php';
        } else {
            echo "Data tidak ditemukan";
        }
    }

    public function store() {
        if ($this->dokterModel->insert($_POST)) {
            header("Location: " . BASEURL . "/admin/dokter");
            exit;
        }
    }

    public function update() {
        if ($this->dokterModel->update($_POST)) {
            header("Location: " . BASEURL . "/admin/dokter");
            exit;
        }
    }
}