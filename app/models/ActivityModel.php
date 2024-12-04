<?php

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/ObservationModel.php';
require_once __DIR__ . '/AkunModel.php';
require_once __DIR__ . '/GroupModel.php';
require_once __DIR__ . '/StudentModel.php';

class ActivityModel
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Database::getConnection();
    }
    public static function getAll($userId, $search = '', $limit = 10, $offset = 0)
    {
        $student = self::studentId($userId);
        try {
            $pdo = Database::getConnection();

            // Query dasar
            $query = "
            SELECT activitys.*, students.name AS student_name, users.username AS user_name
            FROM activitys
            LEFT JOIN students ON students.id = activitys.nis
            LEFT JOIN users ON users.id = students.user_id
            WHERE students.id = :userId
        ";

            // Filter pencarian
            if (!empty($search)) {
                $query .= "
                AND (activitys.date LIKE :search
                OR activitys.activity LIKE :search)
            ";
            }

            // Pengurutan dan paginasi
            $query .= "
            ORDER BY activitys.date ASC
            LIMIT :limit OFFSET :offset
        ";

            // Persiapan query
            $stmt = $pdo->prepare($query);

            // Parameter untuk user ID
            $stmt->bindValue(':userId', $student, PDO::PARAM_INT);

            // Parameter untuk pencarian
            if (!empty($search)) {
                $stmt->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
            }

            // Parameter untuk paginasi
            $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
            $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);

            // Eksekusi query
            $stmt->execute();

            // echo ' idnya ' . $student;
            // var_dump($stmt->fetchAll(PDO::FETCH_ASSOC));
            // die();


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


    public function isDudiExist($name)
    {
        try {
            $db = Database::getConnection();
            $query = $db->prepare("SELECT COUNT(*) FROM idukas WHERE name = ?");
            $query->execute([$name]);
            return $query->fetchColumn() > 0;
        } catch (PDOException $e) {
            $_SESSION['flash'] = [
                'type' => 'error',
                'message' => 'Terjadi kesalahan saat : ' . $e->getMessage(),
            ];
            return false; // Default jika error
        }
    }

    private static function studentId($userId)
    {
        try {
            $db = Database::getConnection();
            $query = $db->prepare("SELECT id from students WHERE user_id = ?");
            $query->execute([$userId]);
            return $query->fetchColumn();
        } catch (PDOException $e) {
            $_SESSION['flash'] = [
                'type' => 'error',
                'message' => 'Terjadi kesalahan saat : ' . $e->getMessage(),
            ];
            return false; // Default jika error
        }
    }

    public static function countAll($userId, $search = '')
    {
        $student = self::studentId($userId);
        try {
            $pdo = Database::getConnection();

            // Query dasar untuk menghitung total aktivitas
            $query = "
                SELECT COUNT(*) AS total
                FROM activitys
                LEFT JOIN students ON students.id = activitys.nis
                LEFT JOIN users ON users.id = students.user_id
                WHERE students.id = :userId
            ";

            // Filter pencarian
            if (!empty($search)) {
                $query .= " 
                    AND (activitys.date LIKE :search
                        OR activitys.activity LIKE :search)
                ";
            }

            $stmt = $pdo->prepare($query);

            // Parameter user ID
            $stmt->bindValue(':userId', $student, PDO::PARAM_INT);

            // Parameter pencarian
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

            return 0;
        }
    }


    public static function countByStatus($userId, $status, $search = '')
    {
        try {
            $pdo = Database::getConnection();

            // Query dasar untuk menghitung total aktivitas berdasarkan status
            $query = "
            SELECT COUNT(*) AS total
            FROM activitys
            LEFT JOIN students ON students.id = activitys.nis
            LEFT JOIN users ON users.id = students.user_id
            WHERE users.id = :userId
            AND activitys.approve = :status
        ";

            // Filter pencarian
            if (!empty($search)) {
                $query .= " 
                AND (activitys.date LIKE :search
                     OR activitys.activity LIKE :search)
            ";
            }

            $stmt = $pdo->prepare($query);

            // Parameter user ID dan status
            $stmt->bindValue(':userId', $userId, PDO::PARAM_INT);
            $stmt->bindValue(':status', $status, PDO::PARAM_INT);

            // Parameter pencarian
            if (!empty($search)) {
                $stmt->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
            }

            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
        } catch (PDOException $e) {
            // Menyimpan pesan error dalam session
            $_SESSION['flash'] = [
                'type' => 'error',
                'message' => 'Terjadi kesalahan saat menghitung data berdasarkan status: ' . $e->getMessage()
            ];

            return 0;
        }
    }

    function week($id, $tanggalAkhir)
    {
        $siswa = new StudentModel();
        $siswa = $siswa->show($id);
        $siswa = $siswa['group_id'];

        $awal = new GroupModel;
        $awal = $awal->getGroup($siswa);
        $awal = $awal['start'];

        try {
            $awal = new DateTime($awal);
            $akhir = new DateTime($tanggalAkhir);

            if ($awal > $akhir) {
                throw new Exception("Tanggal awal harus lebih kecil atau sama dengan tanggal akhir.");
            }

            $interval = $awal->diff($akhir);

            $hariSelisih = $interval->days;
            $mingguKe = floor($hariSelisih / 7) + 1;

            return $mingguKe;
        } catch (Exception $e) {
            return "Terjadi kesalahan: " . $e->getMessage();
        }
    }

    // Contoh penggunaan
    // $tanggalAwal = "2006-08-20";
    // $tanggalAkhir = "2006-08-29";
    // echo "Minggu ke: " . hitungMingguKe($tanggalAwal, $tanggalAkhir);



    public function createActivity($userId, $date, $activity, $description)
    {
        $week = $this->week($userId, $date);
        try {
            $pdo = Database::getConnection();
            $nis = self::studentId($userId);

            if (!$nis) {
                $_SESSION['flash'] = [
                    'type' => 'error',
                    'message' => 'Tidak ditemukan data siswa untuk userId yang diberikan.',
                ];
                return false;
            }

            $query = "
                INSERT INTO activitys (date, activity, description, approve, week, nis)
                VALUES (:date, :activity, :description, 0, :week, :nis)
            ";

            // Persiapan query
            $stmt = $pdo->prepare($query);

            // Binding parameter
            $stmt->bindValue(':date', $date, PDO::PARAM_STR);
            $stmt->bindValue(':activity', $activity, PDO::PARAM_STR);
            $stmt->bindValue(':description', $description, PDO::PARAM_STR);
            $stmt->bindValue(':week', $week, PDO::PARAM_INT);
            $stmt->bindValue(':nis', $nis, PDO::PARAM_INT);

            // Eksekusi query
            $stmt->execute();

            // Jika berhasil, kembalikan true
            $_SESSION['flash'] = [
                'type' => 'success',
                'message' => 'Data activity berhasil ditambahkan.',
            ];
            return true;
        } catch (PDOException $e) {
            // Menyimpan pesan error dalam session
            $_SESSION['flash'] = [
                'type' => 'error',
                'message' => 'Terjadi kesalahan saat menambahkan data activity: ' . $e->getMessage(),
            ];

            // Mengembalikan false jika terjadi error
            return false;
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
                idukas.id AS id,
                idukas.name AS nama,
                COALESCE(idukas.mentor, '') AS mentor_name,
                idukas.address AS alamat,
                users.username AS username,
                COALESCE(COUNT(students.id), 0) AS total_students
            FROM idukas
            LEFT JOIN users ON idukas.user_id = users.id
            LEFT JOIN groups ON idukas.id = groups.iduka_id
            LEFT JOIN students ON groups.id = students.group_id
            WHERE idukas.id = :id 
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

    public function resetAkses($id)
    {
        try {
            // Mengambil data iduka berdasarkan ID
            $dudi = self::getById($id);

            if (!$dudi) {
                $_SESSION['flash'] = [
                    'type' => 'error',
                    'message' => 'Data DUDI tidak ditemukan!',
                ];
            }
            $namaF = str_replace(' ', '_', $dudi['nama']);
            // Membuat password baru
            $password = 'password_' . $namaF;

            // Update akun pengguna
            $result = AkunModel::update($dudi['user_id'], $namaF, $password);

            if ($result) {
                $_SESSION['flash'] = [
                    'type' => 'success',
                    'message' => "Password untuk DUDI '{$dudi['nama']}' berhasil direset.",
                ];
            } else {
                throw new Exception("Gagal mereset password untuk DUDI '{$dudi['nama']}'.");
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

            $dudi = self::getById($id);


            $stmt = $pdo->prepare("DELETE FROM idukas WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            if (AkunModel::delete($dudi['user_id'])) {
                $_SESSION['flash'] = [
                    'type' => 'success',
                    'message' => 'Data DUDI ' . $dudi['nama'] . ' berhasil dihapus!',
                ];
            } else {
                $_SESSION['flash'] = [
                    'type' => 'error',
                    'message' => 'Data DUDI ' . $dudi['nama'] . ' gagal dihapus!',
                ];
            }


            return true;
        } catch (PDOException $e) {
            $_SESSION['flash'] = [
                'type' => 'error',
                'message' => 'Terjadi kesalahan saat menghapus siswa: ' . $e->getMessage(),
            ];
            return false;
        }
    }
}