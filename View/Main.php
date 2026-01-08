<?php
$nav          = __DIR__ . '/partials/navbar.php';
$footer       = __DIR__ . '/partials/footer.php';
$vistaDefinida = isset($view);
$esVistaAdmin  = $vistaDefinida && str_contains($view, 'admin');
$requiereCarrito = $vistaDefinida && str_contains($view, 'pedido/carrito');
$requierePedido  = $vistaDefinida && str_contains($view, 'pedido/confirmar');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Porscheats</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- CSS principal -->
    <link rel="stylesheet" href="public/css/main.css?v=<?= time(); ?>">

    <!-- CSS específico para vistas de administración -->
    <?php if ($esVistaAdmin): ?>
        <link rel="stylesheet" href="public/css/admin.css?v=<?= time(); ?>">
    <?php endif; ?>
</head>
<body>

    <!-- Navbar -->
    <?php include_once $nav; ?>

    <!-- Contenido -->
    <main>
        <?php
        if ($vistaDefinida && file_exists($view)) {
            include $view;
        } else {
            $vistaActual = $vistaDefinida ? $view : '';
            echo "<p>Error: la vista '{$vistaActual}' no existe.</p>";
        }
        ?>
    </main>

    <!-- Footer -->
    <?php include_once $footer; ?>

    <!-- JS principal -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="public/js/main.js"></script>

    <!-- JS específicos según la vista -->
    <?php if ($requiereCarrito): ?>
        <script src="public/js/carrito.js"></script>
    <?php endif; ?>

    <?php if ($requierePedido): ?>
        <script src="public/js/pedido.js"></script>
    <?php endif; ?>

    <?php if ($esVistaAdmin): ?>
        <script src="public/js/admin/index.js"></script>
        <script src="public/js/admin/pedido.js"></script>
        <script src="public/js/admin/producto.js"></script>
    <?php endif; ?>
</body>
</html>




