<?php
require_once __DIR__ . '/../models/EvaluationModel.php';
require_once __DIR__ . '/../models/StudentModel.php';

class EvaluationController
{
    public function handle($overrideMethod)
    {
        switch ($overrideMethod) {
            case 'SHOW':
                $this->show();
                break;
            case 'CREATE':
                $this->update();
                break;
            case 'UPDATE':
                $this->update();
                break;
            case 'PRESENCE':
                $this->update2();
                break;
            case 'DELETE':
                $this->delete();
                break;
            default:
                http_response_code(405);
                break;
        }
    }

    public function show()
    {
        $nis = $_SESSION['nis'];

        $siswa = new StudentModel();
        $siswa = $siswa->getById($nis);

        $evaluation = EvaluationModel::PracticeByStd($nis);
        $learnings = EvaluationModel::LearningStd($evaluation['id']);
        $precences = EvaluationModel::PresenceStd($evaluation['id']);

        $flash = $_SESSION['flash'] ?? null;
        require_once __DIR__ . '/../views/dudi/evaluation/Index.php';
    }


    public function update()
    {
        try {
            // Iterasi semua input POST
            foreach ($_POST as $key => $value) {
                if (strpos($key, 'score-') === 0) {
                    // Ambil ID dari nama input
                    $id = str_replace('score-', '', $key);
                    $score = $_POST["score-{$id}"];
                    $description = $_POST["desc-{$id}"];

                    // Validasi skor
                    if ($score < 0) {
                        $score = 0;
                    }
                    if ($score > 100) {
                        $score = 100;
                    }

                    // Update data melalui model
                    EvaluationModel::update($id, $score, $description);
                }
            }

            // Redirect atau tampilkan view setelah berhasil
            $_SESSION['flash'] = [
                'type' => 'success',
                'message' => 'Nilai siswa berhasil disimpan!'
            ];
        } catch (Exception $e) {
            // Tangkap error untuk menampilkan pesan kepada user
            $_SESSION['flash'] = [
                'type' => 'error',
                'message' => $e->getMessage()
            ];
        }

        $this->show();
    }

    public function update2()
    {
        $id = $_POST['id'];
        $sakit = $_POST['sakit'];
        $izin = $_POST['izin'];
        $bolos = $_POST['bolos'];

        EvaluationModel::update2($id, $sakit, $izin, $bolos);

        $this->show();
    }

    public function delete()
    {
        $userId = $_SESSION['user_id'];

        $profileModel = new ProfileModel();
        $result = $profileModel->delete($userId);

        if ($result) {
            $_SESSION['flash'] = ['type' => 'success', 'message' => 'Foto berhasil dihapus!'];
        } else {
            $_SESSION['flash'] = ['type' => 'error', 'message' => 'Gagal menghapus foto.'];
        }

        header('Location: /siswa/foto');
    }
}
