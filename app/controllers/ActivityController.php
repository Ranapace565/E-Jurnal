<?php

require_once __DIR__ . '/../models/StudentModel.php';

class ActivityController
{
    public function handle($overrideMethod)
    {
        switch ($overrideMethod) {
            case 'CREATE':
                $this->create();
                break;
            case 'GENERATE':
                $this->createGenerator();
                break;
            case 'RESET':
                $this->reset();
                break;
            case 'UPDATE':
                $this->update();
                break;
            case 'DELETE':
                $this->delete();
                break;
            case 'DELETEALL':
                $this->deleteAll();
                break;
            default:
                echo "erro student controller";
                break;
        }
    }
    public function index($queryParams)
    {
        $search = $queryParams['search'] ?? '';
        $currentPage = isset($queryParams['page']) ? (int)$queryParams['page'] : 1;
        $limit = 10;
        $offset = ($currentPage - 1) * $limit;

        $students = StudentModel::getAll($search, $limit, $offset);

        $totalStudents = StudentModel::countAll($search);

        $totalPages = ceil($totalStudents / $limit);

        $prodis = StudentModel::getProdi();

        $flash = $_SESSION['flash'] ?? null;

        require_once __DIR__ . '/../views/admin/students/Index.php';
    }

    public function create()
    {
        // $nis = $data['nis'];
        // $name = $data['name'];
        // $username = $data['username'];
        // $password = $data['password'];
        // $prodi = $data['prodi'];

        $nis = $_POST['nis'];
        $name = $_POST['name'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $prodi = $_POST['prodi'];

        $studentModel = new StudentModel();

        $studentModel->createSiswa($nis, $name, $username, $password, $prodi);


        $this->index([]);
        // header('Location: /admin/data-siswa');
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
        $id = $_POST['id'];
        $studentModel = new StudentModel();
        $studentModel->resetAkses($id);

        $this->index([]);
        exit;
    }

    public function update()
    {
        $id = $_POST['id'];
        $nama = $_POST['nama'];
        $tempat = $_POST['tempat'];
        $tanggal = $_POST['tanggal'];
        $sex = $_POST['kelamin'];
        $darah = $_POST['darah'];
        $alamat = $_POST['alamat'];
        $telp = $_POST['telp'];
        $catatan = $_POST['catatan'];
        $ortu = $_POST['ortu'];
        $ortutelp = $_POST['ortutelp'];
        $prodi = $_POST['prodi'];
        $kompetensi = $_POST['kompetensi'];
        $nisn = $_POST['nisn'];
        $group = $_POST['group'];

        $result = StudentModel::update($id, $nama, $tempat, $tanggal, $sex, $darah, $alamat, $telp, $catatan, $ortu, $ortutelp, $prodi, $kompetensi, $nisn, $group);

        exit;
    }

    public function updateGroup()
    {

        $id = $_POST['nis'];

        $verifi = StudentModel::getById($id);

        if (!$verifi) {
            $_SESSION['flash'] = [
                'type' => 'error',
                'message' => 'NIS siswa tidak ditemukan.',
            ];
            header('Location: /student/update');
            exit;
        } elseif (!empty($verifi['group_id'])) {
            $group = GroupModel::getGroup($verifi['group_id']);
            $_SESSION['flash'] = [
                'type' => 'error',
                'message' => 'ID siswa sudah terdaftar dalam grup.' . $group['Inama'] . '',
            ];
            header('Location: /student/update');
            exit;
        } else {

            $id_group = $_POST['id'];

            $data = new StudentModel();
            $student = $data->show($id);

            $nama = $student['name'];
            $tempat = $student['born_place'];
            $tanggal = $student['born_date'];
            $sex = $student['sex'];
            $darah = $student['blood_type'];
            $alamat = $student['address'];
            $telp = $student['telp'];
            $catatan = $student['health_note'];
            $ortu = $student['parent_name'];
            $ortutelp = $student['parent_telp'];
            $prodi = $student['expertise'];
            $kompetensi = $student['competence'];
            $nisn = $student['nisn'];

            $result = StudentModel::update($id, $nama, $tempat, $tanggal, $sex, $darah, $alamat, $telp, $catatan, $ortu, $ortutelp, $prodi, $kompetensi, $nisn, $id_group);
        }
    }

    public function delete()
    {
        $id = $_POST['id'];

        $result = StudentModel::delete($id);

        // header('Location: /admin/data-');
        $this->index([]);
        exit;
    }

    public function deleteAll()
    {
        $result = StudentModel::deleteAll();
        $this->index([]);
    }

    public function show()
    {
        $id = $_SESSION['id'];
        $data = new StudentModel();
        $data->show($id);

        require_once __DIR__ . '/../views/student/profile/Index.php';
    }
    // public function profile()
    // {
    //     $id = $_SESSION['id'];
    //     $data = new StudentModel();
    // }
}
