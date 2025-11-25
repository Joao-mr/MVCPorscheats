<?php
$navPath    = __DIR__ . '/Partials/Navbar.php';
$footerPath = __DIR__ . '/Partials/Footer.php';
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
    <?php include_once $navPath; ?>

    <!-- Contenido -->
    <main>
        <?php echo isset($view) ? include $view : '<p>Error: vista no definida.</p>'; ?>
    </main>

    <!-- Footer -->
    <?php include_once $footerPath; ?>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    
  <!-- Elimina si no existe main.js o créalo -->
    <!-- <script src="/MVCPorscheats/Public/js/main.js"></script> -->
</body>
</html>




