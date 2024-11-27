<?php

require_once __DIR__ . '/../controllers/AdminController.php';
require_once __DIR__ . '/../controllers/StudentController.php';
require_once __DIR__ . '/../controllers/DUDIController.php';
require_once __DIR__ . '/../controllers/MentorController.php';
require_once __DIR__ . '/../controllers/GroupController.php';

function handleAdminRoutes($path, $queryParams)
{
    switch ($path) {
        case '/admin/data-siswa':
            $method = $_SERVER['REQUEST_METHOD'];
            $overrideMethod = $_POST['_method'] ?? null;
            $controller = new StudentController();

            if ($method === 'GET') {
                $controller->index($queryParams);
            } elseif ($method === 'POST') {
                $controller->handle($overrideMethod);
            } else {
                http_response_code(405);
            }
            break;
        case '/admin/data-dudi':
            $method = $_SERVER['REQUEST_METHOD'];
            $overrideMethod = $_POST['_method'] ?? null;
            $controller = new DudiController();

            if ($method === 'GET') {
                $controller->index($queryParams);
            } elseif ($method === 'POST') {
                $controller->handle($overrideMethod);
            } else {
                http_response_code(405);
            }
            break;
        case '/admin/data-mentor':
            $method = $_SERVER['REQUEST_METHOD'];
            $overrideMethod = $_POST['_method'] ?? null;
            $controller = new MentorController();

            if ($method === 'GET') {
                $controller->index($queryParams);
            } elseif ($method === 'POST') {
                $controller->handle($overrideMethod);
            } else {
                http_response_code(405);
            }
            break;
        case '/admin/data-kelompok':
            $method = $_SERVER['REQUEST_METHOD'];
            $overrideMethod = $_POST['_method'] ?? null;
            $controller = new GroupController();

            if ($method === 'GET') {
                $controller->index($queryParams);
            } elseif ($method === 'POST') {
                $controller->handle($overrideMethod);
            } else {
                http_response_code(405);
            }
            break;
        case '/admin/detail-kelompok':
            $method = $_SERVER['REQUEST_METHOD'];
            $overrideMethod = $_POST['_method'] ?? null;
            $controller = new GroupController();

            if ($method === 'POST') {
                $controller->handle($overrideMethod);
            } else {
                http_response_code(405);
            }
            break;
        default:
            http_response_code(404);
            echo "Page Not Found1";
            break;
    }
}
