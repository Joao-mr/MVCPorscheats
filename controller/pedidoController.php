<?php
require_once __DIR__ . '/../model/DAO/pedidoDAO.php';

class PedidoController
{
    private PedidoDAO $pedidoDAO;

    public function __construct()
    {
        $this->pedidoDAO = new PedidoDAO();
    }

    public function carrito(): void
    {
        $view = __DIR__ . '/../view/pedido/carrito.php';
        $pageTitle = 'Carrito | Porscheats';
        $lineas = []; // $this->pedidoDAO->obtenerLineasCarrito($idUsuario);
        $navClass = 'estilo_negro';
        
        if (!is_readable($view)) {
            throw new RuntimeException('No se encuentra la vista de carrito.');
        }

        require __DIR__ . '/../view/main.php';
    }
}