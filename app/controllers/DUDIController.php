<?php

require_once __DIR__ . '/../models/StudentModel.php';

require_once __DIR__ . '/../models/DudiModel.php';

class DudiController
{
    public function handle($overrideMethod)
    {
        switch ($overrideMethod) {
            case 'CREATE':
                $this->create();
                break;
                // case 'GENERATE':
                //     $this->createGenerator();
                //     break;
            case 'RESET':
                $this->reset();
                break;
                // case 'UPDATE':
                //     $this->update();
                //     break;
            case 'DELETE':
                $this->delete();
                break;
                // case 'DELETEALL':
                //     $this->deleteAll();
                //     break;
            default:
                break;
        }
    }
    public function kegiatan()
    {
        require_once __DIR__ . '/../views/dudi/Kegiatan.php';
    }
    public function index($queryParams)
    {
        $search = $queryParams['search'] ?? '';
        $currentPage = isset($queryParams['page']) ? (int)$queryParams['page'] : 1;
        $limit = 10;
        $offset = ($currentPage - 1) * $limit;

        $dudis = DudiModel::getAll($search, $limit, $offset);

        $totalDudis = DudiModel::countAll($search);

        $totalPages = ceil($totalDudis / $limit);

        // $prodis = DudiModel::getProdi();

        // Ambil flash message jika ada
        $flash = $_SESSION['flash'] ?? null;

        // Render view
        require_once __DIR__ . '/../views/admin/dudi/Index.php';
    }
    public function create()
    {

        $name = $_POST['name'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $alamat = $_POST['alamat'];

        $dudi = new DudiModel();
        $dudi->createDudi($name, $username, $password, $alamat);

        $this->index([]);
    }

    public function reset()
    {
        $id = $_POST['id'];
        $dudi = new DudiModel();
        $dudi->resetAkses($id);
        $this->index([]);
    }
    public function delete()
    {
        $id = $_POST['id'];

        $result = DudiModel::delete($id);

        // header('Location: /admin/data-');
        $this->index([]);
        exit;
    }
}
