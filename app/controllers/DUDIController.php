<?php

require_once __DIR__ . '/../models/StudentModel.php';

require_once __DIR__ . '/../models/DudiModel.php';
require_once __DIR__ . '/../models/GroupModel.php';

class DudiController
{
    public function handle($overrideMethod)
    {
        switch ($overrideMethod) {
                // case 'GROUP':
                //     $this->groupDudi();
                //     break;
            case 'CREATE':
                $this->create();
                break;
            case 'RESET':
                $this->reset();
                break;
            case 'DELETE':
                $this->delete();
                break;
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

        $flash = $_SESSION['flash'] ?? null;

        require_once __DIR__ . '/../views/admin/dudi/Index.php';
    }

    public function group()
    {
        $id = $_SESSION['user']['id'];
        $data = new GroupModel;
        $Groups = $data->getByDudi($id);


        require_once __DIR__ . '/../views/dudi/group/Index.php';
    }


    // getByDudi($id)
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
