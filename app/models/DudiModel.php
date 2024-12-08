<?php

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/ObservationModel.php';
require_once __DIR__ . '/AkunModel.php';

class DudiModel
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
                idukas.id AS id,
                users.id AS iduser,
                idukas.name AS nama,
                COALESCE(idukas.mentor, '') AS mentor_name,
                idukas.address AS alamat,
                users.username AS username,
                COALESCE(COUNT(students.id), 0) AS total_students
            FROM idukas
            LEFT JOIN users ON idukas.user_id = users.id
            LEFT JOIN groups ON idukas.id = groups.iduka_id
            LEFT JOIN students ON groups.id = students.group_id
        ";

            // Filter pencarian
            if (!empty($search)) {
                $query .= "
                WHERE idukas.name LIKE :search
                OR idukas.mentor LIKE :search
                OR users.username LIKE :search
                OR idukas.address LIKE :search
            ";
            }

            // Grouping dan pengurutan
            $query .= "
            GROUP BY idukas.id
            ORDER BY idukas.name ASC
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

            // $dudiList = $stmt->fetchAll(PDO::FETCH_ASSOC);

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

    public function show($id)
    {
        try {
            // Persiapan query menggunakan prepared statement
            $stmt = $this->pdo->prepare("
            SELECT  
                idukas.id,
                COALESCE(idukas.name, '') AS nama,
                COALESCE(idukas.address, '') AS alamat, 
                COALESCE(idukas.mentor, '') AS mentor,
                COALESCE(users.username, '') AS username,
                COALESCE(users.id, '') AS user_id,
                COALESCE(users.password, '') AS password
            FROM idukas
            LEFT JOIN users ON idukas.user_id = users.id
            WHERE users.id = :id
        ");

            // Bind parameter
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            // Eksekusi query
            $stmt->execute();

            // Mengembalikan hasil sebagai array asosiatif
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $_SESSION['flash'] = [
                'type' => 'error',
                'message' => 'Data siswa dengan id ' . $id . ' tidak ditemukan : ' . $e->getMessage(),
            ];
            return null;
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

    public static function countAll($search = '')
    {
        try {
            $pdo = Database::getConnection();
            $query = "
        SELECT COUNT(*) AS total
        FROM idukas
            LEFT JOIN users ON idukas.user_id = users.id
            LEFT JOIN groups ON idukas.id = groups.iduka_id
            LEFT JOIN students ON groups.id = students.group_id
        ";

            if (!empty($search)) {
                $query .= " 
            WHERE idukas.name LIKE :search
                OR idukas.mentor LIKE :search
                OR users.username LIKE :search
                OR idukas.address LIKE :search
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
    public function createDudi($nama, $user, $pass, $alamat)
    {
        if ($this->isDudiExist($nama)) {
            $_SESSION['flash'] = [
                'type' => 'warning',
                'message' => 'Nama Dudi "' . $nama . '" sudah terdaftar. Proses pembuatan akses dudi dibatalkan',
            ];
            return false; // Kembalikan false karena proses tidak dilanjutkan
        }
        // $this->pdo->beginTransaction();
        try {
            $akun = new AkunModel;
            if ($akun::isUserExist($user)) {
                $_SESSION['flash'] = [
                    'type' => 'error',
                    'message' => 'Username ' . $user . ' sudah terdaftar. Tidak dapat menggunakan username yang sama!',
                ];
                return false;
            }
            $role = 'dudi';
            $user_id = AkunModel::createUser($user, $pass, $role);
            if (!$user_id) {
                $_SESSION['flash'] = [
                    'type' => 'error',
                    'message' => 'Gagal membuat akun Dudi'
                ];
            }

            $dudi_id = $this->create($nama, $alamat, $user_id);
            if (!$dudi_id) {
                // $this->pdo->rollBack();
                $_SESSION['flash'] = [
                    'type' => 'error',
                    'message' => 'Gagal membuat data Dudi'
                ];
            }

            // $this->pdo->commit();
            $_SESSION['flash'] = [
                'type' => 'success',
                'message' => 'Akses Dudi ' . $nama . ' berhasil ditambahkan!',
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

    private function create($name, $alamat, $user)
    {
        $mentor = '';
        try {
            $stmt = $this->pdo->prepare("INSERT INTO idukas ( name, address, mentor, user_id) VALUES (:name, :alamat, :mentor, :user)");
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':alamat', $alamat);
            $stmt->bindParam(':mentor', $mentor);
            $stmt->bindParam(':user', $user);
            $stmt->execute();

            $dudi_id = $this->pdo->lastInsertId();


            return $dudi_id;
        } catch (PDOException $e) {
            $_SESSION['flash'] = [
                'type' => 'error',
                'message' => 'Terjadi kesalahan saat membuat data siswa: ' . $e->getMessage(),
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

    public static function update($id, $nama, $alamat, $mentor)
    {
        try {
            $pdo = Database::getConnection();
            $stmt = $pdo->prepare("UPDATE idukas SET name = :nama, address = :alamat, mentor = :mentor WHERE id = :id");
            $stmt->bindParam(':nama', $nama);
            $stmt->bindParam(':alamat', $alamat);
            $stmt->bindParam(':mentor', $mentor);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $_SESSION['flash'] = [
                'type' => 'success',
                'message' => "Update data berhasil"
            ];
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            $_SESSION['flash'] = [
                'type' => 'error',
                'message' => "Terjadi kesalahan update Data: " . $e->getMessage(),
            ];
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
