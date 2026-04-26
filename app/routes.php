<?php
require_once '../core/Router.php';

Router::get('home', ['HomeController', 'index']);

Router::get('login', ['AuthController', 'login']);
Router::post('login', ['AuthController', 'verifikasi']);

Router::get('register', ['AuthController', 'register']);

Router::get('admin/dashboard', ['DashboardController', 'dashboard']);
Router::get('admin/dokter', ['DokterController', 'index']);