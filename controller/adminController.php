<?php

class adminController
{
    public function index(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

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

