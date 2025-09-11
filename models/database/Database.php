<?php

namespace models\database;

use PDO;
use PDOException;

abstract class Database
{
    public static function connection(){
        $servername = "localhost";
        $username = "root";
        $password = "root";
        $dbname = "media_library";

        try {
            $connection = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $connection;
        }catch (PDOException $e){
            die("Connection failed: " . $e->getMessage());
        }
    }
}