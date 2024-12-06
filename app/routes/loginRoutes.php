<?php

require_once __DIR__ . '/../controllers/UserController.php';

function handleLoginRoutes($path, $queryParams)
{
    switch ($path) {
        case '/login':
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

        default:
            http_response_code(404);
            echo "Metode tidak diizinkan.";
            break;
    }
}
