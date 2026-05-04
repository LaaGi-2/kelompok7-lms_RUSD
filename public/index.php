<?php
require_once '../core/Functions.php';
require_once '../app/config/database.php';
require_once '../core/Router.php';

define('BASEURL', 'http://localhost/kelompok7-lms_RUSD');

$database = new Database();
$dbConn = $database->getConnection();

// Ambil URL dari .htaccess
$url = $_GET['url'] ?? 'home';
$url = rtrim($url, '/');

// Panggil daftar routes kita
require_once '../app/routes.php';

// Jalankan Router
Router::run($url, $dbConn);