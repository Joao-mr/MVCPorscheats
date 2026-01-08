<?php
// Preparar mensaje de error sanitizado para mantener la vista limpia y segura.
$hayError = !empty($error);
$mensajeError = $hayError ? htmlspecialchars($error) : '';
?>
<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9 col-lg-6">
                <div class="card shadow-lg border-0">
                    <div class="card-body p-4">
                        <?php if ($hayError): ?>
                            <div class="alert alert-danger mb-4">
                                <?= $mensajeError; ?>
                            </div>
                        <?php endif; ?>

                        <div class="text-center mb-4">
                            <h2 class="fw-bold mb-1">Crear cuenta</h2>
                            <p class="text-muted mb-0">Únase a Porscheats y disfrute experiencias exclusivas</p>
                        </div>

                        <form action="index.php?controller=Usuario&action=procesarRegistro" method="POST">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label text-uppercase small">Nombre*</label>
                                    <input class="form-control form-control-lg" type="text" name="nombre" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label text-uppercase small">Apellidos</label>
                                    <input class="form-control form-control-lg" type="text" name="apellidos">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label text-uppercase small">Teléfono</label>
                                    <input class="form-control form-control-lg" type="text" name="telefono">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label text-uppercase small">Dirección</label>
                                    <input class="form-control form-control-lg" type="text" name="direccion">
                                </div>
                                <div class="col-12">
                                    <label class="form-label text-uppercase small">Email*</label>
                                    <input class="form-control form-control-lg" type="email" name="email" required>
                                </div>
                                <div class="col-12">
                                    <label class="form-label text-uppercase small">Contraseña*</label>
                                    <input class="form-control form-control-lg" type="password" minlength="3" name="contrasena" required>
                                </div>
                            </div>

                            <button class="btn btn-dark w-100 py-2 mt-4" type="submit">Registrarse</button>

                            <p class="text-center mt-3 mb-0">
                                ¿Ya tienes cuenta?
                                <a href="index.php?controller=Usuario&action=login" class="fw-semibold text-decoration-none">Inicia sesión aquí</a>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
