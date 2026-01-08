<?php

class adminController
{
    /**
     * Muestra el dashboard de administración.
     */
    public function index(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Redirige a login si el usuario no está autenticado o no es admin.
        if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'admin') {
            header('Location: index.php?controller=Usuario&action=login');
            exit;
        }

        $view = __DIR__ . '/../view/admin/index.php';
        $pageTitle = 'Panel de administración | Porscheats';
        $navClass = 'estilo_negro';

        require __DIR__ . '/../view/main.php';
    }
}

