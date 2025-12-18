<?php
class Database
{
    public static function connect(
        string $host = 'localhost',
        string $user = 'root',
        string $db   = 'porscheats',
        string $pass = 'root'
    ) {
        $con = new mysqli($host, $user, $pass, $db);

        if ($con->connect_error) {
            die('Error al conectar con la base de datos: ' . $con->connect_error);
        }

        return $con;
    }
}
?>