<?php

// require_once __DIR__ . '/../controllers/LandingpageController.php';

// function handleLandingpageRoutes($path, $queryParams)
// {
//     switch ($path) {
//         case '/landingpage':
//             $method = $_SERVER['REQUEST_METHOD'];
//             $overrideMethod = $_POST['_method'] ?? null;
//             $controller = new LandingpageController();

//             if ($method === 'GET') {
//                 $controller->index($queryParams);
//             } elseif ($method === 'POST') {
//             } else {
//                 http_response_code(405);
//             }
//             break;

//         default:
//             http_response_code(404);
//             echo "Metode landingpage tidak diizinkan.";
//             break;
//     }
// }
