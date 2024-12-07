<?php
require_once __DIR__ . '/../models/EvaluationModel.php';

class EvaluationController
{
    public function handle($overrideMethod)
    {
        switch ($overrideMethod) {
            case 'CREATE':
                $this->update();
                break;
            case 'UPDATE':
                $this->update();
                break;
            case 'DELETE':
                $this->delete();
                break;
            default:
                http_response_code(405);
                break;
        }
    }


    public function create($id) {}
    public function show($id)
    {
        require_once __DIR__ . '/../views/dudi/evaluation/Index.php';
    }

    public function upload()
    {
        $userId = $_SESSION['user']['id']; // Ambil ID user dari session
        $file = $_FILES['file'];

        $profileModel = new ProfileModel();
        $result = $profileModel->upload($userId, $file);

        if ($result) {
            $_SESSION['flash'] = ['type' => 'success', 'message' => 'Foto berhasil diupload!'];
        } else {
            $_SESSION['flash'] = ['type' => 'error', 'message' => 'Gagal mengupload foto.'];
        }
    }

    public function update()
    {
        $userId = $_SESSION['user_id'];
        $file = $_FILES['file'];

        $profileModel = new ProfileModel();
        $result = $profileModel->update($userId, $file);

        if ($result) {
            $_SESSION['flash'] = ['type' => 'success', 'message' => 'Foto berhasil diupdate!'];
        } else {
            $_SESSION['flash'] = ['type' => 'error', 'message' => 'Gagal mengupdate foto.'];
        }

        header('Location: /siswa/foto');
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
