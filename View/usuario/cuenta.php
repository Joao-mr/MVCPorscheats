<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card shadow-lg border-0">
                    <div class="card-body p-4">
                        <div class="text-center mb-4">
                            <h2 class="fw-bold mb-1">Bienvenido! <?= htmlspecialchars($_SESSION['usuario']['nombre']); ?></h2>
                            <p class="text-muted mb-0">Resumen de tu cuenta Porscheats</p>
                        </div>

                        <div class="list-group mb-4">
                            <div class="list-group-item d-flex justify-content-between">
                                <span>Email</span>
                                <strong><?= htmlspecialchars($_SESSION['usuario']['email']); ?></strong>
                            </div>
                            <div class="list-group-item d-flex justify-content-between">
                                <span>ID usuario</span>
                                <strong>#<?= $_SESSION['usuario']['id']; ?></strong>
                            </div>
                        </div>

                        <div class="d-grid gap-3">
                            <a class="btn btn-dark" href="index.php?controller=Pedido&action=carrito">Ver mi carrito</a>
                            <a class="btn btn-secondary" href="index.php?controller=Pedido&action=historial">
                                Ver historial de pedidos
                            </a>
                            <a class="btn btn-outline-dark" href="index.php?controller=Producto&action=index">Seguir explorando</a>
                            <?php if (($_SESSION['usuario']['rol'] ?? '') === 'admin'): ?>
                                <a class="btn btn-warning" href="index.php?controller=admin&action=index">Panel de administración</a>
                            <?php endif; ?>
                            <a class="btn btn-danger" href="index.php?controller=Usuario&action=logout">Cerrar sesión</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
