<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../../config/database.php';

class ActivityController
{
    public function activityroute()
    {
        $requestMethod = $_SERVER['REQUEST_METHOD'];
        $requestUri = $_SERVER['REQUEST_URI'];

        // Middleware atau validasi akses API
        require_once __DIR__ . '/../middleware/ApiMiddleware.php';

        switch ($requestMethod) {
            case 'GET':
                // Pencocokan untuk URI tertentu
                if (preg_match('/^\/api\/activity\/mobile/', $requestUri)) {
                    $this->getActivitiesMobile();
                } else if (preg_match('/^\/api\/activity\/getJumlah\/(\d+)/', $requestUri, $matches)) {
                    $nis = $matches[1];
                    $this->getJumlahActivity($nis);
                } else {
                    $this->handleGet($requestUri);
                }
                break;

            case 'POST':
                // Pencocokan untuk URI save
                if (preg_match('/^\/api\/activity\/save/', $requestUri)) {
                    $this->saveActivity();
                } else {
                    $this->handleNotFound();
                }
                break;

            case 'PUT':
                // Check for update activity request
                if (preg_match('/\/api\/activity\/updateActivity\/(\d+)/', $requestUri, $matches)) {
                    $nis = $matches[1];
                    $this->updateActivity($nis); // Handle PUT request
                } else {
                    $this->handleNotFound();
                }
                break;

            default:
                header('Content-Type: application/json');
                echo json_encode(['error' => 'Method not allowed']);
                http_response_code(405);
                break;
        }
    }

    private function handleGet($requestUri)
    {
        header('Content-Type: application/json');
        echo json_encode(['message' => "GET request berhasil pada URI: $requestUri"]);
    }

    // Mendapatkan jumlah kegiatan berdasarkan NIS dan status approve (Proses, Terima, Tolak)
    function getJumlahActivity($nis)
    {
        // Mendapatkan koneksi PDO dari kelas Database
        $pdo = Database::getConnection();

        // Query untuk menghitung jumlah kegiatan berdasarkan NIS dan status approve
        $query = "
            SELECT
                SUM(CASE WHEN approve = 3 THEN 1 ELSE 0 END) AS jumlah_proses,
                SUM(CASE WHEN approve = 1 THEN 1 ELSE 0 END) AS jumlah_terima,
                SUM(CASE WHEN approve = 2 THEN 1 ELSE 0 END) AS jumlah_tolak
            FROM activitys 
            WHERE nis = :nis
        ";
        
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':nis', $nis, PDO::PARAM_INT);
        $stmt->execute();

