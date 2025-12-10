    <div class="container mt-5">
    <h2>Hola, <?= $_SESSION['usuario']['nombre'] ?></h2>

    <p>Email: <?= $_SESSION['usuario']['email'] ?></p>

    <a href="index.php?controller=Usuario&action=logout" class="btn btn-danger mt-3">Cerrar sesión</a>
</div>
