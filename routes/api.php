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
        
    // Inside your routing logic, modify the case for GET request
case (preg_match('/^\/api\/user\/checkUsername\/([^\/]+)$/', $requestUri, $matches) ? true : false):
    require_once __DIR__ . '/../app/api/LoginController.php';
    $loginController = new LoginController();
    $username = $matches[1];  // Get the username from the URL
    $loginController->checkUsername($username);  // Call the checkUsername method with the username
    break;

    
    case (preg_match('/\/api\/student\/getDudi\/(\d+)/', $requestUri, $matches) ? true : false):
    require_once __DIR__ . '/../app/api/StudentController.php';
    $studentController = new StudentController();
    $studentController->studentRoute();  // Pastikan menggunakan metode dengan huruf kapital yang tepat
    break;
    
// Route for GET /api/student/fotoProfile/{user_id}
case (preg_match('/^\/api\/student\/fotoProfile\/(\d+)$/', $requestUri, $matches) ? true : false):
    require_once __DIR__ . '/../app/api/StudentController.php';
    $studentController = new StudentController();
    $user_id = $matches[1];
    $studentController->studentRoute();
    break;
    
    // Route for GET /api/student/fotoProfile/{user_id}
case (preg_match('/^\/api\/student\/getProfile\/(\d+)$/', $requestUri, $matches) ? true : false):
    require_once __DIR__ . '/../app/api/StudentController.php';
    $studentController = new StudentController();
    $user_id = $matches[1];
    $studentController->studentRoute();
    break;



case (preg_match('/\/api\/student\/update\/(\d+)/', $requestUri, $matches) ? true : false):
    require_once __DIR__ . '/../app/api/StudentController.php';
    $studentController = new StudentController();
    $studentController->studentRoute();  // Pastikan menggunakan metode dengan huruf kapital yang tepat
    break;
    
    case (preg_match('/^\/api\/activity\/getJumlah\/(\d+)/', $requestUri, $matches) ? true : false):
        require_once __DIR__ . '/../app/api/ActivityController1.php';
        $activityController = new ActivityController();
        $nis = $matches[1];
        $activityController->getJumlahActivity($nis);
        break;


case (preg_match('/^\/api\/activity\/mobile(\?.*)?$/', $requestUri) ? true : false):
    require_once __DIR__ . '/../app/api/ActivityController1.php';
    $activityController = new ActivityController();
    $activityController->activityroute();
    break;
    
     case (preg_match('/^\/api\/activity\/save(\?.*)?$/', $requestUri) ? true : false):
        require_once __DIR__ . '/../app/api/ActivityController1.php';
        $activityController = new ActivityController();
        $activityController->activityroute();
        break;
        
        case (preg_match('/\/api\/activity\/updateActivity\/(\d+)/', $requestUri, $matches) ? true : false):
        require_once __DIR__ . '/../app/api/ActivityController1.php';
        $activityController = new ActivityController();
        $nis = $matches[1];
        $activityController->updateActivity($nis); // Call the method to handle PUT request
        break;

    // case '/api/activity/':
    // case '/api/activities':
    
    // case (preg_match('/\/api\/activity\/(\d+)/', $requestUri, $matches) ? true : false):
    // case (preg_match('/\/api\/activity\/delete\/(\d+)/', $requestUri, $matches) ? true : false):
    // case (preg_match('/\/api\/activity\/update\/(\d+)/', $requestUri, $matches) ? true : false):
    //     require_once __DIR__ . '/../app/api/ActivityController.php';
    //     $activityController = new ActivityController();
    //     $activityController->activityroute();
    //     break;

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