        // Mendapatkan hasil query
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        // Menyiapkan response JSON
        if ($result) {
            echo json_encode([
                'success' => true,
                'jumlah_proses' => (int) $result['jumlah_proses'],
                'jumlah_terima' => (int) $result['jumlah_terima'],
                'jumlah_tolak' => (int) $result['jumlah_tolak']
            ]);
        } else {
            echo json_encode(['error' => 'Tidak ada kegiatan ditemukan untuk NIS tersebut']);
        }
    }
    
    public function saveActivity()
    {
        // Ambil data JSON dari body request
        $input = json_decode(file_get_contents("php://input"), true);

        // Validasi JSON yang diterima
        if (!$input) {
            http_response_code(400);
            $response = ['success' => false, 'message' => 'Input JSON tidak valid'];
            echo json_encode($response);
            return;
        }

        // Ambil data dari input JSON
        $nis = $input['nis'] ?? '';
        $date = $input['date'] ?? '';
        $activity = $input['activity'] ?? '';
        $description = $input['description'] ?? '';

        // Validasi data
        if (empty($nis) || empty($date) || empty($activity)) {
            http_response_code(400);
            $response = ['success' => false, 'message' => 'NIS, date, dan activity tidak boleh kosong'];
            echo json_encode($response);
            return;
        }

        // Ambil minggu berdasarkan nis
        $week = $this->week($nis, $date);

        // Simpan activity ke dalam database
        $pdo = Database::getConnection();

        $query = "
            INSERT INTO activitys (date, activity, description, approve, week, nis)
            VALUES (:date, :activity, :description, 3, :week, :nis)
        ";

        $stmt = $pdo->prepare($query);

        $stmt->bindParam(':date', $date, PDO::PARAM_STR);
        $stmt->bindParam(':activity', $activity, PDO::PARAM_STR);
        $stmt->bindParam(':description', $description, PDO::PARAM_STR);
        $stmt->bindParam(':week', $week, PDO::PARAM_INT);
        $stmt->bindParam(':nis', $nis, PDO::PARAM_INT);

        if ($stmt->execute()) {
            http_response_code(200);
            echo json_encode(['success' => true, 'message' => 'Data berhasil disimpan']);
        } else {
            http_response_code(500);
            echo json_encode(['success' => false, 'message' => 'Gagal menyimpan data kegiatan']);
        }
    }

    // Mendapatkan minggu berdasarkan nis dan tanggal
    public function week($nis, $tanggalAkhir)
    {
        // Ambil group_id berdasarkan nis
        $pdo = Database::getConnection();
        $query = "SELECT group_id FROM students WHERE id = :nis";
        $stmt = $pdo->prepare($query);
        $stmt->bindValue(':nis', $nis, PDO::PARAM_INT);
        $stmt->execute();
        $siswaData = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$siswaData) {
            return "Siswa tidak ditemukan.";
        }

        $groupId = $siswaData['group_id'];

        // Ambil data group berdasarkan group_id
        $queryGroup = "SELECT date_start FROM groups WHERE id = :groupId";
        $stmtGroup = $pdo->prepare($queryGroup);
        $stmtGroup->bindParam(':groupId', $groupId, PDO::PARAM_INT);
        $stmtGroup->execute();
        $groupData = $stmtGroup->fetch(PDO::FETCH_ASSOC);

        if (!$groupData) {
            return "Group tidak ditemukan.";
        }

        $awal = $groupData['date_start'];
        $tanggalAkhir = strtotime($tanggalAkhir);
        $awal = strtotime($awal);

        if (!$tanggalAkhir || !$awal) {
            return "Format tanggal tidak valid.";
        }

        if ($awal > $tanggalAkhir) {
            return "Tanggal awal harus lebih kecil atau sama dengan tanggal akhir.";
        }

        // Hitung selisih hari
        $hariSelisih = ($tanggalAkhir - $awal) / (60 * 60 * 24);
        $mingguKe = floor($hariSelisih / 7) + 1;

        return $mingguKe;
    }

    public function getActivitiesMobile()
    {
        // Mendapatkan koneksi PDO dari kelas Database
        $db = Database::getConnection();

        // Ambil nis dari request
        $nis = isset($_GET['nis']) ? $_GET['nis'] : null;

        if (!$nis) {
            echo json_encode(['error' => 'NIS tidak ditemukan']);
            return;
        }

        // Query untuk mengambil kegiatan berdasarkan NIS
        $query = "
            SELECT id, date, activity, description, approve
            FROM activitys 
            WHERE nis = :nis ORDER BY date DESC
        ";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':nis', $nis, PDO::PARAM_INT);
        $stmt->execute();

        $activities = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Mengembalikan hasil kegiatan dalam format JSON
        if ($activities) {
            echo json_encode(['success' => true, 'data' => $activities]);
        } else {
            echo json_encode(['error' => 'Tidak ada kegiatan ditemukan']);
        }
    }
    
    function updateActivity($nis)
    {
        // Get input JSON from the body of the request
        $input = json_decode(file_get_contents("php://input"), true);

        // Validate the input data
        if (!$input || !isset($input['id']) || !isset($input['activity']) || !isset($input['date']) || !isset($input['description'])) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Invalid input data']);
            return;
        }

        $id = $input['id'];
        $activity = $input['activity'];
        $date = $input['date'];
        $description = $input['description'];

        // Update the activity in the database
        $pdo = Database::getConnection();
        $query = "
            UPDATE activitys
            SET activity = :activity, date = :date, description = :description, approve = 3
            WHERE id = :id AND nis = :nis
        ";

        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':activity', $activity, PDO::PARAM_STR);
        $stmt->bindParam(':date', $date, PDO::PARAM_STR);
        $stmt->bindParam(':description', $description, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':nis', $nis, PDO::PARAM_INT);

        if ($stmt->execute()) {
            http_response_code(200);
            echo json_encode(['success' => true, 'message' => 'Activity updated successfully']);
        } else {
            http_response_code(500);
            echo json_encode(['success' => false, 'message' => 'Failed to update activity']);
        }
    }
}
?>
