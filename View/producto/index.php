<?php $selectedCategory = $selectedCategory ?? 'todos'; ?>
<section class="productos-page">
    <div class="container-fluid ">
        <div class="row g-5 ">
            <!-- Filtros laterales -->
            <aside class="col-lg-3">
                <div class="filtros-card p-4">
                    <h5 class="mb-3">Platos</h5>
                    <?php
                    $filtros = [
                        'todos'     => 'Todos',
                        'primeros'  => 'Primeros platos',
                        'segundos'  => 'Segundos platos',
                        'postres'   => 'Postres',
                        'bebidas'   => 'Bebidas'
                    ];
                    foreach ($filtros as $value => $label):
                        $isChecked = $selectedCategory === $value ? 'checked' : '';
                        $url = "index.php?controller=Producto&action=index&category={$value}";
                    ?>
                        <div class="form-check mb-2">
                            <input
                                class="form-check-input"
                                type="checkbox"
                                id="filtro-<?= $value; ?>"
                                <?= $isChecked; ?>
                                onchange="window.location.href='<?= $url; ?>'">
                            <label class="form-check-label" for="filtro-<?= $value; ?>"><?= $label; ?></label>
                        </div>
                    <?php endforeach; ?>

                    <a class="btn btn-outline-dark w-100 mt-4"
                       href="index.php?controller=Producto&action=index">
                        Eliminar filtros
                    </a>

                </div>
            </aside>

            <!-- Listado por categoría -->
            <div class="col-lg-9">
                <?php foreach ($productosPorCategoria as $categoria => $productos): ?>
                    <section class="categoria-block mb-5">
                        <div class="d-flex justify-content-between align-items-baseline mb-3">
                            <h3 class="categoria-titulo"><?= ucfirst($categoria); ?> platos (<?= count($productos); ?>) </h3>
                            </div>

                        <div class="row g-4">
                            <?php foreach ($productos as $producto): ?>
                                <div class="col-md-6 col-xl-4">
                                    <article class="card-producto h-100 d-flex flex-column">
                                        
                                        <div class="card-producto__media">
                                            <img src="/MVCPorscheats/public/images/<?= $producto->getImagen(); ?>" alt="<?= $producto->getNombre(); ?>">
                                        </div>

                                        <div class="card-producto__body flex-grow-1 d-flex flex-column">
                                            <h4><?= $producto->getNombre(); ?></h4>
                                            <p class="text-muted small mb-1">Desde EUR <?= number_format($producto->getPrecio_unidad(), 2); ?></p>
                                            <p class="badge-categoria"><?= ucfirst($producto->getCategoria()); ?></p>

                                            <p class="text-muted flex-grow-1"><?= $producto->getDescripcion(); ?></p>
                                            <ul class="list-unstyled small text-muted mb-3">
                                                <li><?= $producto->getCaracteristica(); ?></li>
                                            </ul>

                                            <div class="d-flex gap-2">
                                                <button class="btn btn-dark flex-grow-1">Comprar</button>
                                                <a class="btn btn-outline-dark flex-grow-1" href="?controller=Producto&action=show&idproducto=<?= $producto->getId_producto(); ?>">Descubrir plato</a>
                                                
                                            </div>
                                        </div>
                                    </article>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </section>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>



