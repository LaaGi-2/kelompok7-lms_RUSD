<?php

class Router
{
    private static $routes = [];

    // Helper untuk mendaftarkan route secara umum
    private static function addRoute($method, $path, $callback)
    {
        // Mengubah format {id} menjadi Regex group ([a-zA-Z0-9]+)
        $path = preg_replace('/\{[a-zA-Z0-9]+\}/', '([a-zA-Z0-9]+)', $path);
        self::$routes[$method][$path] = $callback;
    }

    // Method GET
    public static function get($path, $callback)
    {
        self::addRoute('GET', $path, $callback);
    }

    // Method POST
    public static function post($path, $callback)
    {
        self::addRoute('POST', $path, $callback);
    }

    // Method PUT
    public static function put($path, $callback)
    {
        self::addRoute('PUT', $path, $callback);
    }

    // Method DELETE
    public static function delete($path, $callback)
    {
        self::addRoute('DELETE', $path, $callback);
    }

    public static function run($url, $dbConn)
    {
        // 1. Ambil path dasar folder proyek (misal: /kelompok7-lms_RUSD)
        $scriptDir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));
        // 2. Bersihkan URL dari nama folder proyek
        // Jika URL: /kelompok7-lms_RUSD/admin/dashboard 
        // Maka akan dipotong menjadi: /admin/dashboard
        if ($scriptDir !== '/') {
            $url = str_replace($scriptDir, '', $url);
        }
        // 3. Normalisasi URL: hapus query string dan trailing slash
        $url = parse_url($url, PHP_URL_PATH);
        $url = trim($url, '/');
        if ($url === '') $url = '/';
        $method = $_SERVER['REQUEST_METHOD'];
        // Support untuk Method Overriding (PUT/DELETE dari Form)
        if ($method === 'POST' && isset($_POST['_method'])) {
            $method = strtoupper($_POST['_method']);
        }
        // Cek apakah method ada dalam daftar rute
        if (!isset(self::$routes[$method])) {
            echo "404 - Method $method tidak diizinkan";
            return;
        }

        foreach (self::$routes[$method] as $path => $callback) {
            // Normalisasi path rute agar tidak ada slash berlebih di awal/akhir
            $path = trim($path, '/');
            if ($path === '') $path = '/';

            if (preg_match("#^$path$#", $url, $matches)) {
                array_shift($matches);
                $params = $matches;

                if (is_array($callback)) {
                    $controllerName = $callback[0];
                    $methodName = $callback[1];
                    $controllerFile = "../app/controllers/$controllerName.php";

                    if (file_exists($controllerFile)) {
                        require_once $controllerFile;
                        $controller = new $controllerName($dbConn);
                        return call_user_func_array([$controller, $methodName], $params);
                    }
                }

                if (is_callable($callback)) {
                    return call_user_func_array($callback, $params);
                }
            }
        }

        $pathExistsInOtherMethod = false;
        foreach (self::$routes as $otherMethod => $routes) {
            if ($otherMethod === $method) continue; // Lewati method yang sedang dicek

            foreach ($routes as $path => $callback) {
                $path = trim($path, '/');
                if ($path === '') $path = '/';

                if (preg_match("#^$path$#", $url)) {
                    $pathExistsInOtherMethod = $otherMethod;
                    break 2;
                }
            }
        }

        if ($pathExistsInOtherMethod) {
            // Jika path ada tapi method salah (Misal: Harusnya POST tapi kamu akses via GET)
            http_response_code(405);
            echo "<b>405 - Method Not Allowed</b><br>";
            echo "URL '<b>$url</b>' terdaftar dengan method <b>$pathExistsInOtherMethod</b>, tetapi kamu mengaksesnya menggunakan method <b>$method</b>.";
        } else {
            // Jika memang path-nya tidak terdaftar di manapun
            http_response_code(404);
            echo "<b>404 - Not Found</b><br>";
            echo "Halaman '<b>$url</b>' tidak ditemukan di server ini.";
        }
    }
}
