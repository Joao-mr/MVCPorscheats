<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Porscheats</title>

    <!--Bootstrap-->
    <link  href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"  rel="stylesheet">

    <!--CSS-->
    <link rel="stylesheet" href="/css/main.css">


</head>
<body>
    <!--Navbar-->
    <?php include 'View/partials/Navbar.php'; ?>

    <!--Contenido-->
    <main>
        <?php include_once $view; ?>
    </main>

    <!-- FOOTER -->
    <?php include_once "View/partials/Footer.php"; ?>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script src="public/js/main.js"></script>

</body>
</html>