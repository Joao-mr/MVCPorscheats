<?php
include_once 'model/DAO/productoDAO.php';

/**
 * Controlador público para listar productos y mostrar el detalle individual.
 */
class productoController
{
    /**
     * Muestra el detalle de un producto específico.
     */
    public function show(): void
    {
        $idProducto = $_GET['idproducto'] ?? null;
        $producto = productoDAO::getProductoByID($idProducto);

        $view = 'view/producto/show.php';
        $navClass = 'estilo_negro';

        include_once 'view/main.php';
    }

    /**
     * Lista los productos agrupados y filtrados por categoría.
     */
    public function index(): void
    {
        $listaProductos = productoDAO::getProductos();

        $selectedCategory = strtolower($_GET['category'] ?? 'todos');
        $validCategories = ['todos', 'primeros', 'segundos', 'postres', 'bebidas'];
        if (!in_array($selectedCategory, $validCategories, true)) {
            $selectedCategory = 'todos';
        }

        if ($selectedCategory !== 'todos') {
            $listaProductos = array_filter(
                $listaProductos,
                fn($producto) => strtolower($producto->getCategoria()) === $selectedCategory
            );
        }

        $productosPorCategoria = [];
        foreach ($listaProductos as $producto) {
            $categoriaKey = strtolower($producto->getCategoria());
            $productosPorCategoria[$categoriaKey][] = $producto;
        }

        $ordenCategorias = ['primeros', 'segundos', 'postres', 'bebidas'];
        $ordenados = [];
        foreach ($ordenCategorias as $categoria) {
            if (isset($productosPorCategoria[$categoria])) {
                $ordenados[$categoria] = $productosPorCategoria[$categoria];
            }
        }
        $productosPorCategoria = $ordenados + $productosPorCategoria;

        $view = 'view/producto/index.php';
        $navClass = 'estilo_negro';

        include_once 'view/main.php';
    }
}
?>







