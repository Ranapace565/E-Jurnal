<?php
// LoginController.php
header('Content-Type: application/json');
require_once __DIR__ . '/../../config/database.php';
class ObservationController
{
    public function observationroute()
    {
        $requestMethod = $_SERVER['REQUEST_METHOD'];
        $requestUri = $_SERVER['REQUEST_URI'];

        require_once __DIR__ . '/../middleware/ApiMiddleware.php';
        switch ($requestMethod) {

            case 'GET':
                if ($requestUri === '/api/student/observation') {
                    AuthMiddleware::check();
                    $this->findObservasi($this->findstudent());
                }
                break;

            default:
                echo json_encode(["error-function" => "Fungsi Not found :( "]);
                break;
        }
    }

    // Endpoint untuk mendapatkan observasi berdasarkan ID student
    // public function getObservation($student_id)
    // {
    //     $pdo = Database::getConnection();

    //     // Query untuk mendapatkan observasi berdasarkan student_id
    //     $stmt = $pdo->prepare("
    //         SELECT o.id AS observation_id, o.nis, o.job, i.id AS indicator_id, i.description AS indicator_description, ind.objective, ind.achievement, n.description AS note
    //         FROM observations o
    //         LEFT JOIN indicators i ON o.id = i.observation_id
    //         LEFT JOIN indicatories ind ON i.id = ind.indicators_id
    //         LEFT JOIN notes n ON o.id = n.observation_id
    //         WHERE o.nis = :student_id
    //     ");
    //     $stmt->bindParam(':student_id', $student_id);
    //     $stmt->execute();
    //     $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    //     // Memproses hasil query menjadi format JSON sesuai kebutuhan
    //     $observations = [];
    //     foreach ($results as $row) {
    //         // Periksa apakah observasi sudah ada di array
    //         if (!isset($observations[$row['observation_id']])) {
    //             $observations[$row['observation_id']] = [
    //                 'description' => $row['job'],
    //                 'indicatories' => [],
    //                 'notes' => []
    //             ];
    //         }

    //         // Tambahkan indikator ke observasi
    //         $observations[$row['observation_id']]['indicatories'][] = [
    //             'objective' => $row['objective'],
    //             'achievement' => $row['achievement']
    //         ];

    //         // Tambahkan catatan jika belum ada
    //         if (!in_array($row['note'], $observations[$row['observation_id']]['notes']) && $row['note']) {
    //             $observations[$row['observation_id']]['notes'][] = $row['note'];
    //         }
    //     }

    //     // Mengembalikan data dalam format JSON
    //     header('Content-Type: application/json');
    //     echo json_encode(array_values($observations));
    // }

    function findObservasi($nis)
    {
        $pdo = Database::getConnection();

        // Query untuk mendapatkan observasi dan nama siswa berdasarkan nis
        $stmt = $pdo->prepare("
        SELECT students.name, observations.*
        FROM observations 
        LEFT JOIN students ON observations.nis = students.id
        WHERE observations.nis = :nis
    ");
        $stmt->bindParam(':nis', $nis);
        $stmt->execute();
        $observation = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($observation) {
            // Memanggil fungsi findIndicator untuk mendapatkan indikator terkait
            $indicators = $this->findIndicator($observation['id']);
            $notes = $this->Notes($observation['id']);

            http_response_code(200);
            echo json_encode([
                'success' => true,
                'observation' => [
                    'nis' => $observation['nis'],
                    'nama' => $observation['name'],
                    'job' => $observation['job'],
                    'indicators' => $indicators,
                    'notes' => $notes,
                ]
            ]);
        } else {
            http_response_code(404);
            echo json_encode(['success' => false, 'message' => 'Data student tidak ditemukan']);
        }
    }

    function findIndicator($observationId)
    {
        $pdo = Database::getConnection();

        // Query untuk mendapatkan semua indikator berdasarkan observation_id
        $stmt = $pdo->prepare("
        SELECT * FROM indicators WHERE observation_id = :id
    ");
        $stmt->bindParam(':id', $observationId);
        $stmt->execute();
        $indicators = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $result = [];
        foreach ($indicators as $indicator) {
            // Panggil fungsi findIndicatorie untuk mendapatkan indicatories terkait
            $indicatories = $this->findIndicatorie($indicator['id']);

            // $result[] = [
            //     'description' => $indicator['description'],
            //     'objective' => $indicatories
            // ];

            $result[] = [
                $indicator['description'] => $indicatories,
                // 'objective' => $indicatories
            ];
        }

        return $result;
    }

    function findIndicatorie($indicatorId)
    {
        $pdo = Database::getConnection();

        // Query untuk mendapatkan semua indicatories berdasarkan indicators_id
        $stmt = $pdo->prepare("
        SELECT * FROM indicatories WHERE indicators_id = :id
    ");
        $stmt->bindParam(':id', $indicatorId);
        $stmt->execute();
        $indicatories = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $result = [];
        foreach ($indicatories as $indicatory) {
            // $result[] = [
            //     'objective' => $indicatory['objective'],
            //     'achievement' => $indicatory['achievement']
            // ];

            $result[] = [
                $indicatory['objective'] => $indicatory['achievement']
                // 'achievement' => $indicatory['achievement']
            ];
        }

        return $result;
    }

    function Notes($observation_id)
    {
        $pdo = Database::getConnection();

        // Query untuk mendapatkan catatan berdasarkan observation_id
        $stmt = $pdo->prepare("
        SELECT *
        FROM notes 
        WHERE observation_id = :observation_id
    ");
        $stmt->bindParam(':observation_id', $observation_id);
        $stmt->execute();
        $notes = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $result = [];
        foreach ($notes as $note) {
            $result[] = [
                'objective' => $note['objective'],
                'description' => $note['description']
            ];
        }

        return $result;
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
