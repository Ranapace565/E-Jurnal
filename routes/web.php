<?php
// auth
require_once __DIR__ . '/../app/middleware/AksesMiddleware.php';

// Mendapatkan URI yang diminta
$requestUri = $_SERVER['REQUEST_URI'];
$parsedUrl = parse_url($requestUri);
$path = $parsedUrl['path'];
$queryParams = [];
parse_str($parsedUrl['query'] ?? '', $queryParams);

header('Content-Type: text/html');

// Load route admin
require_once __DIR__ . '/../app/routes/adminRoutes.php';
require_once __DIR__ . '/../app/routes/dudiRoutes.php';
require_once __DIR__ . '/../app/routes/mentorRoutes.php';
require_once __DIR__ . '/../app/routes/studentRoutes.php';
require_once __DIR__ . '/../app/routes/loginRoutes.php';
require_once __DIR__ . '/../app/routes/mentorRoutes.php';
// require_once __DIR__ . '/../app/routes/DudiRoutes.php';
require_once __DIR__ . '/../app/routes/landingpageRoutes.php';

switch (true) {

    case preg_match('#^/$#', $path):
        // Redirect ke /login
        header('Location: /login');
        break;
    case preg_match('#^/login#', $path):
        handleLoginRoutes($path, $queryParams);
        break;
    case preg_match('#^/admin#', $path):

        AuthMiddleware::checkAuth('admin');
        handleAdminRoutes($path, $queryParams);
        break;
    case preg_match('#^/dudi#', $path):

        AuthMiddleware::checkAuth('dudi');
        handleDudiRoutes($path, $queryParams);
        break;
    case preg_match('#^/pembimbing#', $path):

        AuthMiddleware::checkAuth('mentor');
        handleMentorRoutes($path, $queryParams);
        break;
    case preg_match('#^/siswa#', $path):

        AuthMiddleware::checkAuth('siswa');
        handleStudentRoutes($path, $queryParams);
        break;
    default:
        http_response_code(404);
        echo "Page Not Found";
        break;
}
