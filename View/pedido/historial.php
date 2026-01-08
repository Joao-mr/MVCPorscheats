<section class="container py-5">
    <!-- Encabezado principal del historial -->
    <header class="mb-4 text-center">
        <h1 class="h3">Mi historial de pedidos</h1>
        <p class="text-muted">Aquí puedes ver tus compras recientes.</p>
    </header>

    <?php if (!empty($pedidos)): ?>
        <?php
            // El primer elemento del array es el pedido más reciente
            $ultimoPedido = $pedidos[0];
            $anteriores = array_slice($pedidos, 1);
        ?>

        <!-- Tarjeta destacada para el pedido más reciente -->
        <div class="card mb-4 shadow-sm">
            <div class="card-body">
                <h2 class="h5">Pedido reciente</h2>
                <p class="mb-1"><strong>ID:</strong> <?= htmlspecialchars($ultimoPedido['id_pedido']) ?></p>
                <p class="mb-1"><strong>Fecha:</strong> <?= htmlspecialchars($ultimoPedido['fecha_pedido']) ?></p>
                <p class="mb-1"><strong>Estado:</strong> <?= htmlspecialchars($ultimoPedido['estado']) ?></p>
                <p class="mb-0"><strong>Total:</strong> <?= number_format($ultimoPedido['importe_total'], 2) ?> €</p>
            </div>
        </div>

        <!-- Listado de pedidos anteriores -->
        <div class="card">
            <div class="card-body">
                <h3 class="h6 mb-3">Pedidos anteriores</h3>

                <?php if (!empty($anteriores)): ?>
                    <ul class="list-group list-group-flush">
                        <?php foreach ($anteriores as $pedido): ?>
                            <li class="list-group-item">
                                <div class="d-flex justify-content-between">
                                    <span>
                                        <strong>#<?= htmlspecialchars($pedido['id_pedido']) ?></strong>
                                        — <?= htmlspecialchars($pedido['fecha_pedido']) ?>
                                    </span>
                                    <span>
                                        <?= htmlspecialchars($pedido['estado']) ?> ·
                                        <?= number_format($pedido['importe_total'], 2) ?> €
                                    </span>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <p class="text-muted mb-0">No hay pedidos anteriores registrados.</p>
                <?php endif; ?>
            </div>
        </div>
    <?php else: ?>
        <!-- Mensaje cuando el usuario todavía no ha comprado -->
        <div class="alert alert-info text-center" role="alert">
            Aún no has realizado pedidos. ¡Visita la tienda y haz tu primera compra!
        </div>
    <?php endif; ?>
</section>