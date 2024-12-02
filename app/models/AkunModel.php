<?php

require_once __DIR__ . '/../../config/database.php';

class AkunModel
{
    public function login($username, $password)
    {
        try {
            $pdo = Database::getConnection();
            $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
            $stmt->bindValue(':username', $username, PDO::PARAM_STR);
            $stmt->execute();

            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            // Verifikasi password
            if ($user && password_verify($password, $user['password'])) {
                return [
                    'id' => $user['id'],
                    'username' => $user['username'],
                    'role' => $user['role'],
                ];
            }

            return null; // Login gagal
        } catch (PDOException $e) {
            error_log("Kesalahan login: " . $e->getMessage());
            return null;
        }
    }

    public function logout()
    {
        // Menghapus semua data sesi
        session_start(); // Pastikan sesi dimulai
        session_unset(); // Menghapus semua variabel sesi
        session_destroy(); // Menghancurkan sesi

        // Redirect ke halaman login atau halaman utama
        header("Location: /login"); // Ganti dengan rute login Anda
        exit(); // Pastikan eksekusi berhenti setelah redirect
    }


    public function auth($id, $password)
    {
        try {
            $pdo = Database::getConnection();
            $stmt = $pdo->prepare("SELECT * FROM users WHERE id = :id");
            $stmt->bindValue(':id', $id, PDO::PARAM_STR);
            $stmt->execute();

            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            // Verifikasi password
            if ($user && password_verify($password, $user['password'])) {
                return true;
            }

            return false; // Login gagal
        } catch (PDOException $e) {
            error_log("Kesalahan auth: " . $e->getMessage());
            return null;
        }
    }

    public static function isUserExist($user)
    {
        try {
            $db = Database::getConnection();
            $query = $db->prepare("SELECT COUNT(*) FROM users WHERE username = ?");
            $query->execute([$user]);
            return $query->fetchColumn() > 0;
        } catch (PDOException $e) {
            $_SESSION['flash'] = [
                'type' => 'error',
                'message' => 'Terjadi kesalahan saat memeriksa NIS: ' . $e->getMessage(),
            ];
            return false; // Default jika error
        }
    }

