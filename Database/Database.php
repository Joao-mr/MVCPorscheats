<?php
    class database {
        public static function connect($host='localhost', $user='root', $db='porscheats', $pass='root') {
            $con = new mysqli($host, $user, $pass, $db);

            if ($con->connect_error) {
                die("Error al conectar con la base de datos: " . $con->connect_error);
            }

            return $con;
        }
    }
?>