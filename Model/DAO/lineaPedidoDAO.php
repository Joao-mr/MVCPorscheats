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
        $idPedido = $linea->getId_pedido();
        $idProducto = $linea->getId_producto();
        $cantidad = $linea->getCantidad();
        $precioUnidad = $linea->getPrecio_unidad();
        $porcentaje = $linea->getPorcentaje_descuento();
        $precioFinal = $linea->getPrecio_final_unidad();
        $subtotal = $linea->getSubtotal();

        $stmt->bind_param(
            'iiddidd',
            $idPedido,
            $idProducto,
            $cantidad,
            $precioUnidad,
            $porcentaje,
            $precioFinal,
            $subtotal
        );

        // Ejecutamos la consulta.
        if (!$stmt->execute()) {
            $error = $stmt->error;
            $stmt->close();
            $con->close();
            throw new RuntimeException('Error al insertar línea de pedido: ' . $error);
        }

        $idInsertado = $stmt->insert_id;
        $stmt->close();
        $con->close();

        return $idInsertado;
    }
}