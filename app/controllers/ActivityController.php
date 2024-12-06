<?php

require_once __DIR__ . '/../models/StudentModel.php';
require_once __DIR__ . '/../models/ActivityModel.php';

class ActivityController
{
    public function handle($overrideMethod)
    {
        switch ($overrideMethod) {
            case 'CREATE':
                $this->create();
                break;
                // case 'SHOW':
                //     $this->show();
                //     break;
            case 'UPDATE':
                $this->update();
                break;
            case 'DELETE':
                $this->delete();
                break;
            default:
                echo "erro student controller";
                break;
        }
    }
    public function index($queryParams)
    {
        $id = $_SESSION['user']['id'];

        $search = $queryParams['search'] ?? '';

        $approve = $queryParams['approve'] ?? '';

        $currentPage = isset($queryParams['page']) ? (int)$queryParams['page'] : 1;

        $limit = 10;
        $offset = ($currentPage - 1) * $limit;

        // echo $id;

        $activitys = ActivityModel::getAll($id, $search, $approve, $limit, $offset);

        $totalApproved = ActivityModel::countByStatus($id, 1); // Approve = 1 (diterima)
        $totalRejected = ActivityModel::countByStatus($id, 2); // Approve = 2 (ditolak)
        $totalPending = ActivityModel::countByStatus($id, 3);  // Approve = 0 (proses)


        $totalActivitys = ActivityModel::countAll($id);


        $totalPages = ceil($totalActivitys / $limit);

        // $prodis = ActivityModel::getProdi();

        $flash = $_SESSION['flash'] ?? null;

        require_once __DIR__ . '/../views/student/activity/Index.php';
    }

    public function indexDudi($queryParams)
    {
        $id = $_SESSION['nis'];

        $search = $queryParams['search'] ?? '';

        $approve = $queryParams['approve'] ?? '';

        $currentPage = isset($queryParams['page']) ? (int)$queryParams['page'] : 1;

        $limit = 10;
        $offset = ($currentPage - 1) * $limit;

        // echo $id;

        $activitys = ActivityModel::getByDudi($id, $search, $approve, $limit, $offset);

        $totalApproved = ActivityModel::countByStatus($id, 1); // Approve = 1 (diterima)
        $totalRejected = ActivityModel::countByStatus($id, 2); // Approve = 2 (ditolak)
        $totalPending = ActivityModel::countByStatus($id, 3);  // Approve = 0 (proses)


        $totalActivitys = ActivityModel::countAll($id);


        $totalPages = ceil($totalActivitys / $limit);

        // $prodis = ActivityModel::getProdi();

        $flash = $_SESSION['flash'] ?? null;

        require_once __DIR__ . '/../views/dudi/activity/Index.php';
    }

    // public function show()
    // {
    //     $id = $_POST['id'];
    //     $group = ActivityModel::getActivity($id);
    //     require_once __DIR__ . '/../views/admin/group/Detail.php';
    // }

    public function create()
    {
        $id = $_SESSION['user']['id'];
        $date = $_POST['tanggal'];
        $aktivitas = $_POST['kegiatan'];
        $deskripsi = $_POST['detail'];

        $activityModel = new ActivityModel();

        $activityModel->createActivity($id, $date, $aktivitas, $deskripsi);

        $this->index([]);
        exit;
    }

    public function createGenerator()
    {
        // Periksa apakah data POST tersedia
        $first = isset($_POST['nis1']) ? $_POST['nis1'] : null;
        $last = isset($_POST['nis2']) ? $_POST['nis2'] : null;
        $prodi = isset($_POST['prodi3']) ? $_POST['prodi3'] : null;

        // Validasi jika salah satu data kosong
        if (empty($first) || empty($last) || empty($prodi)) {
            $this->index([]);
            exit;
        }

        // Proses data jika valid
        $studentModel = new StudentModel();
        $studentModel->generateSiswa($first, $last, $prodi);

        // Redirect ke halaman index
        $this->index([]);
        exit;
    }

    public function reset()
    {
        // $id = $_POST['id'];
        $id = $_SESSION['user_id'];
        $activityModel = new StudentModel();
        $activityModel->resetAkses($id);

        $this->index([]);
        exit;
    }

    public function update()
    {
        $id = $_POST['id'];
        $tanggal = $_POST['tanggal'];
        $aktivitas = $_POST['kegiatan'];
        $detail = $_POST['detail'];
        if (isset($_POST['approve'])) {
            $approve = $_POST['approve'];
        } else {
            $approve = 3;
        }

        $update = new ActivityModel;
        $update->update($id, $tanggal, $aktivitas, $detail, $approve);

        $this->index([]);
        exit;
    }


    public function delete()
    {
        $id = $_POST['id'];

        $result = ActivityModel::delete($id);

        $this->index([]);
        exit;
    }
}
