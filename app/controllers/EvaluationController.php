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
            case 'SHOWM':
                $this->showM();
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
    public function showM()
    {
        $nis = $_SESSION['nis'];

        $siswa = new StudentModel();
        $siswa = $siswa->getById($nis);

        $evaluation = EvaluationModel::PracticeByStd($nis);
        $learnings = EvaluationModel::LearningStd($evaluation['id']);
        $precences = EvaluationModel::PresenceStd($evaluation['id']);

        $flash = $_SESSION['flash'] ?? null;
        require_once __DIR__ . '/../views/mentor/evaluation/Index.php';
    }

    public function show2()
    {
        $nis = $_SESSION['user']['id'];

        $siswa = new StudentModel();

        $nis = $siswa->show($nis);

        $siswa = $siswa->getById($nis['id']);

        $student_id = $nis['id'];


        $siswa = new StudentModel();
        $siswa = $siswa->getById($student_id);

        $obser = new ObservationModel();

        $observation = $obser->getObservation($student_id);

        $evaluation = EvaluationModel::PracticeByStd($student_id);
        $learnings = EvaluationModel::LearningStd($evaluation['id']);
        $precences = EvaluationModel::PresenceStd($evaluation['id']);

        $flash = $_SESSION['flash'] ?? null;
        require_once __DIR__ . '/../views/student/evaluation/Index.php';
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

        if ($sakit < 0) {
            $sakit = 0;
        }
        if ($izin < 0) {
            $izin = 0;
        }
        if ($bolos < 0) {
            $bolos = 0;
        }

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
