<?php
require_once __DIR__ . '/APIController.php';
require_once __DIR__ . '/../../model/DAO/UsuarioDAO.php';

/**
 * API para gestionar usuarios.
 */
class APIUsuarioController extends APIController
{
    /**
     * @var UsuarioDAO
     */
    private $usuarioDAO;

    public function __construct()
    {
        parent::__construct();
        $this->usuarioDAO = new UsuarioDAO();
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
     * Lista todos los usuarios.
     */
    private function handleGet()
    {
        $usuarios = UsuarioDAO::obtenerTodos();
        $this->respondOk($usuarios);
    }

    /**
     * Cambia el rol de un usuario (usuario / admin).
     */
    private function handlePut()
    {
        $body = file_get_contents('php://input');
        $data = json_decode($body, true);

        if (!is_array($data) || empty($data['id']) || empty($data['rol'])) {
            $this->respondError('Datos inválidos');
            return;
        }

        $rol = strtolower($data['rol']);
        $permitidos = ['usuario', 'admin'];

        if (!in_array($rol, $permitidos, true)) {
            $this->respondError('Rol no permitido');
            return;
        }

        UsuarioDAO::updateRol((int) $data['id'], $rol);
        $this->respondOk(['message' => 'Rol actualizado']);
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