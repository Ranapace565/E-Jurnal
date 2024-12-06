<?php

require_once __DIR__ . '/../controllers/DudiController.php';
require_once __DIR__ . '/../controllers/ActivityController.php';
require_once __DIR__ . '/../controllers/StudentController.php';

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

                // $controller->auth();
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

        case '/dudi/observasi':
            $method = $_SERVER['REQUEST_METHOD'];
            $overrideMethod = $_POST['_method'] ?? null;
            $controller = new ObservationController();

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

            if (isset($_POST['id'])) {
                $_SESSION['nis'] = $_POST['id'];
            }

            $method = $_SERVER['REQUEST_METHOD'];
            $overrideMethod = $_POST['_method'] ?? null;
            $controller = new ActivityController();

            if ($method === 'GET') {
                $controller->indexDudi($queryParams);
            } elseif ($method === 'POST') {
                $controller->handle($queryParams);
                $controller->indexDudi($queryParams);
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

        default:
            http_response_code(404);
            echo "Metode tidak diizinkan.";
            break;
    }
}
