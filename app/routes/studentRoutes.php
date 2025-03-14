<?php

require_once __DIR__ . '/../controllers/ActivityController.php';
require_once __DIR__ . '/../controllers/StudentController.php';
require_once __DIR__ . '/../controllers/DUDIController.php';
require_once __DIR__ . '/../controllers/MentorController.php';
require_once __DIR__ . '/../controllers/GroupController.php';
require_once __DIR__ . '/../controllers/ProfileController.php';
require_once __DIR__ . '/../controllers/EvaluationController.php';

function handleStudentRoutes($path, $queryParams)
{
    switch ($path) {
        case '/siswa':
            $method = $_SERVER['REQUEST_METHOD'];
            $overrideMethod = $_POST['_method'] ?? null;
            $controller = new StudentController();

            if ($method === 'GET') {
                $controller->show();
            } elseif ($method === 'POST') {
                $controller->handle($overrideMethod);
            } else {
                http_response_code(405);
            }
            break;
        case '/siswa/profile':
            $method = $_SERVER['REQUEST_METHOD'];
            $overrideMethod = $_POST['_method'] ?? null;
            $controller = new StudentController();

            if ($method === 'GET') {
                $controller->show();
            } elseif ($method === 'POST') {
                $controller->handle($overrideMethod);
            } else {
                http_response_code(405);
            }
            break;

        case '/siswa/foto':
            $method = $_SERVER['REQUEST_METHOD'];
            $overrideMethod = $_POST['_method'] ?? null;
            $controller = new ProfileController();

            if ($method === 'GET') {
                // $controller->index();
            } elseif ($method === 'POST') {
                $controller->handle($overrideMethod);
            } else {
                http_response_code(405);
            }
            break;
        case '/siswa/kegiatan':
            $method = $_SERVER['REQUEST_METHOD'];
            $overrideMethod = $_POST['_method'] ?? null;
            $controller = new ActivityController();

            if ($method === 'GET') {
                $controller->index($queryParams);
            } elseif ($method === 'POST') {
                $controller->handle($overrideMethod);
            } else {
                http_response_code(405);
            }
            break;
        case '/siswa/observasi':
            $method = $_SERVER['REQUEST_METHOD'];
            $overrideMethod = $_POST['_method'] ?? null;
            $controller = new ObservationController();

            if ($method === 'GET') {
                $controller->showStudent();
            } elseif ($method === 'POST') {
                $controller->handle($overrideMethod);
            } else {
                http_response_code(405);
            }
            break;
        case '/siswa/penilaian':
            $method = $_SERVER['REQUEST_METHOD'];
            $overrideMethod = $_POST['_method'] ?? null;
            $controller = new EvaluationController();

            if ($method === 'GET') {
                $controller->show2();
            } elseif ($method === 'POST') {
                $controller->handle($overrideMethod);
            } else {
                http_response_code(405);
            }
            break;
            // case '/admin/detail-kelompok':
            //     $method = $_SERVER['REQUEST_METHOD'];
            //     $overrideMethod = $_POST['_method'] ?? null;
            //     $controller = new GroupController();

            //     if ($method === 'POST') {
            //         $controller->handle($overrideMethod);
            //     } else {
            //         http_response_code(405);
            //     }
            //     break;
        default:
            http_response_code(404);
            echo "Page Not Found1";
            break;
    }
}
