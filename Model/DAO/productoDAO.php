<?php

require_once __DIR__ . '/../Producto.php';
require_once __DIR__ . '/../../database/database.php';


class ProductoDAO{
    public static function getProductoByID($id){
        $con = DataBase::connect();
        $stmmt = $con->prepare("SELECT * FROM producto WHERE id_producto = ?");
        $stmmt->bind_param("i", $id);
        $stmmt->execute();
        
        $results = $stmmt->get_result();
        $producto = $results->fetch_object('Producto');

        $con->close();
        return $producto;   
    }


     public static function getProductos(){
        $con = DataBase::connect();
        $stmmt = $con->prepare("SELECT * FROM producto");
        $stmmt->execute();
        
        $results = $stmmt->get_result();
        $listaProductos = [];
        
        while ($producto = $results->fetch_object('Producto')) {
            $listaProductos[] = $producto;
        }

        $con->close();
        return $listaProductos;
    }


}

?>