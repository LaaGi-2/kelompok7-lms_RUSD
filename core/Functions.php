<?php
// core/Functions.php

/**
 * Fungsi helper untuk melakukan redirect
 * @param string $path
 */
// core/Functions.php

function redirect($path) {
    // Ambil nama folder proyek secara otomatis
    // Jika proyekmu di htdocs/rsud-app, ini akan menghasilkan /rsud-app
    $baseDir = str_replace($_SERVER['DOCUMENT_ROOT'], '', str_replace('\\', '/', dirname(__DIR__)));
    $baseDir = rtrim($baseDir, '/');

    // Normalisasi path
    $path = ltrim($path, '/');
    
    // Hasil akhirnya: /nama-folder-proyek/admin/dashboard
    header("Location: " . $baseDir . "/" . $path);
    exit();
}

/**
 * Fungsi helper untuk mengambil data POST agar lebih aman
 */
function request($key) {
    return $_POST[$key] ?? null;
}