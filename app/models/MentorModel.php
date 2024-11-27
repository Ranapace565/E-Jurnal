<?php

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/ObservationModel.php';
require_once __DIR__ . '/AkunModel.php';

class MentorModel
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Database::getConnection();
    }
    public static function getAll($search = '', $limit = 10, $offset = 0)
    {
        try {
            $pdo = Database::getConnection();

            // Query dasar
            $query = "
            SELECT 
                mentors.id AS id,
                users.id AS iduser,
                mentors.name AS nama,
                users.username AS username,
                COALESCE(COUNT(students.id), 0) AS total_students,
                COALESCE(COUNT(groups.id), 0) AS total_groups
            FROM mentors
            LEFT JOIN users ON mentors.user_id = users.id
            LEFT JOIN groups ON mentors.id = groups.nip
            LEFT JOIN students ON groups.id = students.group_id
        ";

            // Filter pencarian
            if (!empty($search)) {
                $query .= "
                WHERE mentors.id LIKE :search 
                OR mentors.name LIKE :search
                OR users.username LIKE :search
            ";
            }

            // Grouping dan pengurutan
            $query .= "
            GROUP BY mentors.id
            ORDER BY mentors.name ASC
            LIMIT :limit OFFSET :offset
        ";

            // Persiapan query
            $stmt = $pdo->prepare($query);

            // Parameter untuk pencarian
            if (!empty($search)) {
                $stmt->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
            }

            // Parameter untuk paginasi
            $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
            $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);

            // Eksekusi query
            $stmt->execute();

            // $mentorList = $stmt->fetchAll(PDO::FETCH_ASSOC);
            // Mengembalikan hasil dalam bentuk array
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Menyimpan pesan error dalam session
            $_SESSION['flash'] = [
                'type' => 'error',
                'message' => 'Terjadi kesalahan saat mengambil data: ' . $e->getMessage(),
            ];

            // Mengembalikan array kosong jika terjadi error
            return [];
        }
    }


    public function isMentorExist($id)
    {
        try {
            $db = Database::getConnection();
            $query = $db->prepare("SELECT COUNT(*) FROM mentors WHERE id = ?");
            $query->execute([$id]);
            return $query->fetchColumn() > 0;
        } catch (PDOException $e) {
            $_SESSION['flash'] = [
                'type' => 'error',
                'message' => 'Terjadi kesalahan saat mencari data mentor: ' . $e->getMessage(),
            ];
            return false; // Default jika error
        }
    }

    public static function countAll($search = '')
    {
        try {
            $pdo = Database::getConnection();
            $query = "
        SELECT COUNT(*) AS total
        FROM mentors
            LEFT JOIN users ON mentors.user_id = users.id
            LEFT JOIN groups ON mentors.id = groups.nip
            LEFT JOIN students ON groups.id = students.group_id
        ";

            if (!empty($search)) {
                $query .= " 
            WHERE mentors.name LIKE :search
                OR users.username LIKE :search
                OR mentors.name LIKE :search
            ";
            }

            $stmt = $pdo->prepare($query);

            if (!empty($search)) {
                $stmt->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
            }

            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
        } catch (PDOException $e) {
            // Menyimpan pesan error dalam session
            $_SESSION['flash'] = [
                'type' => 'error',
                'message' => 'Terjadi kesalahan saat menghitung data: ' . $e->getMessage()
            ];

            // Mengembalikan 0 jika terjadi error
            return 0;
        }
    }
    public function createMentor($id, $nama, $user, $pass)
    {
        if ($this->isMentorExist($id)) {
            $namamentor = $this->getById($id);
            $_SESSION['flash'] = [
                'type' => 'error',
                'message' => 'NIP ' . $namamentor['id'] . ' Pembimbing sudah terdaftar dengan nama "' . $namamentor['nama'] . '" . Proses pembuatan akses pembimbing dibatalkan',
            ];
            return false; // Kembalikan false karena proses tidak dilanjutkan
        }
        // $this->pdo->beginTransaction();
        try {
            $role = 'mentor';
            $user_id = AkunModel::createUser($user, $pass, $role);
            if (!$user_id) {
                $_SESSION['flash'] = [
                    'type' => 'error',
                    'message' => 'Gagal membuat akun Mentor'
                ];
            }

            $mentor_id = $this->create($id, $nama,  $user_id);
            if (!$mentor_id) {
                // $this->pdo->rollBack();
                $_SESSION['flash'] = [
                    'type' => 'error',
                    'message' => 'Gagal membuat data mentor'
                ];
            }

            // $this->pdo->commit();
            $_SESSION['flash'] = [
                'type' => 'success',
                'message' => 'Akses Mentor ' . $nama . ' berhasil ditambahkan!',
            ];
            return true;
        } catch (Exception $e) {
            // $this->pdo->rollBack();
            $_SESSION['flash'] = [
                'type' => 'error',
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ];
            return false;
        }
    }


    private function create($id, $name, $user)
    {
        $mentor = '';
        try {
            $stmt = $this->pdo->prepare("INSERT INTO mentors ( id, name, user_id) VALUES (:id, :name, :user)");
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':user', $user);
            $stmt->execute();

            $mentor_id = $this->pdo->lastInsertId();


            return $mentor_id;
        } catch (PDOException $e) {
            $_SESSION['flash'] = [
                'type' => 'error',
                'message' => 'Terjadi kesalahan saat membuat data mentor: ' . $e->getMessage(),
            ];
            return null; // Default jika error
        }
    }

    public static function getById($id)
    {
        try {
            $pdo = Database::getConnection();

            // Query untuk mengambil data berdasarkan id
            $query = "
            SELECT 
                users.id AS user_id,
                mentors.id AS id,
                mentors.name AS nama,
                users.username AS username,
                COALESCE(COUNT(students.id), 0) AS total_students,
                COALESCE(COUNT(groups.id), 0) AS total_groups
            FROM mentors
            LEFT JOIN users ON mentors.user_id = users.id
            LEFT JOIN groups ON mentors.id = groups.nip
            LEFT JOIN students ON groups.id = students.group_id
            WHERE mentors.id = :id 
        ";

            // Persiapan query
            $stmt = $pdo->prepare($query);

            // Bind parameter id
            $stmt->bindValue(':id', $id);

            // Eksekusi query
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log('SQL Error: ' . $e->getMessage());
            // Menyimpan pesan error dalam session
            $_SESSION['flash'] = [
                'type' => 'error',
                'message' => 'Terjadi kesalahan saat mengambil data: ' . $e->getMessage(),
            ];

            // Mengembalikan null jika terjadi error
            return null;
        }
    }



    public function resetAkses($id)
    {
        try {
            // Mengambil data iduka berdasarkan ID
            $mentor = self::getById($id);

            if (!$mentor) {
                $_SESSION['flash'] = [
                    'type' => 'error',
                    'message' => 'Data Mentor tidak ditemukan!',
                ];
            }
            $namaF = str_replace(' ', '_', $mentor['nama']);
            // Membuat password baru
            $password = 'password_' . $namaF;



            // Update akun pengguna
            $result = AkunModel::update($mentor['user_id'], $namaF, $password);

            if ($result) {
                $_SESSION['flash'] = [
                    'type' => 'success',
                    'message' => "Password untuk DUDI '{$mentor['nama']}' berhasil direset.",
                ];
            } else {
                throw new Exception("Gagal mereset password untuk DUDI '{$mentor['nama']}'.");
            }
        } catch (Exception $e) {
            $_SESSION['flash'] = [
                'type' => 'error',
                'message' => "Terjadi kesalahan reset akses DUDI: " . $e->getMessage(),
            ];
        }
    }

    public static function delete($id)
    {
        try {
            $pdo = Database::getConnection();


            require_once __DIR__ . '/AkunModel.php';

            $Mentor = self::getById($id);


            $stmt = $pdo->prepare("DELETE FROM mentors WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            if (AkunModel::delete($Mentor['user_id'])) {
                $_SESSION['flash'] = [
                    'type' => 'success',
                    'message' => 'Data Mentor ' . $Mentor['nama'] . ' berhasil dihapus!',
                ];
            } else {
                $_SESSION['flash'] = [
                    'type' => 'error',
                    'message' => 'Data Mentor ' . $Mentor['nama'] . ' gagal dihapus!',
                ];
            }

            return true;
        } catch (PDOException $e) {
            $_SESSION['flash'] = [
                'type' => 'error',
                'message' => 'Terjadi kesalahan saat menghapus Mentor: ' . $e->getMessage(),
            ];
            return false;
        }
    }
}
