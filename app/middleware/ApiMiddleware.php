<?php
// AuthMiddleware.php
require_once __DIR__ . '/../../config/database.php';
class AuthMiddleware
{
    public static function check()
    {
        // Mendapatkan header Authorization
        $headers = getallheaders();
        $authorizationHeader = $headers['Authorization'] ?? '';

        if (strpos($authorizationHeader, 'Bearer ') === 0) {
            $token = substr($authorizationHeader, 7);
        } else {
            $token = '';
        }

        if (empty($token)) {
            http_response_code(401);
            echo json_encode(['success' => false, 'message' => 'Token tidak ditemukan']);
            exit();
        }

        // Koneksi ke database

        $pdo = Database::getConnection();
        // Verifikasi pengguna berdasarkan token
        $stmt = $pdo->prepare("SELECT * FROM users WHERE token = :token");
        $stmt->bindParam(':token', $token);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user || $user['role'] !== 'siswa') {
            http_response_code(403);
            echo json_encode(['success' => false, 'message' => 'Akses ditolak']);
            exit();
        }

        return $user; // Mengembalikan data user jika valid
    }
}
