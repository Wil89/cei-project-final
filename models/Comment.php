<?php
include_once "models/DB.php";

class Comment extends DB
{
    public $id;
    public $comment;
    public $date;
    public $voteUp;
    public $voteDown;
    public $Video_id;
    public $User_id;

    // Search all comments by video id
    public static function all($videoId)
    {
        $db = new DB();
        // $prepare = $db->prepare("SELECT * FROM Comment AS c LEFT JOIN Video AS v ON c.Video_id=v.id WHERE c.Video_id NOT NULL");
        $prepare = $db->prepare("SELECT * FROM Comments WHERE Video_id=:videoId");
        $prepare->execute([":videoId" => $videoId]);
        return $prepare->fetchAll(PDO::FETCH_CLASS, Comment::class);
    }

    public static function find($id)
    {
        $db = new DB();
        $prepare = $db->prepare("SELECT * FROM Comment WHERE id=:id");
        $prepare->execute([":id" => $id]);
        return $prepare->fetchObject(Comment::class);
    }

    public function remove()
    {
        $prepare=$this->prepare("DELETE FROM Comment WHERE id=:id");
        $prepare->execute([":id" => $this->id]);
    }

    public function save()
    {
        $params = [
            ":comment"=> $this->comment, 
            ":date" => $this->date, 
            ":voteUp" => $this->voteUp,
            ":voteDown" => $this->voteDown,
            ":Video_id" => $this->videoId,
            ":User_id" => $this->userId
        ];
        // Si no esta presente el id, es que estamos creando un nuevo commentario
        if (empty($this->id)) {
            $prepare = $this->prepare("INSERT INTO Comment(comment, date, voteUp, voteDown, Video_id, User_id) VALUES (:comment, :date, :voteUp, :voteDown, :Video_id, :User_id)");
            $prepare->execute($params);
            $prepare2 = $this->prepare("SELECT MAX(id) id FROM Comment");
            $prepare2->execute();
            $this->id = $prepare2->fetch(PDO::FETCH_ASSOC)["id"];
        } else {
            //  Si esta presente el id, entonces es un update
            $params[":id"] = $this->id;
            $prepare = $this->prepare("UPDATE Comment SET comment=:comment, date=:date, voteUp=:voteUp, voteDown=:voteDown, Video_id=:Video_id, User_id=:User_id  WHERE id=:id");
            $prepare->execute($params);
        } 
    }

}
