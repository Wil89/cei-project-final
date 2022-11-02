<?php
include_once "models/User.php";

class UsersController
{
    // Controller para crear un nuevo usuario si este no existe   
    public function create()
    {
        // parsear la data del post
        $data = json_decode(file_get_contents("php://input"));
        if (!$data) {
            // Bad Request
            http_response_code(400);
            exit;
        }

        $users = User::all();
        // Si el usuario exite no crearlo de nuevo
        foreach($users as $user) {
            if($user->email == $data->email) {
                return json_encode($user);
            }
        }

        $user = new User();
        $user->userName = $data->userName;
        $user->email = $data->email;
        $user->create();
        $response = $user;
        return json_encode($response);
    }
}