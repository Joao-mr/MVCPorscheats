<?php
require_once __DIR__ . '/APIController.php';
require_once __DIR__ . '/../../model/DAO/PedidoDAO.php';

/**
 * API sencilla para consultar pedidos existentes.
 */
class APIPedidoController extends APIController
{
    /**
     * @var PedidoDAO
     */
    private $pedidoDAO;

    public function __construct()
    {
        parent::__construct();
        $this->pedidoDAO = new PedidoDAO();
    }

    /**
     * Punto de entrada del endpoint.
     */
    public function index()
    {
        switch ($this->method) {
            case 'GET':
                $this->handleGet();
                break;
            case 'PUT':
                $this->handlePut();
                break;
            default:
                $this->respondError('Método no permitido');
        }
    }

    /**
     * Devuelve todos los pedidos registrados.
     */
    private function handleGet()
    {
        $pedidos = PedidoDAO::obtenerTodos();
        $this->respondOk($pedidos);
    }

    /**
     * Actualiza el estado de un pedido (pendiente, enviado, cancelado).
     */
    private function handlePut()
    {
        $body = file_get_contents('php://input');
        $data = json_decode($body, true);

        if (!is_array($data) || empty($data['id']) || empty($data['estado'])) {
            $this->respondError('Datos inválidos');
            return;
        }

        $estado = strtolower($data['estado']);
        $permitidos = ['pendiente', 'enviado', 'cancelado'];

        if (!in_array($estado, $permitidos, true)) {
            $this->respondError('Estado no permitido');
            return;
        }

        $this->pedidoDAO->updateEstado((int) $data['id'], $estado);
        $this->respondOk(['message' => 'Estado actualizado']);
    }

    /**
     * Respuesta exitosa estándar.
     *
     * @param mixed $data
     */
    private function respondOk($data)
    {
        echo json_encode([
            'status' => 'ok',
            'data' => $data
        ]);
    }

    /**
     * Respuesta de error simple.
     *
     * @param string $message
     */
    private function respondError($message)
    {
        echo json_encode([
            'status' => 'error',
            'message' => $message
        ]);
    }
}