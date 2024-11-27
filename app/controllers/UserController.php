<?php
require_once __DIR__ . '/../models/AkunModel.php';

class UserController
{
    public function handle($overrideMethod)
    {
        switch ($overrideMethod) {
            case 'LOGIN':
                $this->auth();
                break;
            case 'LOGOUT':
                $this->delete();
                break;
            default:
                break;
        }
    }
    public function index($queryParams)
    {
        $flash = $_SESSION['flash'] ?? null; // Pesan flash jika ada
        unset($_SESSION['flash']); // Hapus flash setelah digunakan
        require_once __DIR__ . '/../views/auth/login.php';
    }

    public function auth()
    {
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        $userModel = new AkunModel();
        $user = $userModel->login($username, $password);

        if ($user) {
            $_SESSION['user'] = $user; // Simpan data pengguna di sesi
            $this->redirectUser($user['role']);
        } else {
            $_SESSION['flash'] = ['type' => 'error', 'message' => 'Username atau password salah'];
            header('Location: /login'); // Redirect kembali ke login
            exit;
        }
    }

    private function redirectUser($role)
    {
        // Redirect berdasarkan role
        switch ($role) {
            case 'admin':
                header('Location: /admin/data-kelompok');
                break;
            case 'siswa':
                header('Location: /student/dashboard');
                break;
            case 'dudi':
                header('Location: /dudi/dashboard');
                break;
            case 'mentor':
                header('Location: /mentor/dashboard');
                break;
            default:
                header('Location: /login');
                break;
        }
        exit;
    }

    public function delete()
    {
        $id = $_POST['id'];
        $result = MentorModel::delete($id);
    }
}
