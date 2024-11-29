<?php

require_once __DIR__ . '/../../config/database.php';

class ObservationModel
{
    public static function getAll($search = '')
    {
        $pdo = Database::getConnection();
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
            COALESCE(students.address, '') AS alamat
        FROM students
        LEFT JOIN groups ON students.group_id = groups.id
        LEFT JOIN idukas ON groups.iduka_id = idukas.id
        LEFT JOIN mentors ON groups.nip = mentors.id
        LEFT JOIN users ON students.user_id = users.id
    ";

        // Urutan relevansi tanpa memfilter
        if (!empty($search)) {

            $query .= " ORDER BY 
                    CASE 
                        WHEN students.id LIKE :search THEN 1
                        WHEN students.name LIKE :search THEN 1
                        WHEN students.expertise LIKE :search THEN 1
                        WHEN idukas.name LIKE :search THEN 1
                        WHEN users.username LIKE :search THEN 1
                        WHEN mentors.name LIKE :search THEN 1
                        ELSE 2
                    END, 
                    students.id ASC";
        } else {
            $query .= " ORDER BY students.id ASC";  // Default sorting jika tidak ada pencarian
        }

        $stmt = $pdo->prepare($query);

        if (!empty($search)) {
            $stmt->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
        }

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // koreksi
    public function createObservation($pdo, $student_id)
    {
        $stmt = $pdo->prepare("INSERT INTO observations (id, nis) VALUES (:id, :nis)");
        $stmt->bindParam(':id', $student_id);
        $stmt->bindParam(':nis', $student_id);
        $stmt->execute();

        $observation_id = $pdo->lastInsertId();

        // Buat indikator untuk observasi ini
        $this->createIndicators($pdo, $observation_id);

        return $observation_id;
    }

    private function createIndicators($pdo, $observation_id)
    {
        // Contoh data indicators
        $indicatorsData = [
            ["description" => "Penerapan Soft skills yang dibutuhkan dalam dunia kerja (tempat PKL) ", "indicatories" => [
                ["objective" => "Melaksanakan Komunikasi telepon sesuai kaidah", "achievement" => '0'],
                ["objective" => "Menunjukan integritas (antara lain jujur, disiplin komitmen, dan tanggung jawab)", "achievement" => '0'],
                ["objective" => "Memiliki Etos kerja", "achievement" => '0'],
                ["objective" => "Menunjukan kemandirian", "achievement" => '0'],
                ["objective" => "Menunjukan kerjasama", "achievement" => '0'],
                ["objective" => "Menunjukan kepedulian sosial dan lingkungan", "achievement" => '0'],
            ]],
            ["description" => "Menerapkan Norma, POS dan K3LH yang ada di Dunia Kerja (Tempat PKL)", "indicatories" => [
                ["objective" => "Menggunakan APD dengan tertib dan benar", "achievement" => '0'],
                ["objective" => "Melaksanakan pekerjaan dengan POS", "achievement" => '0'],
            ]],
            ["description" => "Menerapkan kompetensi teknis yang sudah dipelajari di sekolah dan/atau baru", "indicatories" => [
                ["objective" => "", "achievement" => '0'],
            ]],
            ["description" => "Dipelajari pada dunia kerja (tempat PKL) Memahami alur bisnis dunia kerja tempat PKL dan wawasan wirausaha", "indicatories" => [
                ["objective" => "Mengidentifikasi kegiatan usaha ditempat kerja", "achievement" => '0'],
                ["objective" => "Menjelaskan rencana usaha yang akan dilaksanakan", "achievement" => '0'],
            ]],

        ];
        $notes = [
            ["note" => "Catatan Guru Pembimbing"],
            ["note" => "Catatan instruktur Industri"],
        ];

        foreach ($indicatorsData as $indicator) {
            $stmt = $pdo->prepare("INSERT INTO indicators (observation_id, description) VALUES (:observation_id, :description)");
            $stmt->bindParam(':observation_id', $observation_id);
            $stmt->bindParam(':description', $indicator['description']);
            $stmt->execute();

            $indicator_id = $pdo->lastInsertId();

            // Buat indicatories untuk setiap indikator
            foreach ($indicator['indicatories'] as $indicatory) {
                $stmtIndicatory = $pdo->prepare("INSERT INTO indicatories (indicators_id, objective, achievement) VALUES (:indicator_id, :objective, :achievement)");
                $stmtIndicatory->bindParam(':indicator_id', $indicator_id);
                $stmtIndicatory->bindParam(':objective', $indicatory['objective']);
                $stmtIndicatory->bindParam(':achievement', $indicatory['achievement']);
                $stmtIndicatory->execute();
            }
        }
        foreach ($notes as $note) {
            $stmt = $pdo->prepare("INSERT INTO notes (observation_id, objective) VALUES (:observation_id, :description)");
            $stmt->bindParam(':observation_id', $observation_id);
            $stmt->bindParam(':description', $note['note']);
            $stmt->execute();
        }
    }

    public static function update($id, $nis, $name)
    {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare("UPDATE students SET id = :nis, name = :name WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nis', $nis);
        $stmt->bindParam(':name', $name);
        return $stmt->execute();
    }

    public static function delete($id)
    {
        $pdo = Database::getConnection();

        try {
            // Mulai transaksi
            $pdo->beginTransaction();

            // Hapus data pada tabel indicatories yang berelasi dengan indicators
            $stmt = $pdo->prepare("
            DELETE FROM indicatories 
            WHERE indicators_id IN (
                SELECT id FROM indicators WHERE observation_id = :id
            )
        ");
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            // Hapus data pada tabel indicators yang berelasi dengan observation_id
            $stmt = $pdo->prepare("DELETE FROM indicators WHERE observation_id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            // Hapus data pada tabel notes yang berelasi dengan observation_id
            $stmt = $pdo->prepare("DELETE FROM notes WHERE observation_id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            // Hapus data pada tabel observations
            $stmt = $pdo->prepare("DELETE FROM observations WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            // Commit transaksi jika semua berhasil
            $pdo->commit();

            return true;
        } catch (Exception $e) {
            // Rollback transaksi jika ada kesalahan
            $pdo->rollBack();

            // Log atau tampilkan kesalahan jika diperlukan
            error_log($e->getMessage());
            return false;
        }
    }
}
