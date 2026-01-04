<?php

require_once __DIR__ . '/../LineaPedido.php';
require_once __DIR__ . '/../../database/database.php';

class LineaPedidoDAO
{
    public static function insertarLineaPedido(LineaPedido $linea): int
    {
        // Obtenemos la conexión mysqli.
        $con = DataBase::connect();

        // Definimos el INSERT con placeholders.
        $sql = 'INSERT INTO lineapedido 
                (id_pedido, id_producto, cantidad, precio_unidad, porcentaje_descuento, precio_final_unidad, subtotal)
                VALUES (?, ?, ?, ?, ?, ?, ?)';

        // Preparamos el statement y vinculamos los parámetros.
        $stmt = $con->prepare($sql);
        $stmt->bind_param(
            'iiidddd',
            $linea->getId_pedido(),
            $linea->getId_producto(),
            $linea->getCantidad(),
            $linea->getPrecio_unidad(),
            $linea->getPorcentaje_descuento(),
            $linea->getPrecio_final_unidad(),
            $linea->getSubtotal()
        );

        // Ejecutamos la consulta.
        $stmt->execute();

        // Guardamos el ID generado y cerramos recursos.
        $idInsertado = $stmt->insert_id;
        $stmt->close();
        $con->close();

        return $idInsertado;
    }
}