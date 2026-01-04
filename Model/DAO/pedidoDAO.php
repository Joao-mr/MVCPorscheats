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

        $stmt->execute();

        // Devolvemos el ID autogenerado para poder enlazarlo después con sus líneas de pedido.
        $idPedido = $stmt->insert_id;

        $stmt->close();
        $con->close();

        // Este ID se usará justo tras crear el pedido para insertar cada línea en lineapedido con ese id_pedido.
        return $idPedido;
    }
}

