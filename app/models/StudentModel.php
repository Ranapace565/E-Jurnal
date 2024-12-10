<?php

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/ObservationModel.php';
require_once __DIR__ . '/AkunModel.php';

class StudentModel
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

    public static function getPerMentor($id, $search = '', $limit = 10, $offset = 0)
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
            WHERE mentors.user_id = :id
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


    public static function getProdi()
    {
        try {
            $pdo = Database::getConnection();
            $stmt = $pdo->prepare("SELECT DISTINCT expertise as prodi FROM students");
            $stmt->execute();
            $prodiList = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return array_column($prodiList, 'prodi');
        } catch (PDOException $e) {
            $_SESSION['flash'] = [
                'type' => 'error',
                'message' => 'Terjadi kesalahan saat mengambil data prodi: ' . $e->getMessage(),
            ];
            return [];
        }
    }

    public function show($id)
    {
        try {
            // Persiapan query menggunakan prepared statement
            $stmt = $this->pdo->prepare("
            SELECT 
                COALESCE(students.name, 'kosong') AS nama, 
                COALESCE(students.id, 'kosong') AS id, 
                COALESCE(students.nisn, 'kosong') AS nisn,
                COALESCE(students.born_place, 'kosong') AS tempat, 
                COALESCE(students.born_date, 'kosong') AS tanggal, 
                COALESCE(students.sex, 'kosong') AS kelamin, 
                COALESCE(students.blood_type, 'kosong') AS darah, 
                COALESCE(students.address, 'kosong') AS alamat, 
                COALESCE(students.telp, 'kosong') AS telp,
                COALESCE(students.health_note, 'kosong') AS catatan, 
                COALESCE(students.parent_name, 'kosong') AS ortu,
                COALESCE(students.parent_telp, 'kosong') AS telportu,
                COALESCE(students.parent_address, 'kosong') AS alamatortu,
                COALESCE(students.expertise, 'kosong') AS prodi, 
                COALESCE(students.competence, 'kosong') AS kompetensi,  
                COALESCE(groups.id, 'kosong') AS group_id,    
                COALESCE(idukas.name, '') AS dudi, 
                COALESCE(mentors.name, '') AS pembimbing, 
                COALESCE(users.username, '') AS username,
                COALESCE(users.id, '') AS user_id,
                COALESCE(users.password, '') AS password
            FROM students
            LEFT JOIN groups ON students.group_id = groups.id
            LEFT JOIN idukas ON groups.iduka_id = idukas.id
            LEFT JOIN mentors ON groups.nip = mentors.id
            LEFT JOIN users ON students.user_id = users.id
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

    public static function StudentGroup($id)
    {
        try {
            $pdo = Database::getConnection();

            $stmt = $pdo->prepare("SELECT * FROM students WHERE group_id = :id");

            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $_SESSION['flash'] = [
                'type' => 'error',
                'message' => 'Data siswa dengan id ' . $id . ' tidak ditemukan : ' . $e->getMessage(),
            ];
            return null;
        }
    }
    public static function countAll($search = '')
    {
        try {
            $pdo = Database::getConnection();
            $query = "
        SELECT COUNT(*) AS total
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
                users.username LIKE :search OR
                mentors.name LIKE :search
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

    public static function countPerDudi($id, $search = '')
    {
        try {
            $pdo = Database::getConnection();
            $query = "
        SELECT COUNT(*) AS total
        FROM students
        LEFT JOIN groups ON students.group_id = groups.id
        LEFT JOIN idukas ON groups.iduka_id = idukas.id
        LEFT JOIN mentors ON groups.nip = mentors.id
        LEFT JOIN users ON idukas.user_id = users.id
        WHERE users.id LIKE :id
        ";

            if (!empty($search)) {
                $query .= " 
                AND (
                students.id LIKE :search OR
                students.name LIKE :search OR
                students.expertise LIKE :search OR
                idukas.name LIKE :search OR
                users.username LIKE :search OR
                mentors.name LIKE :search
            )
            ";
            }

            $stmt = $pdo->prepare($query);

            $stmt->bindValue(':id', $id, PDO::PARAM_INT);

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

    public function createSiswa($nis, $nama, $user, $pass, $prodi)
    {
        try {
            $akun = new AkunModel;
            if ($akun::isUserExist($user)) {
                $_SESSION['flash'] = [
                    'type' => 'error',
                    'message' => 'Username ' . $user . ' sudah terdaftar. Tidak dapat menggunakan username yang sama!',
                ];
                return false;
            }

            if ($this->isNisExist($nis)) {
                $_SESSION['flash'] = [
                    'type' => 'error',
                    'message' => 'NIS ' . $nis . ' sudah terdaftar. Tidak dapat menambahkan siswa dengan NIS yang sama!',
                ];
                return false;
            }

            $username = $user;
            $password =  $pass;
            // $password = $this->generatePassword($pass);
            $role = 'siswa';

            $user_id = AkunModel::createUser($username, $password, $role);
            $this->createStudent($nis, $nama, $prodi, $user_id);

            $_SESSION['flash'] = [
                'type' => 'success',
                'message' => 'Siswa dengan NIS ' . $nis . ' berhasil ditambahkan!',
            ];
            return true;
        } catch (PDOException $e) {
            $_SESSION['flash'] = [
                'type' => 'error',
                'message' => 'Terjadi kesalahan saat menambahkan siswa: ' . $e->getMessage(),
            ];
            return false;
        }
    }

    public function generateSiswa($nis1, $nis2, $prodi)
    {
        try {
            if ($nis2 < $nis1) {
                $_SESSION['flash'] = [
                    'type' => 'error',
                    'message' => 'Nilai NIS pertama harus lebih kecil dari NIS terakhir!',
                ];
                return;
            }

            $usernames = $this->generateUsername($nis1, $nis2);
            $duplicateNis = [];
            $nice = [];

            for ($i = 0; $i <= ($nis2 - $nis1); $i++) {
                $nis = $nis1 + $i;

                if ($this->isNisExist($nis)) {
                    $duplicateNis[] = $nis;
                    continue;
                }

                $username = $usernames[$i];
                $password = 'password' . $nis;
                ($username);
                $role = 'siswa';

                $user_id = AkunModel::createUser($username, $password, $role);
                $this->createStudent($nis, "", $prodi, $user_id);
                $nice[] = $nis;
            }

            if (!empty($nice)) {
                $_SESSION['flash'] = [
                    'type' => 'success',
                    'message' => 'Siswa dengan NIS ' . implode(', ', $nice) . ' berhasil ditambahkan!',
                ];
            }

            if (!empty($duplicateNis)) {
                $_SESSION['flash'] = [
                    'type' => 'error',
                    'message' => 'NIS ' . implode(', ', $duplicateNis) . ' sudah terdaftar. Tidak dapat menambahkan siswa dengan NIS yang sama!',
                ];
            }
        } catch (PDOException $e) {
            $_SESSION['flash'] = [
                'type' => 'error',
                'message' => 'Terjadi kesalahan saat menambahkan siswa massal: ' . $e->getMessage(),
            ];
        }
    }

    private function createStudent($id, $name, $prodi, $user_id)
    {
        try {


            $stmt = $this->pdo->prepare("INSERT INTO students (id, name, expertise, user_id) VALUES (:id, :name, :expertise, :userid)");
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':expertise', $prodi);
            $stmt->bindParam(':userid', $user_id);
            $stmt->execute();

            $student_id = $this->pdo->lastInsertId();

            require_once __DIR__ . '/ObservationModel.php';
            $observation = new ObservationModel();
            $observation->createObservation($this->pdo, $student_id);
            $practice = new EvaluationModel();
            $practice->createPractice($student_id);

            return $student_id;
        } catch (PDOException $e) {
            $_SESSION['flash'] = [
                'type' => 'error',
                'message' => 'Terjadi kesalahan saat membuat data siswa: ' . $e->getMessage(),
            ];
            return null; // Default jika error
        }
    }

    private function generateUsername($first, $last)
    {
        $usernames = [];
        for ($i = 0; $i <= ($last - $first); $i++) {
            $usernames[$i] = $first + $i;
        }
        return $usernames;
    }

    public static function update($id, $nama, $tempat, $tanggal, $sex, $darah, $alamat, $telp, $catatan, $ortu, $ortutelp, $prodi, $kompetensi, $nisn, $group, $alamatortu)
    {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare("UPDATE students SET name = :nama, born_place = :tempat, born_date = :tanggal, sex = :kelamin, blood_type = :darah, address = :alamat, telp = :telp, health_note = :catatan, parent_name = :ortu, parent_telp = :ortutelp, expertise = :prodi, competence = :kompetensi, nisn = :nisn, group_id = :group, parent_address = :paradd WHERE id = :id");
        $stmt->bindParam(':nama', $nama);
        $stmt->bindParam(':tempat', $tempat);
        $stmt->bindParam(':tanggal', $tanggal);
        $stmt->bindParam(':kelamin', $sex);
        $stmt->bindParam(':darah', $darah);
        $stmt->bindParam(':alamat', $alamat);
        $stmt->bindParam(':telp', $telp);
        $stmt->bindParam(':catatan', $catatan);
        $stmt->bindParam(':ortu', $ortu);
        $stmt->bindParam(':ortutelp', $ortutelp);
        $stmt->bindParam(':prodi', $prodi);
        $stmt->bindParam(':kompetensi', $kompetensi);
        $stmt->bindParam(':nisn', $nisn);
        $stmt->bindParam(':group', $group);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':paradd', $alamatortu);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function updateGroup($id, $group)
    {
        try {
            $pdo = Database::getConnection();
            $stmt = $pdo->prepare("UPDATE students SET group_id = :group WHERE id = :id");
            $stmt->bindParam(':group', $group);
            $stmt->bindParam(':id', $id);

            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Menyimpan pesan error dalam session
            $_SESSION['flash'] = [
                'type' => 'error',
                'message' => 'Terjadi kesalahan saat mengupdate group siswa: ' . $e->getMessage(),
            ];
            return null;
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
                COALESCE(idukas.mentor, '') AS instruktur, 
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

    public function resetAkses($id)
    {
        try {
            $nama = self::getById($id);
            $password = 'password_' . $id;

            $result = AkunModel::update($nama['user_id'], $id, $password);
            if ($result) {
                $_SESSION['flash'] = [
                    'type' => 'success',
                    'message' => "Password untuk Siswa '{$nama['nama']}' berhasil direset.",
                    'username' => $id,
                    'password' => $password,
                ];
            } else {
                $_SESSION['flash'] = [
                    'type' => 'error',
                    'message' => "Gagal melakukan reset akses siswa '{$nama['nama']}'",
                ];
            }
        } catch (PDOException $e) {
            $_SESSION['flash'] = [
                'type' => 'error',
                'message' => 'Terjadi kesalahan saat menghapus siswa: ' . $e->getMessage(),
            ];
            return false;
        }
    }

    public static function delete($id)
    {
        try {
            $pdo = Database::getConnection();

            require_once __DIR__ . '/ObservationModel.php';
            ObservationModel::delete($id);

            require_once __DIR__ . '/AkunModel.php';

            $user_id = StudentModel::getById($id);

            if (!$user_id || !isset($user_id['user_id'])) {
                // Jika siswa tidak ditemukan, tampilkan pesan error
                $_SESSION['flash'] = [
                    'type' => 'error',
                    'message' => 'Data siswa dengan NIS ' . htmlspecialchars($id) . ' tidak ditemukan atau sudah dihapus!',
                ];
                return false;
            }
            $user_id = $user_id['user_id'];
            AkunModel::delete($user_id);

            $stmt = $pdo->prepare("DELETE FROM students WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            $_SESSION['flash'] = [
                'type' => 'success',
                'message' => 'Data siswa dengan NIS ' . $id . ' berhasil dihapus!',
            ];
            return true;
        } catch (PDOException $e) {
            $_SESSION['flash'] = [
                'type' => 'error',
                'message' => 'Terjadi kesalahan saat menghapus siswa: ' . $e->getMessage(),
            ];
            return false;
        }
    }
    public static function deleteAll()
    {
        $pdo = Database::getConnection();

        try {
            // Dapatkan semua ID siswa
            $stmt = $pdo->query("SELECT id FROM students");
            $studentIds = $stmt->fetchAll(PDO::FETCH_COLUMN);

            // Iterasi setiap ID siswa dan hapus data terkait
            foreach ($studentIds as $id) {
                self::delete($id);
            }

            $_SESSION['flash'] = [
                'type' => 'success',
                'message' => 'Semua data siswa berhasil dihapus!',
            ];

            return true;
        } catch (Exception $e) {
            error_log($e->getMessage());
            $_SESSION['flash'] = [
                'type' => 'error',
                'message' => 'Terjadi kesalahan saat menghapus data siswa: ' . $e->getMessage(),
            ];

            return false;
        }
    }
}
