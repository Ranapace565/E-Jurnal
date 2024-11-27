<?php

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/ObservationModel.php';
require_once __DIR__ . '/AkunModel.php';
require_once __DIR__ . '/MentorModel.php';

class GroupModel
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
                groups.id AS id,
                groups.date_start AS start,
                groups.date_finish AS finish,
                COALESCE(idukas.name, 'Kosong') AS Inama,
                COALESCE(idukas.address, '') AS alamat,
                COALESCE(mentors.name, 'kosong') AS Mnama,
                COALESCE(idukas.mentor, 'kosong') AS MInama,
                COALESCE(students.expertise, '') AS prodi,
                COALESCE(students.name, '') AS Sname,
                COALESCE(COUNT(students.id), 0) AS total_students
            FROM groups
            LEFT JOIN idukas ON groups.iduka_id = idukas.id
            LEFT JOIN mentors ON groups.nip = mentors.id
            LEFT JOIN students ON groups.id = students.group_id
        ";

            // Filter pencarian
            if (!empty($search)) {
                $query .= "
                WHERE idukas.name LIKE :search 
                OR mentors.name LIKE :search
                OR students.name LIKE :search
            ";
            }

            // Grouping dan pengurutan
            $query .= "
            GROUP BY groups.id
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


    public function isGroupExist($id)
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
        FROM groups
        ";

            if (!empty($search)) {
                $query .= " 
            WHERE mentors.name LIKE :search
                OR idukas.name LIKE :search
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
    public function createGroup($mentor, $dudi, $mulai, $finish)
    {
        try {

            // $mentor_id = MentorModel::getById($mentor);
            // $dudi_id = DudiModel::getById($dudi);
            // echo $mentor;
            // echo $dudi;

            // if (!$mentor_id) {
            //     error_log("Mentor tidak ditemukan untuk ID/Nama: $mentor");
            // }
            // if (!$dudi_id) {
            //     error_log(message: "Mentor tidak ditemukan untuk ID/Nama: $mentor");
            // }

            if (!strtotime($mulai) || !strtotime($finish)) {
                $_SESSION['flash'] = [
                    'type' => 'error',
                    'message' => 'Format tanggal tidak valid.',
                ];
                return false;
            }


            $group_id = $this->create($mentor, $dudi, $mulai, $finish);

            if (!$group_id) {
                $_SESSION['flash'] = [
                    'type' => 'error',
                    'message' => 'Gagal membuat akun Kelompok'
                ];
                exit;
            }
            // $this->pdo->commit();
            $_SESSION['flash'] = [
                'type' => 'success',
                'message' => 'Kelompok berhasil ditambahkan!',
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


    private function create($mentor, $dudi, $mulai, $finish)
    {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO groups ( date_start, date_finish , nip, iduka_id) VALUES (:start, :end, :nip, :iduka)");
            $stmt->bindParam(':start', $mulai);
            $stmt->bindParam(':end', $finish);
            $stmt->bindParam(':nip', $mentor);
            $stmt->bindParam(':iduka', $dudi);
            $stmt->execute();

            $group_id = $this->pdo->lastInsertId();

            return $group_id;
        } catch (PDOException $e) {
            $_SESSION['flash'] = [
                'type' => 'error',
                'message' => 'Terjadi kesalahan saat membuat data kelompok: ' . $e->getMessage(),
            ];
            return null; // Default jika error
        }
    }

    public function update($id, $mentor, $dudi, $mulai, $finish)
    {
        try {
            $pdo = Database::getConnection();
            $stmt = $this->pdo->prepare("UPDATE groups SET date_start = :start, date_finish = :finish, nip = :nip, iduka_id = :iduka WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':start', $mulai);
            $stmt->bindParam(':finish', $finish);
            $stmt->bindParam(':nip', $mentor);
            $stmt->bindParam(':iduka', $dudi);
            return $stmt->execute();
        } catch (PDOException $e) {
            $_SESSION['flash'] = [
                'type' => 'error',
                'message' => 'Terjadi kesalahan saat input siswa kelompok: ' . $e->getMessage(),
            ];
            return null; // Default jika error
        }
    }

    public static function getGroup($id)
    {
        try {
            $pdo = Database::getConnection();

            // Query dasar
            $query = "
            SELECT 
                groups.id AS id,
                groups.date_start AS start,
                groups.date_finish AS finish,
                COALESCE(idukas.id, 'kosong') AS Iid,
                COALESCE(idukas.name, 'kosong') AS Inama,
                COALESCE(idukas.address, 'kosong') AS alamat,
                COALESCE(mentors.id, 'kosong') AS Mid,
                COALESCE(mentors.name, 'kosong') AS Mnama,
                COALESCE(idukas.mentor, 'kosong') AS MInama,
                COALESCE(students.expertise, '') AS prodi,
                COALESCE(students.name, '') AS Sname,
                COALESCE(COUNT(students.id), 0) AS total_students
            FROM groups
            LEFT JOIN idukas ON groups.iduka_id = idukas.id
            LEFT JOIN mentors ON groups.nip = mentors.id
            LEFT JOIN students ON groups.id = students.group_id
            WHERE groups.id = :id
        ";
            $stmt = $pdo->prepare($query);

            // Parameter untuk paginasi
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);

            // Eksekusi query
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
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

    public function delete($id)
    {
        try {
            $pdo = Database::getConnection();

            // Query dasar
            $query = " 
            DELETE FROM groups WHERE id = :id 
            ";
            $stmt = $pdo->prepare($query);

            // Parameter untuk paginasi
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);

            // Eksekusi query
            $stmt->execute();

            $_SESSION['flash'] = [
                'type' => 'success',
                'message' => 'Kelompok berhasil dihapus!',
            ];

            return true;
        } catch (PDOException $e) {
            // Menyimpan pesan error dalam session
            $_SESSION['flash'] = [
                'type' => 'error',
                'message' => 'Terjadi kesalahan saat menghapus data: ' . $e->getMessage(),
            ];
            // Mengembalikan array kosong jika terjadi error
            return [];
        }
    }
    // public static function getById($id)
    // {
    //     try {
    //         $pdo = Database::getConnection();

    //         // Query untuk mengambil data berdasarkan id
    //         $query = "
    //         SELECT 
    //             users.id AS user_id,
    //             mentors.id AS id,
    //             mentors.name AS nama,
    //             users.username AS username,
    //             COALESCE(COUNT(students.id), 0) AS total_students,
    //             COALESCE(COUNT(groups.id), 0) AS total_groups
    //         FROM mentors
    //         LEFT JOIN users ON mentors.user_id = users.id
    //         LEFT JOIN groups ON mentors.id = groups.nip
    //         LEFT JOIN students ON groups.id = students.group_id
    //         WHERE mentors.id = :id
    //     ";

    //         // Persiapan query
    //         $stmt = $pdo->prepare($query);

    //         // Bind parameter id
    //         $stmt->bindValue(':id', $id);

    //         // Eksekusi query
    //         $stmt->execute();

    //         // echo $stmt->fetch(PDO::FETCH_ASSOC);
    //         // Mengembalikan data dalam bentuk array
    //         return $stmt->fetch(PDO::FETCH_ASSOC);
    //     } catch (PDOException $e) {
    //         error_log('SQL Error: ' . $e->getMessage());
    //         // Menyimpan pesan error dalam session
    //         $_SESSION['flash'] = [
    //             'type' => 'error',
    //             'message' => 'Terjadi kesalahan saat mengambil data: ' . $e->getMessage(),
    //         ];

    //         // Mengembalikan null jika terjadi error
    //         return null;
    //     }
    // }



    // public function resetAkses($id)
    // {
    //     try {
    //         // Mengambil data iduka berdasarkan ID
    //         $mentor = self::getById($id);

    //         if (!$mentor) {
    //             $_SESSION['flash'] = [
    //                 'type' => 'error',
    //                 'message' => 'Data Mentor tidak ditemukan!',
    //             ];
    //         }
    //         $namaF = str_replace(' ', '_', $mentor['nama']);
    //         // Membuat password baru
    //         $password = 'password_' . $namaF;



    //         // Update akun pengguna
    //         $result = AkunModel::update($mentor['user_id'], $namaF, $password);

    //         if ($result) {
    //             $_SESSION['flash'] = [
    //                 'type' => 'success',
    //                 'message' => "Password untuk DUDI '{$mentor['nama']}' berhasil direset.",
    //             ];
    //         } else {
    //             throw new Exception("Gagal mereset password untuk DUDI '{$mentor['nama']}'.");
    //         }
    //     } catch (Exception $e) {
    //         $_SESSION['flash'] = [
    //             'type' => 'error',
    //             'message' => "Terjadi kesalahan reset akses DUDI: " . $e->getMessage(),
    //         ];
    //     }
    // }

    // public static function delete($id)
    // {
    //     try {
    //         $pdo = Database::getConnection();


    //         require_once __DIR__ . '/AkunModel.php';

    //         $Mentor = self::getById($id);


    //         $stmt = $pdo->prepare("DELETE FROM mentors WHERE id = :id");
    //         $stmt->bindParam(':id', $id);
    //         $stmt->execute();

    //         if (AkunModel::delete($Mentor['user_id'])) {
    //             $_SESSION['flash'] = [
    //                 'type' => 'success',
    //                 'message' => 'Data Mentor ' . $Mentor['nama'] . ' berhasil dihapus!',
    //             ];
    //         } else {
    //             $_SESSION['flash'] = [
    //                 'type' => 'error',
    //                 'message' => 'Data Mentor ' . $Mentor['nama'] . ' gagal dihapus!',
    //             ];
    //         }

    //         return true;
    //     } catch (PDOException $e) {
    //         $_SESSION['flash'] = [
    //             'type' => 'error',
    //             'message' => 'Terjadi kesalahan saat menghapus Mentor: ' . $e->getMessage(),
    //         ];
    //         return false;
    //     }
    // }
}
