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
            case 'UPDATE':
                $this->update();
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
        require_once __DIR__ . '/../views/auth/index.php';
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

    public function update()
    {
        $id = $_POST['id'];
        $username = $_POST['username'];
        $oldpassword = $_POST['oldpassword'];
        $newpassword = $_POST['newpassword'];

        $userModel = new AkunModel();
        $user = $userModel->auth($id, $oldpassword);

        if ($user) {
            $studentModel = new AkunModel();

            if (empty($newpassword)) {
                // Update hanya username
                $studentModel->updateUsername($id, $username);
            } else {
                // Update username dan password
                $studentModel->update($id, $username, $newpassword);
            }

            $_SESSION['flash'] = ['type' => 'succes', 'message' => 'Akses berhasil diupdate'];
        } else {
            $_SESSION['flash'] = ['type' => 'error', 'message' => 'Password salah'];
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
                header('Location: /siswa');
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
