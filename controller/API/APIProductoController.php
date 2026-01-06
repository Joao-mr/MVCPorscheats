<?php
require_once __DIR__ . '/APIController.php';
require_once __DIR__ . '/../../model/DAO/ProductoDAO.php';

/**
 * API sencilla para consultar productos.
 */
class APIProductoController extends APIController
{
    /**
     * @var ProductoDAO
     */
    private $productoDAO;

    public function __construct()
    {
        parent::__construct();
        $this->productoDAO = new ProductoDAO();
    }

    /**
     * Punto de entrada único para el endpoint.
     */
    public function index()
    {
        switch ($this->method) {
            case 'GET':
                $this->handleGet();
                break;
            case 'POST':
                $this->handlePost();
                break;
            case 'PUT':
                $this->handlePut();
                break;
            case 'DELETE':
                $this->handleDelete();
                break;
            default:
                $this->respondError('Método no permitido');
        }
    }

    /**
     * Maneja solicitudes GET:
     * - Sin id: devuelve todos los productos.
     * - Con id: devuelve un producto específico.
     */
    private function handleGet()
    {
        if (!empty($_GET['id'])) {
            $producto = ProductoDAO::getProductoByID((int) $_GET['id']);

            if ($producto) {
                $this->respondOk($producto);
            } else {
                $this->respondError('Producto no encontrado');
            }
            return;
        }

        $productos = ProductoDAO::getProductos();
        $this->respondOk($productos);
    }

    /**
     * Maneja solicitudes POST:
     * - Lee el cuerpo JSON y crea un nuevo producto.
     */
    private function handlePost()
    {
        $body = file_get_contents('php://input');
        $data = json_decode($body, true);

        if (!is_array($data)) {
            $this->respondError('Datos inválidos');
            return;
        }

        // Crear el producto usando el DAO existente.
        $this->productoDAO->create($data);

        $this->respondMessage('Producto creado');
    }

    /**
     * Maneja solicitudes PUT:
     * - Lee el cuerpo JSON y actualiza un producto existente.
     */
    private function handlePut()
    {
        $body = file_get_contents('php://input');
        $data = json_decode($body, true);

        if (!is_array($data) || empty($data['id'])) {
            $this->respondError('Datos inválidos');
            return;
        }

        $this->productoDAO->update($data['id'], $data);
        $this->respondMessage('Producto actualizado');
    }

    /**
     * Maneja solicitudes DELETE:
     * - Elimina un producto por su ID (en la query string).
     */
    private function handleDelete()
    {
        if (empty($_GET['id'])) {
            $this->respondError('ID requerido');
            return;
        }

        $this->productoDAO->delete((int) $_GET['id']);
        $this->respondMessage('Producto eliminado');
    }

    /**
     * Envía una respuesta exitosa.
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
     * Envía una respuesta de error simple.
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

    /**
     * Envía una respuesta con solo mensaje.
     *
     * @param string $message
     */
    private function respondMessage($message)
    {
        echo json_encode([
            'status' => 'ok',
            'message' => $message
        ]);
    }
}