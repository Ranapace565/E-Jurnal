<?php

require_once __DIR__ . '/../controllers/DudiController.php';
require_once __DIR__ . '/../controllers/ActivityController.php';
require_once __DIR__ . '/../controllers/StudentController.php';
require_once __DIR__ . '/../controllers/EvaluationController.php';
require_once __DIR__ . '/../controllers/ObservasiController.php';

function handleDudiRoutes($path, $queryParams)
{
    switch ($path) {
        case '/dudi':
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

        case '/dudi/kelompok':
            $method = $_SERVER['REQUEST_METHOD'];
            $overrideMethod = $_POST['_method'] ?? null;
            $controller = new DUDIController();

            if ($method === 'GET') {
                $controller->group();
            } elseif ($method === 'POST') {
                $controller->handle($overrideMethod);

                // $controller->auth();
            } else {
                http_response_code(405);
            }
            break;

        case '/dudi/kegiatan':
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
        case '/dudi/profile':

            $method = $_SERVER['REQUEST_METHOD'];
            $overrideMethod = $_POST['_method'] ?? null;
            $controller = new DudiController();

            if ($method === 'GET') {
                $controller->show();
            } elseif ($method === 'POST') {
                $controller->handle($overrideMethod);
            } else {
                http_response_code(405);
            }
            break;
        case '/dudi/siswa':
            $method = $_SERVER['REQUEST_METHOD'];
            $overrideMethod = $_POST['_method'] ?? null;
            $controller = new StudentController();

            if ($method === 'GET') {
                $controller->indexDudi($queryParams);
            } elseif ($method === 'POST') {
                $controller->handle($overrideMethod);
            } else {
                http_response_code(405);
            }
            break;
        case '/dudi/informasi-siswa':
            $method = $_SERVER['REQUEST_METHOD'];
            $overrideMethod = $_POST['_method'] ?? null;
            $controller = new StudentController();

            if ($method === 'GET') {
                $controller->indexDudi($queryParams);
            } elseif ($method === 'POST') {
                $controller->handle($overrideMethod);
                // require_once __DIR__ . '/../views/dudi/students/Show.php';
            } else {
                http_response_code(405);
            }
            break;


        case '/dudi/penilaian':
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
        case '/dudi/observasi':
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
