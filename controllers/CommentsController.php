<?php
include_once "models/Comment.php";

class CommentsController
{
    public function create()
    {
        // parsear la data del post
        $data = json_decode(file_get_contents("php://input"));
        var_dump($data);
        if (!$data) {
            // Bad Request
            http_response_code(400);
            exit;
        }
        $comment = new Comment();
        $comment->comment = $data->comment;
        $comment->date = $data->date;
        $comment->voteUp = $data->voteUp;
        $comment->voteDown = $data->voteDown;
        $comment->Video_id = $data->videoId;
        $comment->User_id = $data->userId;
        $comment->save();
        $response = $comment;
        echo json_encode($response);
    }
}
