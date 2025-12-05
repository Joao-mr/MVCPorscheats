<?php if (!empty($navClass) && $navClass === 'estilo_negro'): ?>
    
    <!-- NAVBAR NEGRO (páginas interiores) -->
    <nav class="navbar navbar-black py-2">
        <div class="container-fluid">

            <!-- Botón menú -->
            <button class="navbar-toggler border-0 d-flex align-items-center gap-2" type="button"
                    data-bs-toggle="offcanvas" data-bs-target="#menuLateral">
                <span class="navbar-toggler-icon"></span>
                <span class="text-white small">Menú</span>
            </button>

            <!-- Logo negro -->
            <a class="navbar-brand mx-auto" href="index.php?controller=Home&action=index">
                <img src="/MVCPorscheats/Public/images/logos/LogoLetrasNegras.png" height="38">
            </a>

            <!-- Iconos negros -->
            <div class="d-flex align-items-center">
                <a class="nav-link text-dark" href="index.php?controller=Pedido&action=cesta">
                    <img src="/MVCPorscheats/Public/images/iconos/shopping-cart.svg">
                </a>
                <a class="nav-link text-dark ms-3" href="index.php?controller=Usuario&action=cuenta">
                    <img src="/MVCPorscheats/Public/images/iconos/user-black.svg">
                </a>
            </div>
        </div>
    </nav>
    

<?php else: ?>
    
    <!-- NAVBAR BLANCO (home) -->
    <nav class="navbar navbar-home navbar-dark py-2">
        <div class="container-fluid">

            <button class="navbar-toggler border-0 d-flex align-items-center gap-2" type="button"
                    data-bs-toggle="offcanvas" data-bs-target="#menuLateral">
                <span class="navbar-toggler-icon"></span>
                <span class="text-dark small">Menú</span>
            </button>

            <a class="navbar-brand mx-auto" href="index.php?controller=Home&action=index">
                <img src="/MVCPorscheats/Public/images/logos/LogoLetrasBlanco.png" height="38">
            </a>

            <div class="d-flex align-items-center">
                <a class="nav-link text-white" href="index.php?controller=Pedido&action=cesta">
                    <img src="/MVCPorscheats/Public/images/iconos/shopping-cart-white.svg">
                </a>
                <a class="nav-link text-white ms-3" href="index.php?controller=Usuario&action=cuenta">
                    <img src="/MVCPorscheats/Public/images/iconos/user.svg">
                </a>
            </div>
        </div>
    </nav>

<?php endif; ?>

<div class="offcanvas offcanvas-start bg-black text-white" tabindex="-1" id="menuLateral" aria-labelledby="menuLateralLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="menuLateralLabel">Menú</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Cerrar"></button>
    </div>
    <div class="offcanvas-body">
        <ul class="navbar-nav gap-2">
            <li class="nav-item"><a class="nav-link text-white" href="index.php?controller=Home&action=index">Home</a></li>
            <li class="nav-item"><a class="nav-link text-white" href="index.php?controller=Producto&action=carta">Carta</a></li>
            <li class="nav-item"><a class="nav-link text-white" href="index.php?controller=Pedido&action=cesta">Carrito</a></li>
            <li class="nav-item"><a class="nav-link text-white" href="index.php?controller=Usuario&action=cuenta">Cuenta</a></li>
        </ul>
    </div>
</div>