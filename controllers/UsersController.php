<?php
include_once "models/User.php";

class UsersController
{
    public function index()
    {
        $users = User::all();
        echo json_encode($users);
    }

    public function details($id)
    {
        $user = user::find($id);
        echo json_encode($user);
    }

    public function create()
    {
        // parsear la data del post
        $data = json_decode(file_get_contents("php://input"));
        if (!$data) {
            // Bad Request
            http_response_code(400);
            exit;
        }
        $user = new User();
        $user->userName = $data->userName;
        $user->email = $data->email;
        // Evitar guardar el password literal en la db
        // $user->password = password_hash($data->password, PASSWORD_DEFAULT);
        $user->create();
        $response = $user;
        echo json_encode($response);
    }
}