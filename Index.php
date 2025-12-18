<?php

/*    if ($controller === 'api') {
    
    header('Content-Type: application/json');
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
    header('Access-Control-Allow-Headers: Content-Type, Authorization');

    if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
        http_response_code(204);
        exit();
    }
}
*/

require_once __DIR__ . '/database/database.php';


// 2. Cargar el controlador solicitado
if (isset($_GET['controller'])) {

    $controllerName = $_GET['controller'] . "Controller";
    $controllerFile = "controller/" . $controllerName . ".php";

    // Verificar si existe el archivo del controlador
    if (file_exists($controllerFile)) {

        require_once $controllerFile;

        // Crear instancia del controlador
        $controller = new $controllerName();

        // Verificar acción
        if (isset($_GET['action'])) {

            $action = $_GET['action'];

            // Verificar que el método existe
            if (method_exists($controller, $action)) {
                $controller->$action();
            } else {
                echo "Error: la acción '$action' no existe.";
            }

        } else {
            echo "Error: ninguna acción especificada.";
        }

    } else {
        echo "Error: el controlador '$controllerName' no existe.";
    }

} else {
    // No hay controlador -> redirigir a Home
        header("Location: index.php?controller=Home&action=index");
    exit;
}

?>