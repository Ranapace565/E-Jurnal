<?php
require_once __DIR__ . '/../models/ObservationModel.php';

class ObservationController
{
    public function handle($overrideMethod)
    {
        switch ($overrideMethod) {
            case 'UPDATE':
                $this->update();
                break;
            case 'DELETE':
                $this->delete();
                break;
            case 'SHOW':
                $this->show();
                break;
            case 'SHOWM':
                $this->showM();
                echo "ObservationController::handle() - SHOWM";
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

        $student_id = $nis; // ID siswa yang ingin ditampilkan

        $obser = new ObservationModel();

        // Ambil data observasi
        $observation = $obser->getObservation($student_id);

        // Ambil data indikator berdasarkan observasi
        $indicators = $obser->getIndicators($observation['id']);

        // Ambil data indicatories berdasarkan semua `indicators_id`
        $indicator_ids = array_column($indicators, 'id'); // Dapatkan semua ID indikator
        $indicatories = $obser->getIndictories($indicator_ids);

        // Ambil catatan berdasarkan observasi
        $notes = $obser->getNotes($observation['id']);


        require_once __DIR__ . '/../views/dudi/observasi/Index.php';
    }
    public function showM()
    {
        $nis = $_SESSION['nis'];

        $siswa = new StudentModel();
        $siswa = $siswa->getById($nis);

        $student_id = $nis; // ID siswa yang ingin ditampilkan

        $obser = new ObservationModel();

        // Ambil data observasi
        $observation = $obser->getObservation($student_id);

        // Ambil data indikator berdasarkan observasi
        $indicators = $obser->getIndicators($observation['id']);

        // Ambil data indicatories berdasarkan semua `indicators_id`
        $indicator_ids = array_column($indicators, 'id'); // Dapatkan semua ID indikator
        $indicatories = $obser->getIndictories($indicator_ids);

        // Ambil catatan berdasarkan observasi
        $notes = $obser->getNotes($observation['id']);


        require_once __DIR__ . '/../views/mentor/observasi/Index.php';
    }

    public function showStudent()
    {
        $nis = $_SESSION['user']['id'];

        $siswa = new StudentModel();

        $nis = $siswa->show($nis);

        $siswa = $siswa->getById($nis['id']);

        $student_id = $nis['id'];
        // echo $nis['id'];

        $obser = new ObservationModel();

        // Ambil data observasi
        $observation = $obser->getObservation($student_id);

        // Ambil data indikator berdasarkan observasi
        $indicators = $obser->getIndicators($observation['id']);

        // Ambil data indicatories berdasarkan semua `indicators_id`
        $indicator_ids = array_column($indicators, 'id'); // Dapatkan semua ID indikator
        $indicatories = $obser->getIndictories($indicator_ids);

        // Ambil catatan berdasarkan observasi
        $notes = $obser->getNotes($observation['id']);


        require_once __DIR__ . '/../views/student/observation/Index.php';
    }


    public function update()
    {
        // Loop through POST data to update indicator and note descriptions, and achievement
        foreach ($_POST as $key => $value) {
            // Handle updates for indicator achievement (radio buttons)
            if (strpos($key, 'achievement-') === 0) {
                $indicatorId = str_replace('achievement-', '', $key);
                $achievement = $_POST["achievement-{$indicatorId}"];
                // $achievement = 1;

                // Validate achievement (if necessary)
                if (!in_array($achievement, [1, 2])) {
                    throw new Exception("Achievement value must be 1 or 2 for indicator ID $indicatorId.");
                }

                // Update achievement in indicatories table
                ObservationModel::updateAchievement($indicatorId, $achievement);
            }

            // Handle updates for indicator description
            if (strpos($key, 'desc-') === 0) {
                $indicatorId = str_replace('desc-', '', $key);
                $description = $_POST[$key];

                // Update description in indicators table
                ObservationModel::updateIndicatorDescription($indicatorId, $description);
            }

            // Handle updates for note descriptions
            if (strpos($key, 'note-') === 0) {
                $noteId = str_replace('note-', '', $key);
                $description = $_POST[$key];

                // Update description in notes table
                ObservationModel::updateNoteDescription($noteId, $description);
            }
        }

        // Optionally, redirect to show method or another page
        $this->show();
        exit;
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
