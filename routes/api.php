<?php
// api route
$requestMethod = $_SERVER['REQUEST_METHOD'];
$requestUri = $_SERVER['REQUEST_URI'];
switch ($requestUri) {
    case '/api/login':

        require_once __DIR__ . '/../app/api/LoginController.php';

        $loginController = new LoginController();
        $loginController->loginroute();
        break;

    case '/api/user/password':


        require_once __DIR__ . '/../app/api/LoginController.php';
        $loginController = new LoginController();
        $loginController->loginroute();
        break;

    case '/api/user/logout':


        require_once __DIR__ . '/../app/api/LoginController.php';
        $loginController = new LoginController();
        $loginController->loginroute();
        break;

    case (preg_match('/\/api\/student\/(\d+)/', $requestUri, $matches) ? true : false):


        // require_once __DIR__ . '/../app/api/StudentController.php';
        // $studentController = new StudentController();
        // $studentController->studentroute();
        // break;

    case (preg_match('/\/api\/student\/update\/(\d+)/', $requestUri, $matches) ? true : false):


        require_once __DIR__ . '/../app/api/StudentController.php';
        $studentController = new StudentController();
        $studentController->studentroute();
        break;

    case '/api/activity':
    case '/api/activities':
    case (preg_match('/\/api\/activity\/(\d+)/', $requestUri, $matches) ? true : false):
    case (preg_match('/\/api\/activity\/delete\/(\d+)/', $requestUri, $matches) ? true : false):
    case (preg_match('/\/api\/activity\/update\/(\d+)/', $requestUri, $matches) ? true : false):
        require_once __DIR__ . '/../app/api/ActivityController.php';
        $activityController = new ActivityController();
        $activityController->activityroute();
        break;

    case '/api/student/observation':

        require_once __DIR__ . '/../app/api/ObservationController.php';
        $observation = new ObservationController();
        $observation->observationroute();
        break;

    default:
        echo json_encode(["error-route" => "Route Not found :( "]);
        break;
}

// if ($requestUri == '/api/login') {
//     echo "aprianto";
//     require_once __DIR__ . '/../app/api/LoginController.php';

//     $loginController = new LoginController();
//     $loginController->loginroute();
// }
