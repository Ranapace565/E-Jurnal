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

                $_SESSION['flash'] = [
                    'type' => 'success',
                    'message' => 'Update akses sukses, Username ' . $newUsername . ', Password ' . $newPassword,
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
