<?php

class HomeController {

    public function index() {
        $view = "view/home/index.php";
        $navClass = "estilo_blanco";
        include "view/main.php";
    }
}
