<?php
// LoginController.php
header('Content-Type: application/json');
require_once __DIR__ . '/../../config/database.php';

class LoginController
{

    public function loginroute()
    {
        $requestMethod = $_SERVER['REQUEST_METHOD'];
        $requestUri = $_SERVER['REQUEST_URI'];

        require_once __DIR__ . '/../middleware/ApiMiddleware.php';

        switch ($requestMethod) {
            case 'POST':
                if ($requestUri === '/api/login') {
                    $this->handleLogin();
                }
                break;

            case 'PUT':
                if ($requestUri === '/api/user/password') {
                    AuthMiddleware::check();
                    $this->handleUpdatePassword();
                }
                break;

            case 'DELETE':
                if ($requestUri === '/api/user/logout') {
                    AuthMiddleware::check();
                    $this->handleLogout();
                }
                break;

            case 'GET':
                // Handle username check
                if (preg_match('/^\/api\/user\/checkUsername\/([^\/]+)$/', $requestUri, $matches)) {
                    $username = $matches[1];
                    $this->checkUsername($username);  // Call checkUsername method
                }
                break;

            default:
                echo json_encode(["error-function" => "Fungsi Not found :( "]);
                break;
        }
    }

    function handleLogin()
    {
        // Ambil konten JSON dari body request
        $input = json_decode(file_get_contents("php://input"), true);

        // Validasi JSON yang diterima
        if (!$input) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Input JSON tidak valid']);
            return;
        }

        // Validasi bahwa JSON mengandung 'username' dan 'password'
        $username = $input['username'] ?? '';
        $password = $input['password'] ?? '';

        // Validasi bahwa username dan password tidak kosong
        if (empty($username)) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Username harus diisi']);
            return;
        }

        if (empty($password)) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Password harus diisi']);
            return;
        }

        // Panggil koneksi database
        $pdo = Database::getConnection();

        // Cek pengguna berdasarkan username
        $stmt = $pdo->prepare("
        SELECT 
                COALESCE(students.name, '') AS nama, 
                COALESCE(students.id, '') AS nis, 
                COALESCE(students.nisn, '') AS nisn,
                COALESCE(students.expertise, '') AS prodi, 
                COALESCE(groups.id, '') AS group_id,    
                COALESCE(idukas.name, '') AS dudi,
                COALESCE(idukas.address, '') AS alamatdudi,
                COALESCE(idukas.mentor, '') AS pimpinan,
                COALESCE(mentors.name, '') AS pembimbing, 
                COALESCE(users.username, '') AS username,
                COALESCE(users.role, '') AS role,
                COALESCE(users.id, '') AS user_id,
                COALESCE(users.password, '') AS password
            FROM students
            LEFT JOIN groups ON students.group_id = groups.id
            LEFT JOIN idukas ON groups.iduka_id = idukas.id
            LEFT JOIN mentors ON groups.nip = mentors.id
            LEFT JOIN users ON students.user_id = users.id
            WHERE users.username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            http_response_code(404);
            echo json_encode(['success' => false, 'message' => 'User tidak ditemukan']);
            return;
        }

        // Verifikasi password
        if (!password_verify($password, $user['password'])) {
            http_response_code(401);
            echo json_encode(['success' => false, 'message' => 'Password salah']);
            return;
        }

        // Cek apakah role adalah 'siswa'
        if ($user['role'] !== 'siswa') {
            http_response_code(403);
            echo json_encode(['success' => false, 'message' => 'Akses hanya untuk siswa']);
            return;
        }

        // Jika autentikasi berhasil, buat token
        $token = bin2hex(random_bytes(16));
        $stmt = $pdo->prepare("UPDATE users SET token = :token WHERE id = :id");
        $stmt->bindParam(':token', $token);
        $stmt->bindParam(':id', $user['id']);
        $stmt->execute();

        // Struktur respons yang konsisten untuk sukses
        http_response_code(200);
        echo json_encode([
            'success' => true,
            'message' => 'Login berhasil',
            'token' => $token,
            'data' => [
                'nama' => $user['nama'],
                'nis' => $user['nis'],
                'nisn' => $user['nisn'],
                'prodi' => $user['prodi'],
                'group_id' => $user['group_id'],
                'dudi' => $user['dudi'],
                'alamatdudi' => $user['alamatdudi'],
                'pimpinan' => $user['pimpinan'],
                'pembimbing' => $user['pembimbing'],
                'username' => $user['username'],
                'role' => $user['role'],
                'user_id' => $user['user_id'],
                'password' => $user['password']
            ]
        ]);
    }

    function checkUsername($username)
{
    // Validasi bahwa username tidak kosong
    if (empty($username)) {
        http_response_code(400);  // Bad Request jika username kosong
        echo json_encode([
            'success' => false,
            'message' => 'Username harus diisi'
        ]);
        return;
    }

    // Koneksi ke database
    $pdo = Database::getConnection();

    // Cek apakah username sudah ada di database
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE username = :username");
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->execute();
    $count = $stmt->fetchColumn();

    // Menyusun respons API untuk Android (ApiResponse)
    $response = [
        // Jika username sudah ada, success true
        'success' => $count > 0, // true jika username sudah terdaftar
        'message' => $count > 0 ? 'Username sudah terdaftar' : 'Username belum terdaftar, coba username lain'
    ];

    // Kirim respons dalam format JSON
    http_response_code(200); // OK response
    echo json_encode($response);
}


    function handleUpdatePassword()
    {
        // Mendapatkan input JSON
        $input = json_decode(file_get_contents("php://input"), true);

        // Validasi JSON yang diterima
        if (!$input) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Input JSON tidak valid']);
            return;
        }

        $newPassword = $input['new_password'] ?? '';

        // Mendapatkan header Authorization
        $headers = getallheaders();
        $authorizationHeader = $headers['Authorization'] ?? '';

        // Mengecek apakah header berisi token Bearer
        if (strpos($authorizationHeader, 'Bearer ') === 0) {
            $token = substr($authorizationHeader, 7);
        } else {
            $token = '';
        }

        // Validasi token
        if (empty($token)) {
            http_response_code(401);
            echo json_encode(['success' => false, 'message' => 'Token tidak ditemukan']);
            return;
        }

        // Validasi password baru
        if (empty($newPassword)) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Password baru harus diisi']);
            return;
        }

        $user = AuthMiddleware::check();

        // Koneksi ke database
        $pdo = Database::getConnection();

        // Update password baru setelah di-hash
        $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);
        $stmt = $pdo->prepare("UPDATE users SET password = :password WHERE id = :id");
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->bindParam(':id', $user['id']);
        $stmt->execute();

        // Respons sukses
        http_response_code(200);
        echo json_encode(['success' => true, 'message' => 'Password berhasil diperbarui']);
    }

    function handleLogout()
    {
        $headers = getallheaders();
        $authorizationHeader = $headers['Authorization'];

        if (strpos($authorizationHeader, 'Bearer') === 0) {
            $token = substr($authorizationHeader, 7);
        } else {
            $token = '';
        }

        if (empty($token)) {
            http_response_code(401);
            echo json_encode(['succes' => false, 'message' => 'Token tidak ditemukan']);
            return;
        }

        $pdo = Database::getConnection();

        $stmt = $pdo->prepare("UPDATE users SET token = NULL WHERE token = :token");
        $stmt->bindParam(':token', $token);
        $stmt->execute();

        echo json_encode(['success' => true, 'message' => 'User logged out']);
    }
}
