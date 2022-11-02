<?php
include_once "models/DB.php";

class User extends DB
{
    public $id;
    public $userName;
    public $password;
    public $email;

    public static function all()
    {
        $db = new DB();
        $prepare = $db->prepare("SELECT * FROM User");
        $prepare->execute();
        return $prepare->fetchAll(PDO::FETCH_CLASS, User::class);
    }

    public function create()
    {
        $params = [
            ":userName" => $this->userName,
            "password" => $this->password,
            ":email" => $this->email
        ];

        $prepare = $this->prepare("INSERT INTO User(userName, password, email) VALUES(:userName, :password, :email)");
        $prepare->execute($params);
        $prepare2 = $this->prepare("SELECT MAX(id) id FROM User");
        $prepare2->execute();
        $this->id = $prepare2->fetch(PDO::FETCH_ASSOC)["id"];
    }
}
