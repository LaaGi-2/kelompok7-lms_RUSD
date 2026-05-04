<?php
require_once '../core/Router.php';

Router::get('home', ['HomeController', 'index']);

Router::get('login', ['AuthController', 'login']);
Router::post('login', ['AuthController', 'verifikasi']);

Router::get('register', ['AuthController', 'register']);

Router::get('admin/dashboard', ['DashboardController', 'dashboard']);

Router::get('admin/dokter', ['DokterController', 'index']);
Router::get('admin/dokter/profil/{id}', ['DokterController', 'showProfile']);

Router::get('admin/dokter/delete/{id}', ['DokterController', 'delete']);

Router::get('admin/dokter/create', ['DokterController', 'create']);
Router::get('admin/dokter/edit/{id}', ['DokterController', 'edit']);

Router::post('admin/dokter/store', ['DokterController', 'store']);
Router::post('admin/dokter/update', ['DokterController', 'update']);