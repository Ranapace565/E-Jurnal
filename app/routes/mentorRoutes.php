<?php

require_once __DIR__ . '/../controllers/DUDIController.php';
require_once __DIR__ . '/../controllers/ActivityController.php';
require_once __DIR__ . '/../controllers/StudentController.php';
require_once __DIR__ . '/../controllers/EvaluationController.php';
require_once __DIR__ . '/../controllers/ObservasiController.php';
require_once __DIR__ . '/../controllers/MentorController.php';

function handleMentorRoutes($path, $queryParams)
{
    switch ($path) {
        case '/pembimbing':
            $method = $_SERVER['REQUEST_METHOD'];
            $overrideMethod = $_POST['_method'] ?? null;
            $controller = new UserController();

            if ($method === 'GET') {
                $controller->index($queryParams);
            } elseif ($method === 'POST') {
                $controller->handle($overrideMethod);
            } else {
                http_response_code(405);
            }
            break;

        case '/pembimbing/kelompok':
            $method = $_SERVER['REQUEST_METHOD'];
            $overrideMethod = $_POST['_method'] ?? null;
            $controller = new MentorController();

            if ($method === 'GET') {
                $controller->group();
            } elseif ($method === 'POST') {
                $controller->handle($overrideMethod);

                // $controller->auth();
            } else {
                http_response_code(405);
            }
            break;

        case '/pembimbing/kegiatan':
            // session_start();

            if (isset($_POST['nis'])) {
                $_SESSION['nis'] = $_POST['nis'];
            }

            $method = $_SERVER['REQUEST_METHOD'];
            $overrideMethod = $_POST['_method'] ?? null;
            $controller = new ActivityController();

            if ($method === 'GET') {
                $controller->indexDudi($queryParams);
            } elseif ($method === 'POST') {
                $controller->handle($overrideMethod);
                // $controller->indexDudi($overrideMethod);
            } else {
                http_response_code(405);
            }
            break;
        case '/pembimbing/profile':

            $method = $_SERVER['REQUEST_METHOD'];
            $overrideMethod = $_POST['_method'] ?? null;
            $controller = new MentorController();

            if ($method === 'GET') {
                $controller->show();
            } elseif ($method === 'POST') {
                $controller->handle($overrideMethod);
            } else {
                http_response_code(405);
            }
            break;
        case '/pembimbing/siswa':
            $method = $_SERVER['REQUEST_METHOD'];
            $overrideMethod = $_POST['_method'] ?? null;
            $controller = new StudentController();

            if ($method === 'GET') {
                $controller->indexMentor($queryParams);
            } elseif ($method === 'POST') {
                $controller->handle($overrideMethod);
            } else {
                http_response_code(405);
            }
            break;
        case '/pembimbing/informasi-siswa':
            $method = $_SERVER['REQUEST_METHOD'];
            $overrideMethod = $_POST['_method'] ?? null;
            $controller = new StudentController();

            if ($method === 'GET') {
                $controller->indexMentor($queryParams);
            } elseif ($method === 'POST') {
                $controller->handle($overrideMethod);
                // require_once __DIR__ . '/../views/dudi/students/Show.php';
            } else {
                http_response_code(405);
            }
            break;

        case '/pembimbing/penilaian':
            $method = $_SERVER['REQUEST_METHOD'];
            $overrideMethod = $_POST['_method'] ?? null;
            $controller = new EvaluationController();

            if (isset($_POST['nis'])) {
                $_SESSION['nis'] = $_POST['nis'];
            }

            if ($method === 'GET') {
                // $controller->show($queryParams);
            } elseif ($method === 'POST') {
                $controller->handle($overrideMethod);
            } else {
                http_response_code(405);
            }
            break;
        case '/pembimbing/observasi':
            $method = $_SERVER['REQUEST_METHOD'];
            $overrideMethod = $_POST['_method'] ?? null;
            $controller = new ObservationController();

            if (isset($_POST['nis'])) {
                $_SESSION['nis'] = $_POST['nis'];
            }

            if ($method === 'GET') {
                // $controller->group();
            } elseif ($method === 'POST') {
                $controller->handle($overrideMethod);
            } else {
                http_response_code(405);
            }
            break;

        default:
            http_response_code(404);
            echo "Metode tidak diizinkan.";
            break;
    }
}
