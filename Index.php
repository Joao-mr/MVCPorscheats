<?php
    require_once 'database/database.php';

    $con = DataBase::connect();
    if($con){
        echo "Conexión correcta a la base de datos 'porscheats'";
    }else{
        echo "Error en la conexión a la base de datos 'porscheats'";
}

?>