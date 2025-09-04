<?php

namespace models\database;

use PDO;
use PDOException;

abstract class Database
{
    public function connection(){
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "media_library";

        try {
            $connexion = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $connexion;
        }catch (PDOException $e){
            die("Connection failed: " . $e->getMessage());
        }
    }
}