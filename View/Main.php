<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Porscheats</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="Public/css/main.css">
</head>
<body>

    <!-- Navbar -->
    <?php include __DIR__ . '/partials/navbar.php'; ?>

    <!-- Contenido -->
    <main>
        <?php 
            if (isset($view)) {
                include $view;
            } else {
                echo "<p>Error: vista no definida.</p>";
            }
        ?>
    </main>

    <!-- Footer -->
    <?php include __DIR__ . '/partials/footer.php'; ?>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

  <!-- Elimina si no existe main.js o créalo -->
    <!-- <script src="/MVCPorscheats/Public/js/main.js"></script> -->
 
   

   