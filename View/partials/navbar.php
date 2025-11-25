<nav class="navbar navbar-dark bg-transparent py-2">
    <div class="container-fluid">

        <!-- Botón menú: abre offcanvas -->
        <button class="navbar-toggler border-0 d-flex align-items-center gap-2" type="button"
                data-bs-toggle="offcanvas" data-bs-target="#menuLateral" aria-controls="menuLateral">
            <span class="navbar-toggler-icon"></span>
            <span class="text-white small">Menú</span>
        </button>

        <!-- Logo centrado -->
        <a class="navbar-brand mx-auto" href="index.php?controller=Home&action=index">
            <img src="/MVCPorscheats/Public/images/logos/LogoBlancoLetras.png" alt="Porscheats" height="38">
        </a>

        <!-- Iconos derecha -->
        <div class="d-flex align-items-center">
            <a class="nav-link text-white" href="index.php?controller=Pedido&action=cesta" aria-label="Carrito">
                <img src="/MVCPorscheats/Public/images/iconos/shopping-cart-white.svg" alt="Carrito" height="26">
            </a>
            <a class="nav-link text-white ms-3" href="index.php?controller=Usuario&action=cuenta" aria-label="Cuenta">
                <img src="/MVCPorscheats/Public/images/iconos/user.svg" alt="Cuenta" height="26">
            </a>
        </div>
    </div>
</nav>

<!-- Offcanvas lateral -->
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

<style>
  body{
    background-color: #121212;
  }
</style>