    public static function createUser($username, $password, $role)
    {

        $pdo = Database::getConnection();
        $hash =  password_hash($password, PASSWORD_BCRYPT);

        try {
            $stmt = $pdo->prepare("INSERT INTO users ( username, password, role) VALUES ( :username, :password, :role)");
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':password', $hash);
            $stmt->bindParam(':role', $role);
            $stmt->execute();

            return $pdo->lastInsertId();
        } catch (Exception $e) {

            // Log atau tampilkan kesalahan jika diperlukan
            error_log($e->getMessage());
            return false;
        }
        // return $pdo->lastInsertId();
    }



    // public static function updateUsername($id, $newUsername)
    // {
    //     $password = $_POST['oldpassword'];
    //     $pdo = Database::getConnection();

    //     try {
    //         $akun = new AkunModel;
    //         if ($akun::isUserExist($newUsername)) {
    //             $_SESSION['flash'] = [
    //                 'type' => 'error',
    //                 'message' => 'Username ' . $newUsername . ' sudah terdaftar. Tidak dapat menggunakan username yang sama!',
    //             ];
    //             return false;
    //         }
    //         // Mempersiapkan query untuk update username dan password berdasarkan NIS
    //         $stmt = $pdo->prepare("UPDATE users SET username = :username WHERE id = :id");

    //         // Mengikat parameter dengan nilai baru
    //         $stmt->bindParam(':username', $newUsername);
    //         $stmt->bindParam(':id', $id);

    //         // Menjalankan query
    //         $stmt->execute();

    //         // Mengecek apakah ada baris yang terpengaruh (data berhasil diperbarui)
    //         if ($stmt->rowCount() > 0) {

    //             // $_SESSION['flash'] = [
    //             //     'type' => 'success',
    //             //     'message' => 'Update akses sukses, Username ' . $newUsername
    //             // ];

    //             $_SESSION['flash'] = [
    //                 'type' => 'success',
    //                 'message' => "Username berhasil diubah :",
    //                 'username' => $newUsername,
    //                 'password' => $password,
    //             ];

    //             return true; // Berhasil memperbarui
    //         }

    //         return false; // Jika tidak ada baris yang diperbarui
    //     } catch (Exception $e) {
    //         $_SESSION['flash'] = [
    //             'type' => 'error',
    //             'message' => 'Terjadi kesalahan update akses: ' . $e->getMessage(),
    //         ];
    //         return false;
    //     }
    // }

    public static function updateUsername($id, $newUsername)
    {
        $pdo = Database::getConnection();

        try {
            // Ambil username lama dari database
            $stmt = $pdo->prepare("SELECT username FROM users WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            $currentUsername = $stmt->fetchColumn();

            // Jalankan metode isUserExist jika username baru berbeda dengan username lama
            if ($newUsername !== $currentUsername) {
                if (self::isUserExist($newUsername)) {
                    $_SESSION['flash'] = [
                        'type' => 'error',
                        'message' => 'Username ' . $newUsername . ' sudah terdaftar. Tidak dapat menggunakan username yang sama!',
                    ];
                    return false;
                }
            }

            // Update username
            $stmt = $pdo->prepare("UPDATE users SET username = :username WHERE id = :id");
            $stmt->bindParam(':username', $newUsername);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            // Cek apakah ada baris yang diperbarui
            if ($stmt->rowCount() > 0) {
                $_SESSION['flash'] = [
                    'type' => 'success',
                    'message' => "Username berhasil diubah menjadi: $newUsername",
                ];
                return true;
            }

            $_SESSION['flash'] = [
                'type' => 'warning',
                'message' => 'Tidak ada perubahan yang dilakukan pada username.',
            ];
            return false;
        } catch (Exception $e) {
            $_SESSION['flash'] = [
                'type' => 'error',
                'message' => 'Terjadi kesalahan update akses: ' . $e->getMessage(),
            ];
            return false;
        }
    }


    public static function update($id, $newUsername, $newPassword)
    {
        $pdo = Database::getConnection();
        $hash =  password_hash($newPassword, PASSWORD_BCRYPT);

        try {
            // Mempersiapkan query untuk update username dan password berdasarkan NIS
            $stmt = $pdo->prepare("UPDATE users SET username = :username, password = :password WHERE id = :id");

            // Mengikat parameter dengan nilai baru
            $stmt->bindParam(':username', $newUsername);
            $stmt->bindParam(':password', $hash);
            $stmt->bindParam(':id', $id);

            // Menjalankan query
            $stmt->execute();

            // Mengecek apakah ada baris yang terpengaruh (data berhasil diperbarui)
            if ($stmt->rowCount() > 0) {

                // $_SESSION['flash'] = [
                //     'type' => 'success',
                //     'message' => 'Update akses sukses, Username ' . $newUsername . ', Password ' . $newPassword,
                // ];
                $_SESSION['flash'] = [
                    'type' => 'success',
                    'message' => "Username dan password berhasil diubah :",
                    'username' => $newUsername,
                    'password' => $newPassword,
                ];

                return true; // Berhasil memperbarui
            }

            return false; // Jika tidak ada baris yang diperbarui
        } catch (Exception $e) {
            $_SESSION['flash'] = [
                'type' => 'error',
                'message' => 'Terjadi kesalahan update akses: ' . $e->getMessage(),
            ];
            return false;
        }
    }

    public static function delete($id)
    {
        $pdo = Database::getConnection();

        try {
            $stmt = $pdo->prepare("DELETE FROM users WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            return true;
        } catch (Exception $e) {
            // Rollback transaksi jika ada kesalahan
            // $pdo->rollBack();

            // Log atau tampilkan kesalahan jika diperlukan
            error_log($e->getMessage());
            return false;
        }
    }

    private function generatePassword($password)
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }
}
