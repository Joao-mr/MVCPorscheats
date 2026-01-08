<?php

require_once __DIR__ . '/../LineaPedido.php';
require_once __DIR__ . '/../../database/database.php';

/**
 * DAO para operaciones sobre la tabla lineapedido.
 */
class LineaPedidoDAO
{
    /**
     * Inserta una línea de pedido y devuelve el ID generado.
     */
    public static function insertarLineaPedido(LineaPedido $linea): int
    {
        $con = DataBase::connect(); // Conexión a la base de datos

        $sql = 'INSERT INTO lineapedido 
                (id_pedido, id_producto, cantidad, precio_unidad, porcentaje_descuento, precio_final_unidad, subtotal)
                VALUES (?, ?, ?, ?, ?, ?, ?)';

        $stmt = $con->prepare($sql); // Prepara sentencia segura
        $idPedido = $linea->getId_pedido();
        $idProducto = $linea->getId_producto();
        $cantidad = $linea->getCantidad();
        $precioUnidad = $linea->getPrecio_unidad();
        $porcentaje = $linea->getPorcentaje_descuento();
        $precioFinal = $linea->getPrecio_final_unidad();
        $subtotal = $linea->getSubtotal();

        // Vincula cada valor con su tipo correspondiente
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

        if (!$stmt->execute()) {
            $error = $stmt->error; // Guarda el mensaje antes de cerrar
            $stmt->close();
            $con->close();
            throw new RuntimeException('Error al insertar línea de pedido: ' . $error);
        }

        $idInsertado = $stmt->insert_id; // ID autogenerado de la fila creada
        $stmt->close();
        $con->close();

        return $idInsertado;
    }
}