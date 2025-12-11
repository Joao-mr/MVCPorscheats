<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-5">
                <div class="card shadow-lg border-0">
                    <div class="card-body p-4">
                        <div class="text-center mb-4">
                            <h2 class="fw-bold mb-1">Iniciar sesión</h2>
                            <p class="text-muted mb-0">Acceda a su experiencia Porscheats</p>
                        </div>

                        <form action="index.php?controller=Usuario&action=procesarLogin" method="POST" class="needs-validation" novalidate>
                            <div class="mb-3">
                                <label class="form-label text-uppercase small">Email</label>
                                <input class="form-control form-control-lg" type="email" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label text-uppercase small">Contraseña</label>
                                <input class="form-control form-control-lg" type="password" name="password" required>
                            </div>

                            <button class="btn btn-dark w-100 py-2" type="submit">Entrar</button>

                            <p class="text-center mt-4 mb-0">
                                ¿No tienes cuenta?
                                <a href="index.php?controller=Usuario&action=registro" class="fw-semibold text-decoration-none">Regístrate aquí</a>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
