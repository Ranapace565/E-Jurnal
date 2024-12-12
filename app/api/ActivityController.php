<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../../config/database.php';

class ActivityController
{
    public function activityroute()
    {
        // Mendapatkan method dan URI dari request
        $requestMethod = $_SERVER['REQUEST_METHOD'];
        $requestUri = $_SERVER['REQUEST_URI'];

        // Menyertakan middleware
        require_once __DIR__ . '/../middleware/ApiMiddleware.php';

        // Handle request berdasarkan request method
        switch ($requestMethod) {
            case 'GET':
                if (strpos($requestUri, '/api/activity/mobile') !== false) {
                    $this->getActivitiesMobile();
                } else {
                    $this->handleGet($requestUri);
                }
                break;

            case 'POST':
                $this->handlePost($requestUri);
                break;

            default:
                header('Content-Type: application/json');
                echo json_encode(['error' => 'Method not allowed']);
                http_response_code(405);
                break;
        }
    }

    // Method untuk handle request GET
    private function handleGet($requestUri)
    {
        header('Content-Type: application/json');
        echo json_encode(['message' => "GET request berhasil pada URI: $requestUri"]);
    }

    // Method untuk handle request POST
    private function handlePost($requestUri)
    {
        $postData = file_get_contents('php://input');
        $decodedData = json_decode($postData, true);

        header('Content-Type: application/json');
        echo json_encode([
            'message' => "POST request berhasil pada URI: $requestUri",
            'data' => $decodedData,
        ]);
    }
} 

   <?php
    header('Content-Type: application/json');
    require_once __DIR__ . '/../../config/database.php';


    class ActivityController
    {
        public function activityroute()
        {
            // Mendapatkan method dan URI dari request
            $requestMethod = $_SERVER['REQUEST_METHOD'];
            $requestUri = $_SERVER['REQUEST_URI'];

            // Menyertakan middleware
            require_once __DIR__ . '/../middleware/ApiMiddleware.php';

            // Handle request berdasarkan request method
            switch ($requestMethod) {
                case 'GET':
                    if (strpos($requestUri, '/api/activity/mobile') !== false) {
                        $this->getActivitiesMobile();
                    } else {
                        $this->handleGet($requestUri);
                    }
                    break;

                case 'POST':
                    $this->handlePost($requestUri);
                    break;

                default:
                    header('Content-Type: application/json');
                    echo json_encode(['error' => 'Method not allowed']);
                    http_response_code(405);
                    break;
            }
        }

        // Method untuk handle request GET
        private function handleGet($requestUri)
        {
            header('Content-Type: application/json');
            echo json_encode(['message' => "GET request berhasil pada URI: $requestUri"]);
        }

        // Method untuk handle request POST
        private function handlePost($requestUri)
        {
            $postData = file_get_contents('php://input');
            $decodedData = json_decode($postData, true);

            header('Content-Type: application/json');
            echo json_encode([
                'message' => "POST request berhasil pada URI: $requestUri",
                'data' => $decodedData,
            ]);
        }

        public function getActivitiesMobile()
        {
            // Mendapatkan koneksi PDO dari kelas Database
            $db = Database::getConnection();

            // Ambil username dari request
            $username = $_GET['username'];

            if (!$username) {
                echo json_encode(['error' => 'Username tidak ditemukan']);
                return;
            }

            // Query untuk mendapatkan id dari tabel users berdasarkan username
            $query = "SELECT id FROM users WHERE username = :username LIMIT 1";
            $stmt = $db->prepare($query);
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
            $stmt->execute();

            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$user) {
                echo json_encode(['error' => 'User tidak ditemukan']);
                return;
            }

            // Simpan user_id
            $user_id = $user['id'];

            // Query untuk mendapatkan nis dari tabel students berdasarkan user_id
            $query = "SELECT user_id FROM students WHERE user_id = :user_id LIMIT 1";
            $stmt = $db->prepare($query);
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $stmt->execute();

            $student = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$student) {
                echo json_encode(['error' => 'NIS tidak ditemukan untuk user_id ini']);
                return;
            }

            // Simpan nis
            $user_id = $student['user_id'];

            // Query untuk mengambil kegiatan berdasarkan nis
            $query = "
            SELECT id, date, activity, description, approve
            FROM activitys 
            WHERE nis = :user_id
        ";
            $stmt = $db->prepare($query);
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $stmt->execute();

            $activities = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Mengembalikan hasil kegiatan
            if ($activities) {
                echo json_encode(['success' => true, 'data' => $activities]);
            } else {
                echo json_encode(['error' => 'Tidak ada kegiatan ditemukan']);
            }
        }
    }
