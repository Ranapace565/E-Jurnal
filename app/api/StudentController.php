<?php
// StudentController.php
header('Content-Type: application/json');
require_once __DIR__ . '/../../config/database.php';

class StudentController
{
    public function studentRoute()
    {
        $requestMethod = $_SERVER['REQUEST_METHOD'];
        $requestUri = $_SERVER['REQUEST_URI'];

        switch ($requestMethod) {
            case 'GET':
                // For URL: /api/student/getProfile/{id}
                if (preg_match('/\/api\/student\/getProfile\/(\d+)/', $requestUri, $matches)) {
                    $studentId = $matches[1];
                    $this->getProfile($studentId);
                }
                // For URL: /api/student/fotoProfile/{id}
                elseif (preg_match('/\/api\/student\/fotoProfile\/(\d+)/', $requestUri, $matches)) {
                    $userId = $matches[1];  // Get user_id from the URL
                    $this->getFotoProfile($userId);  // Call method to get profile photo
                }
                // For URL: /api/student/getDudi/{id}
                elseif (preg_match('/\/api\/student\/getDudi\/(\d+)/', $requestUri, $matches)) {
                    $studentId = $matches[1];
                    $this->getDudiData($studentId);  // Call method to get Dudi data
                }
                break;

            case 'PUT':
                if (preg_match('/\/api\/student\/update\/(\d+)/', $requestUri, $matches)) {
                    $studentId = $matches[1];
                    $this->updateProfile($studentId);
                }
                break;

            default:
                echo json_encode(["error-function" => "Function not found :( "]);
                break;
        }
    }

function getFotoProfile($userId)
{
    // Mendapatkan koneksi database
    $pdo = Database::getConnection();

    // Query untuk mengambil file berdasarkan user_id
    $stmt = $pdo->prepare("SELECT file_name FROM files WHERE user_id = :user_id");
    $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
    $stmt->execute();

    // Mengambil hasil query
    $file = $stmt->fetch(PDO::FETCH_ASSOC);

    // Jika file ditemukan
    if ($file) {
        error_log("File ditemukan: " . $file['file_name']);  // Log jika file ditemukan
        // Tentukan path lengkap ke file yang akan diambil
        $filePath = $_SERVER['DOCUMENT_ROOT'] . '/public_html/public/img/profile/' . $file['file_name'];

        // Memeriksa apakah file ada di path yang diberikan
        if (file_exists($filePath)) {
            $fileExtension = pathinfo($file['file_name'], PATHINFO_EXTENSION); // Mendapatkan ekstensi file
            $contentType = $this->getContentTypeByExtension($fileExtension); // Mendapatkan content type berdasarkan ekstensi

            if ($contentType === null) {
                // Jika format file tidak didukung
                http_response_code(415); // Unsupported Media Type
                echo json_encode([
                    'success' => false,
                    'message' => 'File format not supported.'
                ]);
                exit();
            }

            // Mengembalikan respons sukses dengan file_name
            echo json_encode([
                'success' => true,
                'status' => 'success',
                'file_name' => $file['file_name']  // Mengirim nama file gambar
            ]);
            exit();
        } else {
            // Jika file tidak ditemukan di folder uploads/picture_pics
            http_response_code(404);
            echo json_encode([
                'success' => false,
                'message' => 'File not found at the specified location.'
            ]);
        }
    } else {
        // Jika tidak ada data file ditemukan untuk user_id yang diberikan
        http_response_code(404);
        echo json_encode([
            'success' => false,
            'message' => 'No file found for the provided user ID.'
        ]);
    }
}


    // Helper function untuk mendapatkan Content-Type berdasarkan ekstensi file
    private function getContentTypeByExtension($extension)
    {
        $contentTypes = [
            'jpg' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'png' => 'image/png',
            'gif' => 'image/gif',
        ];

        return isset($contentTypes[strtolower($extension)]) ? $contentTypes[strtolower($extension)] : null;
    }

    public function updateProfile($studentId)
    {
        // Ambil data JSON dari body request
        $input = json_decode(file_get_contents("php://input"), true);

        // Log data yang diterima
        error_log(print_r($input, true));  // Log untuk melihat data yang diterima

        // Validasi JSON yang diterima
        if (!$input) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Input JSON tidak valid']);
            return;
        }

        // Ambil data dari input JSON
        $nama = isset($input['nama']) ? trim($input['nama']) : '';
        $prodi = isset($input['prodi']) ? trim($input['prodi']) : '';
        $nisn = isset($input['nisn']) ? trim($input['nisn']) : '';

        // Log nilai yang diterima
        error_log("Nama: $nama, Prodi: $prodi, NISN: $nisn");

