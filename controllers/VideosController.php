<?php

include_once "models/Video.php";
include_once "models/User.php";
class VideosController
{
    public function index()
    {
        $videos = Video::all();
        view("videos.index", ["videos" => $videos]);
    }

    public function search()
    {   
        $filter = json_decode(file_get_contents("php://input"));
        $videos = Video::search($filter->filter);
        return view("videos.index", ["videos" => $videos]);
    }

    public function details($id)
    {
        $video = Video::find($id);
        $users = User::all();
        view("videos.details", ["video" => $video, "users"=> $users]);
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
