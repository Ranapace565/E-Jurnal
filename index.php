<?php
// index.php
// header respons untuk JSON
header('Content-Type: application/json');

$requestMethod = $_SERVER['REQUEST_METHOD'];
$requestUri = $_SERVER['REQUEST_URI'];

session_start();

if (preg_match('#^/api/#', $requestUri)) {
    // akses route api
    require_once __DIR__ . '/routes/api.php';
} else {
    // akses route web
    require_once __DIR__ . '/routes/web.php';
}
