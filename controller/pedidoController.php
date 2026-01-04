<?php
require_once __DIR__ . '/../model/DAO/pedidoDAO.php';
require_once __DIR__ . '/../model/DAO/lineaPedidoDAO.php';
require_once __DIR__ . '/../model/Pedido.php';
require_once __DIR__ . '/../model/LineaPedido.php';

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

    public function confirmar(): void
    {
        header('Content-Type: application/json');

        // Aseguramos que la sesión esté iniciada para recuperar al usuario logueado.
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Validamos que exista un usuario autenticado en la sesión.
        $idUsuario = $_SESSION['usuario']['id'] ?? null;
        if (!$idUsuario) {
            echo json_encode(['status' => 'error', 'message' => 'Usuario no autenticado.']);
            return;
        }

        // Leemos el cuerpo raw del POST (JSON) y lo convertimos a array.
        $payload = json_decode(file_get_contents('php://input'), true);
        if (!is_array($payload) || empty($payload['carrito'])) {
            echo json_encode(['status' => 'error', 'message' => 'Carrito vacío o datos inválidos.']);
            return;
        }

        try {
            // Construimos el objeto Pedido con los datos mínimos.
            $pedido = new Pedido();
            $pedido->setId_usuario($idUsuario);
            $pedido->setId_oferta($payload['id_oferta'] ?? null);
            $pedido->setFecha_pedido(date('Y-m-d H:i:s'));
            $pedido->setMetodo_pago($payload['metodo_pago'] ?? 'tarjeta');
            $pedido->setDireccion_entrega($payload['direccion_entrega'] ?? 'Por definir');
            $pedido->setEstado('pendiente');
            $pedido->setImporte_total($payload['subtotal'] ?? 0);

            // Guardamos el pedido y guardamos el ID generado para enlazar las líneas.
            $idPedido = PedidoDAO::crearPedido($pedido);

            // Recorremos cada producto del carrito para convertirlo en LineaPedido.
            foreach ($payload['carrito'] as $producto) {
                $linea = new LineaPedido();
                $linea->setId_pedido($idPedido);
                $linea->setId_producto($producto['id']);
                $linea->setCantidad($producto['cantidad']);
                $linea->setPrecio_unidad($producto['precio']);
                $linea->setPorcentaje_descuento($producto['descuento'] ?? 0);
                $precioFinal = $producto['precio'] * (1 - (($producto['descuento'] ?? 0) / 100));
                $linea->setPrecio_final_unidad($precioFinal);
                $linea->setSubtotal($precioFinal * $producto['cantidad']);

                // Insertamos cada línea para que queden vinculadas al pedido confirmado.
                LineaPedidoDAO::insertarLineaPedido($linea);
            }

            // Respondemos al frontend con un estado simple.
            echo json_encode(['status' => 'ok', 'idPedido' => $idPedido]);
        } catch (Throwable $e) {
            // Si algo falla, devolvemos un error genérico para que el frontend lo maneje.
            error_log($e->getMessage());
            echo json_encode(['status' => 'error', 'message' => '']);
        }
    }

    public function confirmarVista(): void
    {
        $view = __DIR__ . '/../view/pedido/confirmar.php';
        $pageTitle = 'Confirmar pedido | Porscheats';
        $navClass = 'estilo_negro';

        if (!is_readable($view)) {
            throw new RuntimeException('No se encuentra la vista de confirmación.');
        }

        require __DIR__ . '/../view/main.php';
    }
}