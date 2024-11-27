<?php
require_once __DIR__ . '/../models/MentorModel.php';
require_once __DIR__ . '/../models/GroupModel.php';

class GroupController
{
    public function handle($overrideMethod)
    {
        switch ($overrideMethod) {
                // case 'CREATE':
                //     $this->create();
                //     break;
            case 'SHOW':
                $this->show();
                break;
            case 'PUT':
                $this->update();
                break;
            case 'INSERT':
                $student = new StudentController;

                $this->verifi();
                $student->updateGroup();
                $this->show();
                break;
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

    private function verifi()
    {
        $verifi = StudentModel::getById($_POST['nis']);

        if (!$verifi) {
            $_SESSION['flash'] = [
                'type' => 'error',
                'message' => 'ID siswa tidak ditemukan.',
            ];
            $this->show();
            exit;
        } elseif (!empty($verifi['group_id'])) {
            $group = GroupModel::getGroup($verifi['group_id']);
            $_SESSION['flash'] = [
                'type' => 'error',
                'message' => 'ID siswa sudah terdaftar dalam grup.' . $group['Inama'] . '',
            ];
            $this->show();
            exit;
        }
    }
    public function index($queryParams)
    {
        $search = $queryParams['search'] ?? '';
        $currentPage = isset($queryParams['page']) ? (int)$queryParams['page'] : 1;
        $limit = 10;
        $offset = ($currentPage - 1) * $limit;

        $Groups = GroupModel::getAll($search, $limit, $offset);

        $totalGroups = GroupModel::countAll($search);

        $totalPages = ceil($totalGroups / $limit);

        // $prodis = MentorModel::getProdi();

        // Ambil flash message jika ada
        $flash = $_SESSION['flash'] ?? null;

        // Render view
        require_once __DIR__ . '/../views/admin/group/Index.php';
    }

    public function create()
    {
        $mentor = $_POST['mentorId'];
        $dudi = $_POST['dudiId'];
        $mulai = $_POST['start'];
        $finis = $_POST['end'];

        $group = new GroupModel();
        $group->createGroup($mentor, $dudi, $mulai, $finis);

        $this->index([]);
    }

    public function update()
    {
        $id = $_POST['id'];
        $mentor = $_POST['mentorId'];
        $dudi = $_POST['dudiId'];
        $mulai = $_POST['start'];
        $finis = $_POST['end'];

        $group = new GroupModel();
        $group->update($id, $mentor, $dudi, $mulai, $finis);

        $this->show();
    }

    public function show()
    {
        $id = $_POST['id'];
        $group = GroupModel::getGroup($id);
        require_once __DIR__ . '/../views/admin/group/Detail.php';
    }
    public function delete()
    {
        $id = $_POST['id'];
        $group = new GroupModel();
        $group->delete($id);
        // header('Location: /admin/data-');
        $this->index([]);
        exit;
    }
}
