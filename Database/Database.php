<?php
class Database
{
    /**
     * Crea y devuelve una conexión MySQLi lista para usarse.
     * Lanza un error fatal si la conexión falla.
     */
    public static function connect(
        string $host = 'localhost',
        string $user = 'root',
        string $db   = 'porscheats',
        string $pass = 'root'
    ): mysqli {
        $con = new mysqli($host, $user, $pass, $db);

        if ($con->connect_error) {
            die('Error al conectar con la base de datos: ' . $con->connect_error);
        }

        return $con;
    }
}