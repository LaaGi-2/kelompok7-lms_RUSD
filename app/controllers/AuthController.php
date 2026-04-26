<?php
class AuthController {
    public function login() {
        // Langsung panggil view landing page
        include '../app/views/auth/login/login.php';
    }
    public function verifikasi(){
       $email = request('mail'); // Menggunakan helper request
    
    if ($email == "admin@rsud-bp.com") {
        return redirect('/admin/dashboard');
    }
    }
    public function register() {
        // Langsung panggil view landing page
        include '../app/views/auth/register/register.php';
    }
}