<section class="producto-show py-5">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6 text-center">
                <div class="producto-show__media">
                    <img src="/MVCPorscheats/Public/images/<?= $producto->getImagen(); ?>"
                         alt="<?= $producto->getNombre(); ?>"
                         class="img-fluid rounded-4 shadow-lg">
                </div>
            </div>
            <div class="col-lg-6">
                <h1 class="mb-3"><?= $producto->getNombre(); ?></h1>
                <p class="lead text-muted mb-4"><?= $producto->getDescripcion(); ?></p>
                <ul class="list-unstyled mb-4">
                    <li><strong>Características:</strong> <?= $producto->getCaracteristica(); ?></li>
                    <li><strong>Categoría:</strong> <?= ucfirst($producto->getCategoria()); ?></li>
                    <li><strong>Precio:</strong> EUR <?= number_format($producto->getPrecio_unidad(), 2); ?></li>
                    <li><strong>Disponibilidad:</strong> <?= $producto->getDisponibilidad(); ?></li>
                </ul>
                <form method="post" action="index.php?controller=Pedido&action=agregar">
                    <input type="hidden" name="idproducto" value="<?= $producto->getId_producto(); ?>">
                    <button class="btn btn-dark btn-lg px-5">Agregar al carrito</button>
                </form>
            </div>
        </div>
    </div>
</section>