        // Validasi bahwa semua field yang penting tidak kosong
        if (empty($nama) || empty($prodi) || empty($nisn)) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Semua data harus diisi']);
            return;
        }

        // Panggil koneksi database
        $pdo = Database::getConnection();

        // Siapkan query untuk update data profile
        $stmt = $pdo->prepare("UPDATE students SET 
                                name = :nama,
                                expertise = :prodi,
                                nisn = :nisn
                               WHERE id = :id");

        // Bind parameter dengan nilai yang diterima
        $stmt->bindParam(':nama', $nama);
        $stmt->bindParam(':prodi', $prodi);
        $stmt->bindParam(':nisn', $nisn);
        $stmt->bindParam(':id', $studentId);

        // Eksekusi query untuk update student
        if ($stmt->execute()) {
            http_response_code(200);
            echo json_encode(['success' => true, 'message' => 'Data profil berhasil diperbarui']);
        } else {
            http_response_code(500);
            echo json_encode(['success' => false, 'message' => 'Gagal memperbarui data profil']);
        }
    }

    public function getProfile($studentId)
    {
        $pdo = Database::getConnection();

        $stmt = $pdo->prepare("SELECT 
                                students.name AS nama, 
                                students.expertise AS prodi, 
                                students.nisn AS nisn, 
                                groups.id AS groupId, 
                                mentors.name AS pembimbing
                                FROM students
                                JOIN groups ON groups.id = students.group_id
                                JOIN mentors ON mentors.id = groups.nip
                                WHERE students.id = :id");

        $stmt->bindParam(':id', $studentId);
        $stmt->execute();
        $student = $stmt->fetch(PDO::FETCH_ASSOC);

        // Jika data ditemukan
        if ($student) {
            http_response_code(200);
            echo json_encode([
                'success' => true,
                'data' => [
                    'nama' => $student['nama'],
                    'prodi' => $student['prodi'],
                    'nisn' => $student['nisn'],
                    'groupId' => $student['groupId'],
                    'pembimbing' => $student['pembimbing'],
                ]
            ]);
        } else {
            // Jika data tidak ditemukan
            http_response_code(404);
            echo json_encode(['success' => false, 'message' => 'Data student tidak ditemukan']);
        }
    }

    public function getDudiData($studentId)
    {
        // Mendapatkan koneksi ke database
        $pdo = Database::getConnection();

        // Langkah 1: Ambil group_id berdasarkan nis dari tabel students
        $stmt = $pdo->prepare("SELECT group_id FROM students WHERE id = :nis");
        $stmt->bindParam(':nis', $studentId, PDO::PARAM_INT);
        $stmt->execute();
        $student = $stmt->fetch(PDO::FETCH_ASSOC);

        // Jika data student ditemukan
        if ($student) {
            $groupId = $student['group_id'];

            // Langkah 2: Ambil iduka_id dari tabel groups berdasarkan group_id
            $stmtGroup = $pdo->prepare("SELECT iduka_id FROM groups WHERE id = :group_id");
            $stmtGroup->bindParam(':group_id', $groupId, PDO::PARAM_INT);
            $stmtGroup->execute();
            $group = $stmtGroup->fetch(PDO::FETCH_ASSOC);

            // Jika data group ditemukan
            if ($group) {
                $idukaId = $group['iduka_id'];

                // Langkah 3: Ambil data Dudi dari tabel idukas menggunakan iduka_id
                $stmtDudi = $pdo->prepare("SELECT name AS dudiNama, address AS dudiAlamat, mentor AS dudiPimpinan FROM idukas WHERE id = :iduka_id");
                $stmtDudi->bindParam(':iduka_id', $idukaId, PDO::PARAM_INT);
                $stmtDudi->execute();
                $dudi = $stmtDudi->fetch(PDO::FETCH_ASSOC);

                // Jika data Dudi ditemukan
                if ($dudi) {
                    echo json_encode([
                        'success' => true,
                        'data' => [
                            'dudiNama' => $dudi['dudiNama'],
                            'dudiAlamat' => $dudi['dudiAlamat'],
                            'dudiPimpinan' => $dudi['dudiPimpinan']
                        ]
                    ]);
                } else {
                    // Jika data Dudi tidak ditemukan
                    echo json_encode(['success' => false, 'message' => 'Data Dudi tidak ditemukan']);
                }
            } else {
                // Jika group_id tidak ditemukan di tabel groups
                echo json_encode(['success' => false, 'message' => 'Data Group tidak ditemukan']);
            }
        } else {
            // Jika nis tidak ditemukan di tabel students
            echo json_encode(['success' => false, 'message' => 'Data Student tidak ditemukan']);
        }
    }
}
?>
