<?php

// middleware web
class AuthMiddleware
{
    public static function checkAuth($requiredRole)
    {
        // Pastikan session sudah diinisialisasi
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Periksa apakah pengguna sudah login
        if (!isset($_SESSION['user'])) {
            http_response_code(401); // Unauthorized
            echo json_encode(['error' => 'Anda harus login terlebih dahulu.']);
            exit;
        }

        $user = $_SESSION['user'];

        // Validasi role pengguna
        if ($user['role'] !== $requiredRole) {
            http_response_code(403); // Forbidden
            echo json_encode(['error' => 'Anda tidak memiliki akses ke halaman ini.']);
            exit;
        }

        // Jika lolos, middleware selesai
    }
}
