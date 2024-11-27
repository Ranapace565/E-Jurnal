<?php
// LoginController.php
header('Content-Type: application/json');
require_once __DIR__ . '/../../config/database.php';
class ActivityController
{

    public function activityroute()
    {
        $requestMethod = $_SERVER['REQUEST_METHOD'];
        $requestUri = $_SERVER['REQUEST_URI'];

        require_once __DIR__ . '/../middleware/ApiMiddleware.php';

        switch ($requestMethod) {
            case 'POST':
                if ($requestUri === '/api/activity') {
                    $this->createActivity();
                }
                break;

            case 'PUT':
                if (preg_match('/\/api\/activity\/update\/(\d+)/', $requestUri, $matches)) {
                    AuthMiddleware::check();
                    $activityid = $matches[1];
                    $this->updateActivity($activityid);
                }
                break;

            case 'DELETE':
                if (preg_match('/\/api\/activity\/delete\/(\d+)/', $requestUri, $matches)) {
                    AuthMiddleware::check();
                    $activityid = $matches[1];
                    $this->deleteActivity($activityid);
                }
                break;

            case 'GET':
                if ($requestUri === '/api/activities') {
                    AuthMiddleware::check();
                    $this->getActivities();
                }
                if (preg_match('/\/api\/activity\/(\d+)/', $requestUri, $matches)) {
                    AuthMiddleware::check();
                    $activityid = $matches[1];
                    $this->getActivityDetails($activityid);
                }
                break;

            default:
                echo json_encode(["error-function" => "Fungsi Not found :( "]);
                break;
        }
    }

    function createActivity()
    {
        // 
        $input = json_decode(file_get_contents("php://input"), true);

        if (!$input) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Input JSON tidak valid']);
            return;
        }

        $date = $input['date'] ?? '';
        $activity = $input['activity'] ?? '';
        $description = $input['description'] ?? '';
        $approve = $input['approve'] ?? 0;
        $week = $input['week'] ?? '';
        $nis = $this->findstudent();

        if (empty($date) || empty($activity) || empty($week)) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Data date, activity, week, dan nis harus diisi']);
            return;
        }

        try {
            // Koneksi ke database dan persiapan query
            $pdo = Database::getConnection();
            $stmt = $pdo->prepare("INSERT INTO activitys (date, activity, description, approve, week, nis) VALUES (:date, :activity, :description, :approve, :week, :nis)");
            $stmt->bindParam(':date', $date);
            $stmt->bindParam(':activity', $activity);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':approve', $approve, PDO::PARAM_INT);
            $stmt->bindParam(':week', $week, PDO::PARAM_INT);
            $stmt->bindParam(':nis', $nis, PDO::PARAM_INT);

            if ($stmt->execute()) {
                http_response_code(201);
                echo json_encode(['success' => true, 'message' => 'Aktivitas berhasil ditambahkan']);
            } else {
                http_response_code(500);
                echo json_encode(['success' => false, 'message' => 'Gagal menambahkan aktivitas']);
            }
        } catch (PDOException $e) {
            http_response_code(500);
            echo json_encode(['success' => false, 'message' => 'Terjadi kesalahan pada server', 'error' => $e->getMessage()]);
        }
    }

    function updateActivity($id)
    {
        $input = json_decode(file_get_contents("php://input"), true);

        if (!$input) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Input JSON tidak valid']);
            return;
        }

        $date = $input['date'] ?? '';
        $activity = $input['activity'] ?? '';
        $description = $input['description'] ?? '';
        $approve = $input['approve'] ?? 0;
        $week = $input['week'] ?? '';
        // $nis = $input['nis'] ?? '';

        $pdo = Database::getConnection();
        $stmt = $pdo->prepare("UPDATE activitys SET date = :date, activity = :activity, description = :description, approve = :approve, week = :week WHERE id = :id");
        $stmt->bindParam(':date', $date);
        $stmt->bindParam(':activity', $activity);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':approve', $approve, PDO::PARAM_INT);
        $stmt->bindParam(':week', $week, PDO::PARAM_INT);
        // $stmt->bindParam(':nis', $nis, PDO::PARAM_INT);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            http_response_code(200);
            echo json_encode(['success' => true, 'message' => 'Aktivitas berhasil diperbarui']);
        } else {
            http_response_code(500);
            echo json_encode(['success' => false, 'message' => 'Gagal memperbarui aktivitas']);
        }
    }

    function deleteActivity($id)
    {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare("DELETE FROM activitys WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            http_response_code(200);
            echo json_encode(['success' => true, 'message' => 'Aktivitas berhasil dihapus']);
        } else {
            http_response_code(500);
            echo json_encode(['success' => false, 'message' => 'Gagal menghapus aktivitas']);
        }
    }

    function getActivities()
    {
        $pdo = Database::getConnection();
        $stmt = $pdo->query("SELECT * FROM activitys ORDER BY create_at DESC");
        $activities = $stmt->fetchAll(PDO::FETCH_ASSOC);

        http_response_code(200);
        echo json_encode(['success' => true, 'data' => $activities]);
    }

    function getActivityDetails($id)
    {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare("SELECT * FROM activitys WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $activity = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($activity) {
            http_response_code(200);
            echo json_encode(['success' => true, 'data' => $activity]);
        } else {
            http_response_code(404);
            echo json_encode(['success' => false, 'message' => 'Aktivitas tidak ditemukan']);
        }
    }

    function findstudent()
    {
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

        // Verifikasi pengguna berdasarkan token dan mendapatkan id student
        $stmt = $pdo->prepare("SELECT students.id FROM students JOIN users ON students.user_id = users.id WHERE users.token = :token");
        $stmt->bindParam(':token', $token);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Mengembalikan nilai id jika ditemukan
        if ($user) {
            return $user['id'];
        } else {
            http_response_code(401);
            echo json_encode(['success' => false, 'message' => 'Pengguna tidak ditemukan']);
            exit();
        }
    }
}
