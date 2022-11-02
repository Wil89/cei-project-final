<?php
include_once "models/DB.php";

// Solo se usa para asociar a un comentario
// por tal razon no tiene password u otros campos
class User extends DB
{
    public $id;
    public $userName;
    public $email;

    // Consulta para mostrar todos los usuarios, 
    // se usa para no repetir usuarios
    public static function all()
    {
        $db = new DB();
        $prepare = $db->prepare("SELECT * FROM User");
        $prepare->execute();
        return $prepare->fetchAll(PDO::FETCH_CLASS, User::class);
    }

    // Consulta para crear un nuevo usuario,
    public function create()
    {
        $params = [
            ":userName" => $this->userName,
            ":email" => $this->email
        ];

        $prepare = $this->prepare("INSERT INTO User(userName, email) VALUES(:userName, :email)");
        $prepare->execute($params);
        $prepare2 = $this->prepare("SELECT MAX(id) id FROM User");
        $prepare2->execute();
        $this->id = $prepare2->fetch(PDO::FETCH_ASSOC)["id"];
    }
}
