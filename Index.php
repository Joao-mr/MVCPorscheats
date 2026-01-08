<?php
// La conexión a la base de datos se carga siempre antes de procesar peticiones.

require_once __DIR__ . '/database/database.php';

// Si no se especifica un controlador, redirigir a Home por defecto.
if (!isset($_GET['controller'])) {
    header("Location: index.php?controller=Home&action=index");
    exit;
}

// Construcción del nombre completo del controlador solicitado.
$nombreControlador = $_GET['controller'] . "Controller";

// Detectar controladores API para ajustar la ruta física del archivo.
if (str_starts_with($nombreControlador, 'API')) {
    $rutaControlador = "controller/API/" . $nombreControlador . ".php";
} else {
    $rutaControlador = "controller/" . $nombreControlador . ".php";
}

// Cargar el archivo del controlador si existe.
if (!file_exists($rutaControlador)) {
    echo "Error: el controlador '$nombreControlador' no existe.";
    exit;
}
require_once $rutaControlador;

// Instanciar el controlador solicitado.
$controlador = new $nombreControlador();

// Validar que se especificó una acción.
if (!isset($_GET['action'])) {
    echo "Error: ninguna acción especificada.";
    exit;
}

$accionSolicitada = $_GET['action'];

// Ejecutar la acción únicamente si el método existe en el controlador.
if (method_exists($controlador, $accionSolicitada)) {
    $controlador->$accionSolicitada();
} else {
    echo "Error: la acción '$accionSolicitada' no existe.";
}
?>