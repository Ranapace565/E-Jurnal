<?php

require_once __DIR__ . '/../../config/database.php';

class ObservationModel
{
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
                ["objective" => "Penerapan Soft skills yang dibutuhkan dalam dunia kerja (tempat PKL) ", "achievement" => '0'],
                ["objective" => "Melaksanakan Komunikasi telepon sesuai kaidah", "achievement" => '0'],
                ["objective" => "Menunjukan integritas (antara lain jujur, disiplin komitmen, dan tanggung jawab)", "achievement" => '0'],
                ["objective" => "Memiliki Etos kerja", "achievement" => '0'],
                ["objective" => "Menunjukan kemandirian", "achievement" => '0'],
                ["objective" => "Menunjukan kerjasama", "achievement" => '0'],
                ["objective" => "Menunjukan kepedulian sosial dan lingkungan", "achievement" => '0'],
            ]],
            ["description" => "Menerapkan Norma, POS dan K3LH yang ada di Dunia Kerja (Tempat PKL)", "indicatories" => [
                ["objective" => "Menerapkan Norma, POS dan K3LH yang ada di Dunia Kerja (Tempat PKL)", "achievement" => '0'],
                ["objective" => "Menggunakan APD dengan tertib dan benar", "achievement" => '0'],
                ["objective" => "Melaksanakan pekerjaan dengan POS", "achievement" => '0'],
            ]],
            ["description" => "Menerapkan kompetensi teknis yang sudah dipelajari di sekolah dan/atau baru", "indicatories" => [
                ["objective" => "Menerapkan kompetensi teknis yang sudah dipelajari di sekolah dan/atau baru", "achievement" => '0'],
            ]],
            ["description" => "Dipelajari pada dunia kerja (tempat PKL) Memahami alur bisnis dunia kerja tempat PKL dan wawasan wirausaha", "indicatories" => [
                ["objective" => "Dipelajari pada dunia kerja (tempat PKL) Memahami alur bisnis dunia kerja tempat PKL dan wawasan wirausaha", "achievement" => '0'],
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

    function getObservation($student_id)
    {
        $pdo = Database::getConnection();

        $stmt = $pdo->prepare("
            SELECT * FROM observations WHERE nis = :student_id
        ");
        $stmt->bindParam(':student_id', $student_id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    function getIndicators($observation_id)
    {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare("
            SELECT * FROM indicators WHERE observation_id = :observation_id
        ");
        $stmt->bindParam(':observation_id', $observation_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function getIndictories($indicator_ids)
    {
        $pdo = Database::getConnection();

        $placeholders = implode(',', array_fill(0, count($indicator_ids), '?'));
        $stmt = $pdo->prepare("
            SELECT * FROM indicatories WHERE indicators_id IN ($placeholders)
        ");
        $stmt->execute($indicator_ids);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function getNotes($observation_id)
    {
        $pdo = Database::getConnection();

        $stmt = $pdo->prepare("
            SELECT 
            id, 
            objective,
            COALESCE(description, '-') AS description
             FROM notes WHERE observation_id = :observation_id
        ");
        $stmt->bindParam(':observation_id', $observation_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function updateNoteDescription($id, $description)
    {
        try {
            $pdo = Database::getConnection();
            $stmt = $pdo->prepare("UPDATE notes SET description = :description WHERE id = :id");
            $stmt->bindValue(':description', $description, PDO::PARAM_STR);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            // Handle error
            throw new Exception('Error updating note description: ' . $e->getMessage());
        }
    }

    // Update description in indicators table
    public static function updateIndicatorDescription($id, $description)
    {
        try {
            $pdo = Database::getConnection();
            $stmt = $pdo->prepare("UPDATE indicators SET description = :description WHERE id = :id");
            $stmt->bindValue(':description', $description, PDO::PARAM_STR);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            // Handle error
            throw new Exception('Error updating indicator description: ' . $e->getMessage());
        }
    }

    // Update achievement in indicatories table
    public static function updateAchievement($id, $achievement)
    {
        try {
            $pdo = Database::getConnection();
            $stmt = $pdo->prepare("UPDATE indicatories SET achievement = :achievement WHERE id = :id");
            $stmt->bindValue(':achievement', $achievement, PDO::PARAM_INT);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            // Handle error
            throw new Exception('Error updating achievement: ' . $e->getMessage());
        }
    }
}
