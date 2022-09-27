<?php

class DB extends PDO
{
    public function __construct()
    {
        $con = "mysql:host=localhost;dbname=videos";
        parent::__construct($con, "root", "");
    }
}
