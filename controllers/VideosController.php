<?php

include_once "models/Video.php";

class VideosController
{
    public function index()
    {
        $videos = Video::all();
        echo json_encode($videos);
    }

    public function details($id)
    {
        $video = Video::find($id);
        echo json_encode($video);
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
        $video = new Video();
        $video->name = $data->name;
        $video->imagenUrl = $data->imagenUrl;
        $video->videoUrl = $data->videoUrl;
        $video->postDate = $data->postDate;
        $video->save();
        $response = $video;
        echo json_encode($response);
    }

    public function update($id)
    {
        $data = json_decode(file_get_contents("php://input"));
        if (!$data) {
            // Bad Request
            http_response_code(400);
            exit;
        }
        $video = Video::find($id);
        if ($video) {
            $video->name = $data->name;
            $video->imagenUrl = $data->imagenUrl;
            $video->videoUrl = $data->videoUrl;
            $video->postDate = $data->postDate;
            $video->save();
            $response = $video;
            echo json_encode($response);
        } else {
            http_response_code(400);
            exit;
        }
    }

    public function delete($id) {
        $video = Video::find($id);
        if(!$video) {
            http_response_code(400);
            exit;
        }
        $video->remove();
        $response = "Video eliminado";
        echo json_encode($response);
    }
}
