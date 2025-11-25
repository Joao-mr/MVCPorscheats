<?php
    require_once 'database/database.php';

    $con = database::connect();
    if($con){
        echo "Conexión correcta a la base de datos 'porscheats'";
    }else{
        echo "Error en la conexión a la base de datos 'porscheats'";
}

?>