<?php
require_once __DIR__ . '/../model/DAO/pedidoDAO.php';
require_once __DIR__ . '/../model/DAO/lineaPedidoDAO.php';
require_once __DIR__ . '/../model/Pedido.php';
require_once __DIR__ . '/../model/LineaPedido.php';
require_once __DIR__ . '/../model/DAO/ofertaDAO.php';

/**
 * Controlador responsable del flujo completo de pedidos (carrito, confirmación y vistas asociadas).
 */
class PedidoController
{
    private PedidoDAO $pedidoDAO;

    public function __construct()
    {
        $this->pedidoDAO = new PedidoDAO();
    }

    /**
     * Muestra la vista del carrito de compra.
     */
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

    /**
     * Recibe el payload del carrito (AJAX) y registra el pedido con sus líneas.
     */
    public function confirmar(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!ob_get_level()) {
            ob_start();
        }

        header('Content-Type: application/json; charset=utf-8');

        $idUsuario = $_SESSION['usuario']['id_usuario']
            ?? $_SESSION['usuario']['id']
            ?? null;

        if (!$idUsuario) {
            if (ob_get_level()) {
                ob_end_clean();
            }
            echo json_encode(['status' => 'login_required', 'message' => 'Usuario no autenticado.']);
            exit;
        }

        $payload = json_decode(file_get_contents('php://input'), true);
        if (!is_array($payload) || empty($payload['carrito'])) {
            if (ob_get_level()) {
                ob_end_clean();
            }
            echo json_encode(['status' => 'error', 'message' => 'Carrito vacío o datos inválidos.']);
            exit;
        }

        $totalProductos = 0;
        $subtotal = 0.0;

        foreach ($payload['carrito'] as $producto) {
            $cantidad = (int)($producto['cantidad'] ?? 0);
            $precio = (float)($producto['precio'] ?? 0);
            $totalProductos += $cantidad;
            $subtotal += $cantidad * $precio;
        }

        $resultadoOferta = OfertaDAO::calcularDescuento($totalProductos, $subtotal);

        try {
            // Construimos el objeto Pedido con los datos mínimos.
            $pedido = new Pedido();
            $pedido->setId_usuario($idUsuario);
            $pedido->setId_oferta($resultadoOferta['aplica'] ? 1 : null); // Ajusta si guardas el ID real
            $pedido->setImporte_total($resultadoOferta['total']);
            $pedido->setFecha_pedido(date('Y-m-d H:i:s'));
            $pedido->setMetodo_pago($payload['metodo_pago'] ?? 'tarjeta');
            $pedido->setDireccion_entrega($payload['direccion_entrega'] ?? 'Por definir');
            $pedido->setEstado('pendiente');

            // Guardamos el pedido y capturamos el ID generado para enlazar las líneas.
            $idPedido = PedidoDAO::crearPedido($pedido);

            // Convertimos cada producto del carrito en una línea asociada al pedido.
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

                LineaPedidoDAO::insertarLineaPedido($linea);
            }

            if (ob_get_level()) {
                ob_end_clean();
            }
            http_response_code(200);
            echo json_encode([
                'status' => 'ok',
                'idPedido' => $idPedido,
                'subtotal' => round($subtotal, 2),
                'descuento' => $resultadoOferta['descuento'],
                'total' => $resultadoOferta['total'],
            ]);
            exit;
        } catch (Throwable $e) {
            error_log($e->getMessage());
            if (ob_get_level()) {
                ob_end_clean();
            }
            http_response_code(500);
            echo json_encode(['status' => 'error', 'message' => 'No se pudo confirmar el pedido.']);
            exit;
        }
    }

    /**
     * Renderiza la vista de confirmación previa (formulario de datos).
     */
    public function confirmarVista(): void
    {
        $view = __DIR__ . '/../view/pedido/confirmar.php';
        $pageTitle = 'Confirmar pedido | Porscheats';
        $navClass = 'estilo_negro';

        if (!is_readable($view)) {
            throw new RuntimeException('No se encuentra la vista de confirmación.');
        }

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['usuario'])) {
            header('Location: index.php?controller=Usuario&action=login');
            exit;
        }

        require __DIR__ . '/../view/main.php';
    }

    /**
     * Página de éxito tras confirmar un pedido.
     */
    public function exito(): void
    {
        $view = __DIR__ . '/../view/pedido/exito.php';
        $pageTitle = 'Pedido confirmado | Porscheats';
        $navClass = 'estilo_negro';

        if (!is_readable($view)) {
            throw new RuntimeException('No se encuentra la vista de éxito.');
        }

        require __DIR__ . '/../view/main.php';
    }

    /**
     * Listado de pedidos del usuario autenticado.
     */
    public function historial(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['usuario'])) {
            header('Location: index.php?controller=Usuario&action=login');
            exit;
        }

        $idUsuario = $_SESSION['usuario']['id_usuario']
            ?? $_SESSION['usuario']['id'];

        $pedidos = PedidoDAO::obtenerPedidosPorUsuario((int)$idUsuario);

        $view = __DIR__ . '/../view/pedido/historial.php';
        $pageTitle = 'Mi historial de pedidos | Porscheats';
        $navClass = 'estilo_negro';

        require __DIR__ . '/../view/main.php';
    }
}