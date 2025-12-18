<?php

require_once __DIR__ . '/../Pedido.php';
require_once __DIR__ . '/../../database/database.php';

class PedidoDAO
{
    public static function obtenerLineasCarrito(int $idUsuario): array
    {
        $con = DataBase::connect();

        $sql = "SELECT lp.*, p.nombre, p.categoria, p.precio_unidad, p.imagen
                FROM lineapedido lp
                INNER JOIN producto p ON lp.id_producto = p.id_producto
                WHERE lp.id_pedido IS NULL AND lp.id_usuario = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("i", $idUsuario);
        $stmt->execute();

        $result = $stmt->get_result();
        $lineas = $result->fetch_all(MYSQLI_ASSOC);

        $stmt->close();
        $con->close();

        return $lineas;
    }
}

