<?php

// Clase para manejar la conexion con la BD
class DB extends PDO
{
    public function __construct()
    {
        $con = "mysql:host=bbdd.wilberulloa-cei.com;dbname=ddb192585";
        parent::__construct($con, "ddb192585", "Jarvis20507!");
    }
}
