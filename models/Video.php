<?php
include_once "models/DB.php";

class Video extends DB {
    public $id;
    public $name;
    public $imagenUrl;
    public $videoUrl;
    public $postDate;

    public static function all()
    {
        $db = new DB();
        $prepare = $db->prepare("SELECT * FROM Video");
        $prepare->execute();
        return $prepare->fetchAll(PDO::FETCH_CLASS, Video::class);
    }

    public static function find($id)
    {
        $db = new DB();
        $prepare = $db->prepare("SELECT * FROM Video WHERE id=:id");
        $prepare->execute([":id" => $id]);
        return $prepare->fetchObject(Video::class);
    }

}