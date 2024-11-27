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

        require_once __DIR__ . '/../middleware/ApiMiddleware.php';
        switch ($requestMethod) {
            case 'GET':
                if (preg_match('/\/api\/student\/(\d+)/', $requestUri, $matches)) {
                    AuthMiddleware::check();
                    $studentId = $matches[1];
                    $this->getStudentData($studentId);
                }
                break;

            case 'PUT':
                if (preg_match('/\/api\/student\/update\/(\d+)/', $requestUri, $matches)) {
                    AuthMiddleware::check();
                    $studentId = $matches[1];
                    $this->updateStudentData($studentId);
                }
                break;

            default:
                echo json_encode(["error-function" => "Fungsi Not found :( "]);
                break;
        }
    }

    // Fungsi untuk mendapatkan data student berdasarkan ID
    function getStudentData($studentId)
    {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare("SELECT students.*, users.username, users.password FROM students join users WHERE users.id = :id");
        $stmt->bindParam(':id', $studentId);
        $stmt->execute();
        $student = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($student) {
            http_response_code(200);
            echo json_encode([
                'success' => true,
                'data' => $student
            ]);
        } else {
            http_response_code(404);
            echo json_encode(['success' => false, 'message' => 'Data student tidak ditemukan']);
        }
    }

    // Fungsi untuk mengupdate data student berdasarkan ID
    function updateStudentData($studentId)
    {
        $input = json_decode(file_get_contents("php://input"), true);

        if (!$input) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Input JSON tidak valid']);
            return;
        }

        // Ambil data dari input JSON
        $name = $input['name'] ?? '';
        $born_place = $input['born_place'] ?? '';
        $born_date = $input['born_date'] ?? '';
        $sex = $input['sex'] ?? null;  // Pastikan tipe data integer
        $blood_type = $input['blood_type'] ?? '';
        $address = $input['address'] ?? '';
        $telp = $input['telp'] ?? '';
        $health_note = $input['health_note'] ?? '';
        $parent_name = $input['parent_name'] ?? '';
        $parent_telp = $input['parent_telp'] ?? '';
        $expertise = $input['expertise'] ?? '';
        $competence = $input['competence'] ?? '';
        $nisn = $input['nisn'] ?? '';

        // Validasi data yang penting jika perlu (contoh: name dan born_date harus ada)
        if (empty($name) || empty($telp)) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Nama dan no telp harus diisi']);
            return;
        }

        // Buat koneksi dan query SQL untuk update
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare("UPDATE students SET 
                            name = :name, 
                            born_place = :born_place, 
                            born_date = :born_date, 
                            sex = :sex, 
                            blood_type = :blood_type, 
                            address = :address, 
                            telp = :telp, 
                            health_note = :health_note, 
                            parent_name = :parent_name, 
                            parent_telp = :parent_telp, 
                            expertise = :expertise, 
                            competence = :competence, 
                            nisn = :nisn
                           WHERE id = :id");

        // Bind setiap parameter dengan variabelnya
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':born_place', $born_place);
        $stmt->bindParam(':born_date', $born_date);
        $stmt->bindParam(':sex', $sex, PDO::PARAM_INT);
        $stmt->bindParam(':blood_type', $blood_type);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':telp', $telp);
        $stmt->bindParam(':health_note', $health_note);
        $stmt->bindParam(':parent_name', $parent_name);
        $stmt->bindParam(':parent_telp', $parent_telp);
        $stmt->bindParam(':expertise', $expertise);
        $stmt->bindParam(':competence', $competence);
        $stmt->bindParam(':nisn', $nisn);
        $stmt->bindParam(':id', $studentId, PDO::PARAM_INT);

        echo "aprianto";
        // Eksekusi statement
        if ($stmt->execute()) {
            http_response_code(200);
            echo json_encode(['success' => true, 'message' => 'Data student berhasil diperbarui']);
        } else {
            http_response_code(500);
            echo json_encode(['success' => false, 'message' => 'Gagal memperbarui data student']);
        }
    }
}
