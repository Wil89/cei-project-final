<?php

include_once "models/Video.php";

class VideosController
{
    public function index()
    {
        $videos = Video::all();
        echo json_encode($videos);
    }

    public function find($id)
    {
        $video = Video::find($id);
        echo json_encode($video);
    }
}