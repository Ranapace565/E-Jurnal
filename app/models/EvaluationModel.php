<?php

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/ObservationModel.php';
require_once __DIR__ . '/AkunModel.php';

class EvaluationModel
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Database::getConnection();
    }

    public function createPractice($nis)
    {
        $objective = [
            'Menerapkan soft skill yang dibutuhkan dalam dunia kerja (tempat PKL)',
            'Menerapkan norma, POS dan K3LH yang ada pada dunia kerja (tempat PKL)',
            'Menerapkan Kompetensi teknis yang sudah dipelajari di sekolah dan /atau baru dipelajari pada dunia kerja (tempat PKL)',
            'Memahami alur bisnis dunia kerja tempat PKL'
        ];

        try {
            $pdo = Database::getConnection();

            // Buat data practice
            $stmt = $pdo->prepare("INSERT INTO practices (nis) VALUES (:nis)");
            $stmt->execute([':nis' => $nis]);
            $practiceId = $pdo->lastInsertId();

            // Buat data learning berdasarkan id practice
            $stmt = $pdo->prepare("
            INSERT INTO learnings (objective, score, description, practice_id)
            VALUES (:objective, :score, :description, :practice_id)
        ");

            foreach ($objective as $obj) {
                $stmt->execute([
                    ':objective' => $obj,
                    ':score' => 0, // Default score 0
                    ':description' => '-',
                    ':practice_id' => $practiceId
                ]);
            }

            // Buat data presence
            $this->createPresent($practiceId);

            return ['success' => true, 'practice_id' => $practiceId];
        } catch (PDOException $e) {
            $_SESSION['flash'] = [
                'type' => 'error',
                'message' => 'Terjadi kesalahan saat membuat penilaian: ' . $e->getMessage(),
            ];

            return [];
        }
    }

    public function createPresent($practiceId)
    {
        try {
            $pdo = Database::getConnection();
            $stmt = $pdo->prepare("
            INSERT INTO presences (sick, permission, practice_id)
            VALUES (:sick, :permission, :practice_id)
        ");

            $stmt->execute([
                ':sick' => 0, // Default jumlah sakit 0
                ':permission' => 0, // Default jumlah izin 0
                ':practice_id' => $practiceId
            ]);

            return ['success' => true];
        } catch (PDOException $e) {
            $_SESSION['flash'] = [
                'type' => 'error',
                'message' => 'Terjadi kesalahan saat membuat data kehadiran: ' . $e->getMessage(),
            ];

            return [];
        }
    }


    public static function PracticeByStd($nis)
    {
        try {
            $pdo = Database::getConnection();

            $query = "
            SELECT *
            FROM practices
            WHERE nis = :nis
        ";

            $stmt = $pdo->prepare($query);
            $stmt->bindValue(':nis', value: $nis);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $_SESSION['flash'] = [
                'type' => 'error',
                'message' => 'Terjadi kesalahan saat mengambil data practices: ' . $e->getMessage(),
            ];

            return [];
        }
    }

    public static function Learning($practiceId)
    {
        try {
            $pdo = Database::getConnection();

            $query = "
            SELECT *
            FROM learnings
            WHERE practice_id = :practiceId
        ";

            $stmt = $pdo->prepare($query);
            $stmt->bindValue(':practiceId', $practiceId, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $_SESSION['flash'] = [
                'type' => 'error',
                'message' => 'Terjadi kesalahan saat mengambil data learnings: ' . $e->getMessage(),
            ];

            return [];
        }
    }

    public static function Presence($practiceId)
    {
        try {
            $pdo = Database::getConnection();

            $query = "
                SELECT *
                FROM presences
                WHERE practice_id = :practiceId
            ";

            $stmt = $pdo->prepare($query);
            $stmt->bindValue(':practiceId', $practiceId, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $_SESSION['flash'] = [
                'type' => 'error',
                'message' => 'Terjadi kesalahan saat mengambil data presences: ' . $e->getMessage(),
            ];

            return [];
        }
    }


    public static function getAll($search = '', $limit = 10, $offset = 0)
    {
        try {
            $pdo = Database::getConnection();
            $query = "
        SELECT 
            students.id AS nis, 
            COALESCE(students.name, '') AS nama, 
            COALESCE(students.expertise, '') AS prodi, 
            COALESCE(idukas.name, '') AS dudi, 
            COALESCE(mentors.name, '') AS pembimbing, 
            COALESCE(users.username, '') AS username,
            COALESCE(students.sex, '') AS kelamin,
            COALESCE(students.address, '') AS alamat,
            CASE 
                WHEN students.id LIKE :search THEN 6
                WHEN students.name LIKE :search THEN 5
                WHEN students.expertise LIKE :search THEN 4
                WHEN idukas.name LIKE :search THEN 3
                WHEN mentors.name LIKE :search THEN 2
                WHEN users.username LIKE :search THEN 1
                ELSE 7
            END AS relevance
        FROM students
        LEFT JOIN groups ON students.group_id = groups.id
        LEFT JOIN idukas ON groups.iduka_id = idukas.id
        LEFT JOIN mentors ON groups.nip = mentors.id
        LEFT JOIN users ON students.user_id = users.id
        ";

            if (!empty($search)) {
                $query .= "
            WHERE 
                students.id LIKE :search OR
                students.name LIKE :search OR
                students.expertise LIKE :search OR
                idukas.name LIKE :search OR
                mentors.name LIKE :search OR
                users.username LIKE :search
            ";
            }

            $query .= "
        ORDER BY relevance DESC, students.id ASC
        LIMIT :limit OFFSET :offset
        ";

            $stmt = $pdo->prepare($query);

            if (!empty($search)) {
                $stmt->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
            }

            $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
            $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);

            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Menyimpan pesan error dalam session
            $_SESSION['flash'] = [
                'type' => 'error',
                'message' => 'Terjadi kesalahan saat mengambil data: ' . $e->getMessage()
            ];

            // Mengembalikan array kosong jika terjadi error
            return [];
        }
    }


    public static function getPerDudi($id, $search = '', $limit = 10, $offset = 0)
    {
        try {
            $pdo = Database::getConnection();
            $query = "
            SELECT 
                students.id AS nis,
                COALESCE(students.name, '') AS nama, 
                COALESCE(students.expertise, '') AS prodi, 
                COALESCE(idukas.name, '') AS dudi, 
                COALESCE(mentors.name, '') AS pembimbing, 
                COALESCE(users.username, '') AS username,
                COALESCE(students.sex, '') AS kelamin,
                COALESCE(students.address, '') AS alamat,
                CASE 
                    WHEN students.id LIKE :search THEN 6
                    WHEN students.name LIKE :search THEN 5
                    WHEN students.expertise LIKE :search THEN 4
                    WHEN idukas.name LIKE :search THEN 3
                    WHEN mentors.name LIKE :search THEN 2
                    WHEN users.username LIKE :search THEN 1
                    ELSE 7
                END AS relevance
            FROM students
            LEFT JOIN groups ON students.group_id = groups.id
            LEFT JOIN idukas ON groups.iduka_id = idukas.id
            LEFT JOIN mentors ON groups.nip = mentors.id
            LEFT JOIN users ON idukas.user_id = users.id
            WHERE users.id = :id
        ";

            if (!empty($search)) {
                $query .= "
                AND (
                    students.id LIKE :search OR
                    students.name LIKE :search OR
                    students.expertise LIKE :search OR
                    idukas.name LIKE :search OR
                    mentors.name LIKE :search OR
                    users.username LIKE :search
                )
            ";
            }

            $query .= "
            ORDER BY relevance DESC, students.id ASC
            LIMIT :limit OFFSET :offset
        ";

            $stmt = $pdo->prepare($query);

            $stmt->bindValue(':id', $id, PDO::PARAM_INT);

            if (!empty($search)) {
                $stmt->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
            }

            $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT); // Cast to ensure int
            $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT); // Cast to ensure int

            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Menyimpan pesan error dalam session
            $_SESSION['flash'] = [
                'type' => 'error',
                'message' => 'Terjadi kesalahan saat mengambil data: ' . $e->getMessage()
            ];

            // Mengembalikan array kosong jika terjadi error
            return [];
        }
    }


    public function isNisExist($nis)
    {
        try {
            $db = Database::getConnection();
            $query = $db->prepare("SELECT COUNT(*) FROM students WHERE id = ?");
            $query->execute([$nis]);
            return $query->fetchColumn() > 0;
        } catch (PDOException $e) {
            $_SESSION['flash'] = [
                'type' => 'error',
                'message' => 'Terjadi kesalahan saat memeriksa NIS: ' . $e->getMessage(),
            ];
            return false; // Default jika error
        }
    }

    public static function getById($id)
    {
        try {
            $pdo = Database::getConnection();

            // Query untuk mengambil data berdasarkan id
            $query = "
                        SELECT 
                students.id AS nis, 
                users.id AS user_id, 
                COALESCE(students.name, '') AS nama, 
                COALESCE(students.expertise, '') AS prodi, 
                COALESCE(idukas.name, '') AS dudi, 
                COALESCE(mentors.name, '') AS pembimbing, 
                COALESCE(users.username, '') AS username,
                COALESCE(students.sex, '') AS kelamin,
                COALESCE(students.address, '') AS alamat,
                COALESCE(users.id, '') AS user_id
                FROM students
                LEFT JOIN groups ON students.group_id = groups.id
                LEFT JOIN idukas ON groups.iduka_id = idukas.id
                LEFT JOIN mentors ON groups.nip = mentors.id
                LEFT JOIN users ON students.user_id = users.id
                WHERE students.id = :id;
        ";

            // Persiapan query
            $stmt = $pdo->prepare($query);

            // Bind parameter id
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);

            // Eksekusi query
            $stmt->execute();

            // Mengembalikan data dalam bentuk array
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Menyimpan pesan error dalam session
            $_SESSION['flash'] = [
                'type' => 'error',
                'message' => 'Terjadi kesalahan saat mengambil data: ' . $e->getMessage(),
            ];

            // Mengembalikan null jika terjadi error
            return null;
        }
    }
}
