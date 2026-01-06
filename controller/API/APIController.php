<?php
/**
 * Controlador base para las APIs del panel.
 * Solo configura headers y detecta el método HTTP.
 */
class APIController
{
    /**
     * Método HTTP actual (GET, POST, PUT, DELETE).
     * @var string
     */
    protected $method;

    public function __construct()
    {
        // Headers obligatorios para todas las respuestas JSON.
        header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
        header('Access-Control-Allow-Headers: Content-Type');

        // Detectar y guardar el método HTTP de la petición.
        $this->method = $_SERVER['REQUEST_METHOD'];
    }
}