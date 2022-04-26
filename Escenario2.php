<?php

class CConexion{

    function ConexionDb()
    {
        $host="localhost";
        $dbname="prueba";
        $username="postgres";
        $password="postgres";

        try {
            $conn=new PDO("pgsql:host= $host; dbname=$dbname", $username,  $password);
            echo("Se conecto a la base de datos");

        } catch (PDOException $exp) {
            echo("no se pudo conectar a la base de datos, $exp");
        }
        return $conn;
    }
}

?>