<?php
$nav    = __DIR__ . '/Partials/Navbar.php';
$footer = __DIR__ . '/Partials/Footer.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Porscheats</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="/MVCPorscheats/Public/css/Main.css?v=<?= time(); ?>">
</head>
<body>

    <!-- Navbar -->
    <?php include_once $nav; ?>

    <!-- Contenido -->
    <main>
        <?php 
        if (isset($view) && file_exists($view)) {
            include $view;
        } else {
            echo "<p>Error: la vista '$view' no existe.</p>";
        }?>
    </main>

    <!-- Footer -->
    <?php include_once $footer; ?>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    
    <script src="/MVCPorscheats/public/js/main.js"></script>

    <?php if (isset($view) && str_contains($view, 'pedido/carrito')): ?>
        <script src="/MVCPorscheats/public/js/carrito.js"></script>
    <?php endif; ?>

</body>
</html>




