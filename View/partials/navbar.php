<?php 
if (session_status() === PHP_SESSION_NONE) session_start();
$isLogged = isset($_SESSION['usuario']);
$isAdmin  = $isLogged && (($_SESSION['usuario']['rol'] ?? '') === 'admin');
?>

<?php if (!empty($navClass) && $navClass === 'estilo_negro'): ?>
    
    <!-- NAVBAR NEGRO -->
    <nav class="navbar navbar-black py-2">
        <div class="container-fluid">

            <!-- Botón menú -->
            <button class="navbar-toggler border-0 d-flex align-items-center gap-2" 
                    type="button" data-bs-toggle="offcanvas" data-bs-target="#menuLateral">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Logo -->
            <a class="navbar-brand mx-auto" href="index.php?controller=Home&action=index">
                <img src="/MVCPorscheats/Public/images/logos/LogoLetrasNegras.svg" height="38">
            </a>

            <!-- Icono usuario -->
            <div class="d-flex align-items-center">
                <a class="nav-link text-dark" href="index.php?controller=Pedido&action=cesta">
                    <img src="/MVCPorscheats/Public/images/iconos/shopping-cart.svg">
                </a>

                <?php if ($isLogged): ?>
                    <a class="nav-link text-dark ms-3" href="index.php?controller=Usuario&action=cuenta">
                        <img src="/MVCPorscheats/Public/images/iconos/user-black.svg">
                    </a>
                <?php else: ?>
                    <a class="nav-link text-dark ms-3" href="index.php?controller=Usuario&action=login">
                        <img src="/MVCPorscheats/Public/images/iconos/user-black.svg">
                    </a>
                <?php endif; ?>

            </div>
        </div>
    </nav>

<?php else: ?>

    <!-- NAVBAR BLANCO (HOME) -->
    <nav class="navbar navbar-home navbar-dark py-2">
        <div class="container-fluid">

            <!-- Botón menú -->
            <button class="navbar-toggler border-0 d-flex align-items-center gap-2" 
                    type="button" data-bs-toggle="offcanvas" data-bs-target="#menuLateral">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Logo -->
            <a class="navbar-brand mx-auto" href="index.php?controller=Home&action=index">
                <img src="/MVCPorscheats/Public/images/logos/LogoLetrasBlanco.png" height="38">
            </a>

            <!-- Iconos -->
            <div class="d-flex align-items-center">
                <a class="nav-link text-white" href="index.php?controller=Pedido&action=cesta">
                    <img src="/MVCPorscheats/Public/images/iconos/shopping-cart-white.svg">
                </a>

                <?php if ($isLogged): ?>
                    <a class="nav-link text-white ms-3" href="index.php?controller=Usuario&action=cuenta">
                        <img src="/MVCPorscheats/Public/images/iconos/user.svg">
                    </a>
                <?php else: ?>
                    <a class="nav-link text-white ms-3" href="index.php?controller=Usuario&action=login">
                        <img src="/MVCPorscheats/Public/images/iconos/user.svg">
                    </a>
                <?php endif; ?>

            </div>
        </div>
    </nav>

<?php endif; ?>

<!-- OFFCANVAS -->
<div class="offcanvas offcanvas-start bg-black text-white" id="menuLateral">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title">Menú</h5>
        <button class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
    </div>

    <div class="offcanvas-body">
        <ul class="navbar-nav gap-2">

            <li class="nav-item">
                <a class="nav-link text-white" href="index.php?controller=Home&action=index">Home</a>
            </li>

            <li class="nav-item">
                <a class="nav-link text-white" href="index.php?controller=Producto&action=index">Productos</a>
            </li>

            <li class="nav-item">
                <a class="nav-link text-white" href="index.php?controller=Pedido&action=cesta">Carrito</a>
            </li>

            <?php if ($isLogged): ?>
                
                <li class="nav-item">
                    <a class="nav-link text-white" href="index.php?controller=Usuario&action=cuenta">Mi cuenta</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-danger" href="index.php?controller=Usuario&action=logout">Cerrar sesión</a>
                </li>

            <?php else: ?>

                <li class="nav-item">
                    <a class="nav-link text-white" href="index.php?controller=Usuario&action=login">Iniciar sesión</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-white" href="index.php?controller=Usuario&action=registro">Registrarse</a>
                </li>

            <?php endif; ?>

            <?php if ($isAdmin): ?>
                <li class="nav-item">
                    <a class="nav-link text-warning" href="index.php?controller=Admin&action=index">Panel de administración</a>
                </li>
            <?php endif; ?>

        </ul>
    </div>
</div>
