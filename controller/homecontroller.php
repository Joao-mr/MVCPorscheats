<?php

class HomeController
{
    /**
     * Renderiza la portada con navegación en estilo blanco.
     */
    public function index(): void
    {
        $view = 'view/home/index.php';
        $navClass = 'estilo_blanco';

        require 'view/main.php';
    }
}
