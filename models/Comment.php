<?php
include_once "models/DB.php";

class Comment extends DB
{
    public $id;
    public $comment;
    public $date;
    public $Video_id;
    public $User_id;

    // Consulta para crear un nuevo comentario o editar uno existente,
    // actualmente no se esta usando la opcion de editar
    public function save()
    {
        $params = [
            ":comment"=> $this->comment, 
            ":date" => $this->date, 
            ":Video_id" => $this->Video_id,
            ":User_id" => $this->User_id
        ];
        // Si no esta presente el id, es que estamos creando un nuevo commentario
        if (empty($this->id)) {
            $prepare = $this->prepare("INSERT INTO Comment(comment, date, Video_id, User_id) VALUES (:comment, :date, :Video_id, :User_id)");
            $prepare->execute($params);
            $prepare2 = $this->prepare("SELECT MAX(id) id FROM Comment");
            $prepare2->execute();
            $this->id = $prepare2->fetch(PDO::FETCH_ASSOC)["id"];
        } else {
            //  Si esta presente el id, entonces es un update
            $params[":id"] = $this->id;
            $prepare = $this->prepare("UPDATE Comment SET comment=:comment, date=:date, Video_id=:Video_id, User_id=:User_id  WHERE id=:id");
            $prepare->execute($params);
        } 
    }

}
