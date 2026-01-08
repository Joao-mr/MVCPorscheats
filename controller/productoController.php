<?php
include_once 'model/DAO/productoDAO.php';

class productoController {
    public function show(){
        $idproducto = $_GET['idproducto'];
        $producto = productoDAO::getProductoByID($idproducto);
        $view = 'view/producto/show.php';
        $navClass = 'estilo_negro';
        include_once 'view/main.php';
    }


    public function index(){
        $listaProductos = productoDAO::getProductos();

        $selectedCategory = strtolower($_GET['category'] ?? 'todos');
        $validCategories = ['todos','primeros','segundos','postres','bebidas'];
        if (!in_array($selectedCategory, $validCategories)) {
            $selectedCategory = 'todos';
        }

        if ($selectedCategory !== 'todos') {
            $listaProductos = array_filter($listaProductos, function($producto) use ($selectedCategory) {
                return strtolower($producto->getCategoria()) === $selectedCategory;
            });
        }

        $productosPorCategoria = [];
        foreach ($listaProductos as $producto) {
            $categoriaKey = strtolower($producto->getCategoria());
            $productosPorCategoria[$categoriaKey][] = $producto;
        }

        $ordenCategorias = ['primeros','segundos','postres','bebidas'];
        $ordenados = [];
        foreach ($ordenCategorias as $cat) {
            if (isset($productosPorCategoria[$cat])) {
                $ordenados[$cat] = $productosPorCategoria[$cat];
            }
        }
        $productosPorCategoria = $ordenados + $productosPorCategoria;

        $view = 'view/producto/index.php';
        $navClass = 'estilo_negro';
        include_once 'view/main.php';
    }

}
?>







