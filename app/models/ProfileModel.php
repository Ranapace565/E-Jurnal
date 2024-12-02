
<?php

require_once __DIR__ . '/../../config/database.php';

class ProfileModel
{
    public function findFoto($userId)
    {
        $pdo = Database::getConnection();

        try {
            // Cari file berdasarkan user_id
            $stmt = $pdo->prepare('SELECT * FROM profiles WHERE user_id = ?');
            $stmt->execute([$userId]);
            $file = $stmt->fetch();

            if ($file) {
                return $file;
            }

            return false; // Kembalikan null jika tidak ada data
        } catch (Exception $e) {
            $_SESSION['flash'] = [
                'type' => 'error',
                'message' => 'Terjadi kesalahan saat mencari data foto: ' . $e->getMessage(),
            ];
            return null;
        }
    }
    public function upload($userId, $file)
    {
        $pdo = Database::getConnection();

        try {
            $fileName = uniqid() . '_' . $file['name'];
            $filePath = '/public/img/profile/' . $fileName;

            // Pindahkan file ke direktori tujuan
            if (move_uploaded_file($file['tmp_name'], __DIR__ . '/../../' . $filePath)) {
                // Periksa apakah data sudah ada

                $existingProfile = $this->findFoto($userId);
                if ($this->findFoto($userId)) {
                    // Jika data ada, lakukan update
                    $oldFilePath = __DIR__ . '/../../' . $existingProfile['file_path'];
                    if (file_exists($oldFilePath)) {
                        unlink($oldFilePath);
                    }

                    $stmt = $pdo->prepare("UPDATE profiles SET file_name = :name, file_path = :path WHERE user_id = :user_id");
                    $actionMessage = 'File berhasil diperbarui!';
                } else {
                    // Jika data tidak ada, lakukan insert
                    $stmt = $pdo->prepare("INSERT INTO profiles (file_name, file_path, user_id) VALUES (:name, :path, :user_id)");
                    $actionMessage = 'File berhasil diunggah!';
                }

                // Bind parameter
                $stmt->bindParam(':name', $fileName);
                $stmt->bindParam(':path', $filePath);
                $stmt->bindParam(':user_id', $userId);

                // Eksekusi query
                $stmt->execute();

                $_SESSION['flash'] = [
                    'type' => 'success',
                    'message' => $actionMessage,
                ];

                return true;
            } else {
                $_SESSION['flash'] = [
                    'type' => 'error',
                    'message' => 'Gagal memindahkan file ke direktori tujuan!',
                ];
                return false;
            }
        } catch (Exception $e) {
            $_SESSION['flash'] = [
                'type' => 'error',
                'message' => 'Terjadi kesalahan saat menyimpan file: ' . $e->getMessage(),
            ];
            return false;
        }
    }

    public function update($userId, $file)
    {
        try {
            // Hapus file lama
            $this->delete($userId);

            // Upload file baru
            if ($this->upload($userId, $file)) {
                $_SESSION['flash'] = [
                    'type' => 'success',
                    'message' => 'File berhasil diperbarui!',
                ];

                return true;
            } else {
                $_SESSION['flash'] = [
                    'type' => 'error',
                    'message' => 'Gagal memperbarui file!',
                ];

                return false;
            }
        } catch (Exception $e) {
            $_SESSION['flash'] = [
                'type' => 'error',
                'message' => 'Terjadi kesalahan saat memperbarui file: ' . $e->getMessage(),
            ];

            return false;
        }
    }

    public function delete($userId)
    {
        $pdo = Database::getConnection();

        try {
            // Ambil path file berdasarkan user_id
            $stmt = $pdo->prepare('SELECT file_path FROM profiles WHERE user_id = ?');
            $stmt->execute([$userId]);
            $file = $stmt->fetch();

            if ($file && file_exists(__DIR__ . '/../../' . $file['file_path'])) {
                unlink(__DIR__ . '/../../' . $file['file_path']); // Hapus file
            }

            // Hapus data dari database
            $stmt = $pdo->prepare('DELETE FROM profiles WHERE user_id = ?');
            $stmt->execute([$userId]);

            $_SESSION['flash'] = [
                'type' => 'success',
                'message' => 'File berhasil dihapus!',
            ];

            return true;
        } catch (Exception $e) {
            $_SESSION['flash'] = [
                'type' => 'error',
                'message' => 'Terjadi kesalahan saat menghapus file: ' . $e->getMessage(),
            ];

            return false;
        }
    }
}
