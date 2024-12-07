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
            INSERT INTO presences (sick, permission, practice_id, confirmless)
            VALUES (:sick, :permission, :practice_id, :confirmless)
        ");

            $stmt->execute([
                ':sick' => 0, // Default jumlah sakit 0
                ':permission' => 0, // Default jumlah izin 0
                ':practice_id' => $practiceId,
                ':confirmless' => 0
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
            SELECT id
            FROM practices
            WHERE nis = :nis
        ";

            $stmt = $pdo->prepare($query);
            $stmt->bindValue(':nis', value: $nis);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $_SESSION['flash'] = [
                'type' => 'error',
                'message' => 'Terjadi kesalahan saat mengambil data practices: ' . $e->getMessage(),
            ];

            return [];
        }
    }

    public static function LearningStd($practiceId)
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

    public static function PresenceStd($practiceId)
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

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $_SESSION['flash'] = [
                'type' => 'error',
                'message' => 'Terjadi kesalahan saat mengambil data presences: ' . $e->getMessage(),
            ];

            return [];
        }
    }

    public static function update($id, $score, $deskripsi)
    {
        try {
            $pdo = Database::getConnection();
            $stmt = $pdo->prepare("
                    UPDATE learnings
                    SET score = :score, description = :description
                    WHERE id = :id
                ");
            $stmt->bindValue(':score', $score, PDO::PARAM_INT);
            $stmt->bindValue(':description', $deskripsi, PDO::PARAM_STR);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            $_SESSION['flash'] = [
                'type' => 'success',
                'message' => 'Update penilaian siswa berhasil!'
            ];
        } catch (PDOException $e) {
            // Menyimpan pesan error dalam session
            $_SESSION['flash'] = [
                'type' => 'error',
                'message' => 'Terjadi kesalahan saat mengupdate penilaian: ' . $e->getMessage()
            ];
        }
    }

    public static function update2($id, $sakit, $izin, $bolos)
    {
        try {
            $pdo = Database::getConnection();
            $stmt = $pdo->prepare("
                    UPDATE presences
                    SET sick = :sick, permission = :permission, confirmless = :confirmless
                    WHERE id = :id
                ");
            $stmt->bindValue(':sick', $sakit);
            $stmt->bindValue(':permission', $izin);
            $stmt->bindValue(':confirmless', $bolos);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            $_SESSION['flash'] = [
                'type' => 'success',
                'message' => 'Update kehadiran siswa berhasil!'
            ];
        } catch (PDOException $e) {
            // Menyimpan pesan error dalam session
            $_SESSION['flash'] = [
                'type' => 'error',
                'message' => 'Terjadi kesalahan saat mengupdate kehadiran: ' . $e->getMessage()
            ];
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
}
