<?php
include_once "models/DB.php";

class Video extends DB
{
    public $videoId;
    public $name;
    public $videoUrl;
    public $postDate;

    public static function all()
    {
        $db = new DB();
        $consulta = "SELECT * FROM Video";
        $prepare = $db->prepare($consulta);
        $prepare->execute();
        return $prepare->fetchAll(PDO::FETCH_CLASS, Video::class);
    }

    public static function search($filter) {
        $db = new DB();
        $prepare = $db->prepare("SELECT * FROM Video WHERE name LIKE '%$filter%'");
        $prepare->execute();
        return $prepare->fetchAll(PDO::FETCH_CLASS, Video::class);
    }

    public static function find($id)
    {
        $db = new DB();
        $prepare = $db->prepare("SELECT * FROM Video AS v LEFT JOIN Comment AS c ON v.videoId = c.Video_id LEFT JOIN User as u ON c.User_id = u.id WHERE v.videoId=:id");
        $prepare->execute([":id" => $id]);
        return $prepare->fetchAll(PDO::FETCH_CLASS, Video::class);
    }

    public function save()
    {
        $params = [
            ":name" => $this->name,
            ":postDate" => $this->postDate,
            ":videoUrl" => $this->videoUrl,
        ];
        // Si no esta presente el id, es que estamos creando un nuevo video
        if (empty($this->id)) {
            $prepare = $this->prepare("INSERT INTO Video(name, videoUrl, postDate) VALUES (:name, :videoUrl, :postDate)");
            $prepare->execute($params);
            $prepare2 = $this->prepare("SELECT MAX(id) id FROM Video");
            $prepare2->execute();
            $this->id = $prepare2->fetch(PDO::FETCH_ASSOC)["id"];
        } else {
            //  Si esta presente el id, entonces es un update
            $params[":id"] = $this->id;
            $prepare = $this->prepare("UPDATE Video SET name=:name, videoUrl=:videoUrl, postDate=:postDate WHERE id=:id");
            $prepare->execute($params);
        }
    }

    public function remove()
    {
        $prepare = $this->prepare("DELETE FROM Video WHERE id=:id");
        $prepare->execute([":id" => $this->id]);
    }
}
