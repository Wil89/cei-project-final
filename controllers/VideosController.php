<?php

include_once "models/Video.php";
include_once "models/User.php";
class VideosController
{
    // Controller para la ruta /videos
    // donde se mostraran todos los videos
    public function index()
    {
        $videos = Video::all();
        view("videos.index", ["videos" => $videos]);
    }

    // Controller para filtrar los videos por nombre
    // y actualizar la vista /videos
    public function search()
    {   
        $filter = json_decode(file_get_contents("php://input"));
        $videos = Video::search($filter->filter);
        return view("videos.index", ["videos" => $videos]);
    }

    // Controller para la ruta /videos/{id}
    // Mostrar los detalles de un video, sus comentarios 
    // Se cargan los usuarios para asociarlos a los comentarios
    public function details($id)
    {
        $video = Video::find($id);
        $users = User::all();
        view("videos.details", ["video" => $video, "users"=> $users]);
    }

    // Controller para crear un nuevo video si este no existe
    public function create()
    {
        // parsear la data del post
        $data = json_decode(file_get_contents("php://input"));
        if (!$data) {
            // Bad Request
            http_response_code(400);
            exit;
        }

        // Evitar videos repetidos
        $videos = Video::all();
        foreach ($videos as $video) {
            if ($video->videoUrl == $data->videoUrl) {
                http_response_code(400);
                exit;
            }
        }

        $video = new Video();
        $video->name = $data->name;
        $video->videoUrl = $data->videoUrl;
        $video->postDate = $data->postDate;
        $video->save();
        $response = $video;
        echo json_encode($response);
    }

    // Controller para eliminar un video, actualmente no se usa esta funcionalidad
    public function delete($id)
    {
        $video = Video::find($id);
        if (!$video) {
            http_response_code(400);
            exit;
        }
        $video[0]->remove();
        $response = "Video eliminado";
        echo json_encode($response);
    }
}
