<?php

require_once __DIR__ . '/Controllers/UserController.php';
require_once __DIR__ . '/Models/UsersModel.php';

header('Content-Type: application/json');

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode('/', $uri);

if ($uri[1] !== 'api_exercise') {
    http_response_code(404);
    exit();
}

$UC = new UserController;

$requestMethod = $_SERVER["REQUEST_METHOD"];

switch ($requestMethod) {
    case 'GET':
        if ($_SERVER["QUERY_STRING"] != '') {
            $query = explode('=', $_SERVER["QUERY_STRING"]);
            if ($query[0] == "id") {
                $user_id = $query[1];
                echo $UC->SelectById($user_id);
            } else {
                http_response_code(400);
            }
        } else {
            echo $UC->Select();
        }
        break;
     case 'POST':
        $input = (array) json_decode(file_get_contents('php://input'), TRUE);
        if (isset($input['name']) && isset($input['email']) && isset($input['birthday']) && isset($input['gender'])) {
            $user = new User;
            $user->name = $input['name'];
            $user->email = $input['email'];
            $user->birthday = $input['birthday'];
            $user->gender = $input['gender'];
            $UC->Create($user);
        } else {
            http_response_code(400);
        }
        
        break;
    case 'PUT':
        $input = (array) json_decode(file_get_contents('php://input'), TRUE);
        if (isset($input['id']) && isset($input['name']) && isset($input['email']) && isset($input['birthday']) && isset($input['gender'])) {
            $user = new User;
            $user->id = $input['id'];
            $user->name = $input['name'];
            $user->email = $input['email'];
            $user->birthday = $input['birthday'];
            $user->gender = $input['gender'];
            $UC->Update($user);
        } else {
            http_response_code(400);
        }

        break;

    case 'DELETE':
        if ($_SERVER["QUERY_STRING"] != '') {
            $query = explode('=', $_SERVER["QUERY_STRING"]);
            if ($query[0] == "id") {
                $user_id = $query[1];
                $UC->Delete($user_id);
            } else {
                http_response_code(400);
            }
            
        } else {
            http_response_code(400);
        }

        break;
    default:
        http_response_code(400);
        break;
}

?>