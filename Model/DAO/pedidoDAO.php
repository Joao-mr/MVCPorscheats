<?php

require_once __DIR__ . '/../Pedido.php';
require_once __DIR__ . '/../../database/database.php';

class PedidoDAO
{
    
    public static function crearPedido(Pedido $pedido): int
    {
        $con = DataBase::connect();

        $sql = 'INSERT INTO pedido 
                (id_usuario, id_oferta, fecha_pedido, metodo_pago, direccion_entrega, estado, importe_total)
                VALUES (?, ?, ?, ?, ?, ?, ?)';

        $stmt = $con->prepare($sql);
        $stmt->bind_param(
            'iissssd',
            $pedido->getId_usuario(),
            $pedido->getId_oferta(),
            $pedido->getFecha_pedido(),
            $pedido->getMetodo_pago(),
            $pedido->getDireccion_entrega(),
            $pedido->getEstado(),
            $pedido->getImporte_total()
        );

        if (!$stmt->execute()) {
            $error = $stmt->error;
            $stmt->close();
            $con->close();
            throw new RuntimeException('Error al crear pedido: ' . $error);
        }

        $idPedido = $stmt->insert_id;

        $stmt->close();
        $con->close();

        // Este ID se usará justo tras crear el pedido para insertar cada línea en lineapedido con ese id_pedido.
        return $idPedido;
    }

    /**
     * Devuelve todos los pedidos de un usuario ordenados del más reciente al más antiguo.
     */
    public static function obtenerPedidosPorUsuario(int $idUsuario): array
    {
        $con = DataBase::connect();

        $sql = 'SELECT id_pedido, fecha_pedido, estado, importe_total
                FROM pedido
                WHERE id_usuario = ?
                ORDER BY fecha_pedido DESC';

        $stmt = $con->prepare($sql);
        $stmt->bind_param('i', $idUsuario);
        $stmt->execute();

        $resultado = $stmt->get_result();
        $pedidos = $resultado->fetch_all(MYSQLI_ASSOC);

        $stmt->close();
        $con->close();

        return $pedidos;
    }

    /**
     * Devuelve todos los pedidos ordenados del más reciente al más antiguo.
     */
    public static function obtenerTodos(): array
    {
        $con = DataBase::connect();
        $sql = 'SELECT * FROM pedido ORDER BY fecha_pedido DESC';
        $stmt = $con->prepare($sql);
        $stmt->execute();

        $resultado = $stmt->get_result();
        $pedidos = $resultado->fetch_all(MYSQLI_ASSOC);

        $stmt->close();
        $con->close();

        return $pedidos;
    }

    public static function updateEstado(int $idPedido, string $estado): bool
    {
        $con = DataBase::connect();

        $sql = "UPDATE pedido SET estado = ? WHERE id_pedido = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param('si', $estado, $idPedido);

        $ok = $stmt->execute();

        $stmt->close();
        $con->close();

        return $ok;
    }

}

