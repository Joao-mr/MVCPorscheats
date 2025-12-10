<div class="container mt-5">
    <h2>Iniciar sesión</h2>

    <form action="index.php?controller=Usuario&action=procesarLogin" method="POST">
        
        <input class="form-control mt-3" type="email" name="email" placeholder="Email*" required>
        <input class="form-control mt-3" type="password" name="password" placeholder="Contraseña*" required>

        <button class="btn btn-dark mt-3" type="submit">Entrar</button>

        <p class="mt-3">¿No tienes cuenta?
            <a href="index.php?controller=Usuario&action=registro">Regístrate aquí</a>
        </p>
    </form>
</div>
