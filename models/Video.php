<?php

class Video extends DB {
    public $id;
    public $name;
    public $imagenUrl;
    public $videoUrl;
    public $postDate;

    public static function all()
    {
        $db = new DB();
        $prepare = $db->prepare("SELECT * FROM video");
        $prepare->execute();
        return $prepare->fetchAll(PDO::FETCH_CLASS, Video::class);
    }

}