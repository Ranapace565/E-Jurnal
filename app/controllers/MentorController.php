<?php
require_once __DIR__ . '/../models/MentorModel.php';

class MentorController
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
    public function index($queryParams)
    {
        $search = $queryParams['search'] ?? '';
        $currentPage = isset($queryParams['page']) ? (int)$queryParams['page'] : 1;
        $limit = 10;
        $offset = ($currentPage - 1) * $limit;

        $mentors = MentorModel::getAll($search, $limit, $offset);

        $totalMentors = MentorModel::countAll($search);

        $totalPages = ceil($totalMentors / $limit);

        // $prodis = MentorModel::getProdi();

        // Ambil flash message jika ada
        $flash = $_SESSION['flash'] ?? null;

        // Render view
        require_once __DIR__ . '/../views/admin/mentor/Index.php';
    }

    public function create()
    {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $username = $_POST['username'];
        $password = $_POST['password'];

        $dudi = new MentorModel();
        $dudi->createMentor($id, $name, $username, $password);

        $this->index([]);
    }

    public function reset()
    {
        $id = $_POST['id'];
        $dudi = new MentorModel();
        $dudi->resetAkses($id);
        $this->index([]);
    }
    public function delete()
    {
        $id = $_POST['id'];
        $result = MentorModel::delete($id);
        // header('Location: /admin/data-');
        $this->index([]);
        exit;
    }
}
