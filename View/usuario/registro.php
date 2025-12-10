<div class="container mt-5">
    <h2>Registro</h2>

    <form action="index.php?controller=Usuario&action=procesarRegistro" method="POST">

        <input class="form-control mt-3" type="text" name="nombre" placeholder="Nombre*" required>
        <input class="form-control mt-3" type="text" name="apellidos" placeholder="Apellidos">
        <input class="form-control mt-3" type="text" name="telefono" placeholder="Teléfono">
        <input class="form-control mt-3" type="text" name="direccion" placeholder="Dirección">
        <input class="form-control mt-3" type="email" name="email" placeholder="Email*" required>
        <input class="form-control mt-3" type="password" name="contrasena" placeholder="Contraseña*" required>

        <button class="btn btn-dark mt-3" type="submit">Registrarse</button>

    </form>
</div>
