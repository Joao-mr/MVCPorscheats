<?php
include_once 'model/DAO/UsuarioDAO.php';

/**
 * Controlador público para autenticación, registro y área privada del usuario.
 */
class UsuarioController
{
    /**
     * Muestra el formulario de login.
     */
    public function login(): void
    {
        $view = 'view/usuario/login.php';
        $navClass = 'estilo_negro';
        include 'view/main.php';
    }

    /**
     * Procesa el envío del formulario de login.
     */
    public function procesarLogin(): void
    {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        $usuario = UsuarioDAO::login($email);

        if ($usuario && password_verify($password, $usuario->getContrasena())) {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            $_SESSION['usuario'] = [
                'id'     => $usuario->getId_usuario(),
                'nombre' => $usuario->getNombre(),
                'email'  => $usuario->getEmail(),
                'rol'    => $usuario->getRol()
            ];

            header('Location: index.php');
            exit;
        }

        echo 'Credenciales incorrectas';
    }

    /**
     * Muestra el formulario de registro.
     */
    public function registro(): void
    {
        $view = 'view/usuario/registro.php';
        $navClass = 'estilo_negro';
        include 'view/main.php';
    }

    /**
     * Procesa el registro del usuario.
     */
    public function procesarRegistro(): void
    {
        $usuario = new Usuario();
        $usuario->setNombre($_POST['nombre'] ?? '');
        $usuario->setApellido($_POST['apellidos'] ?? '');
        $usuario->setTelefono($_POST['telefono'] ?? '');
        $usuario->setDireccion($_POST['direccion'] ?? '');
        $usuario->setEmail($_POST['email'] ?? '');
        $usuario->setContrasena(password_hash($_POST['contrasena'] ?? '', PASSWORD_BCRYPT));

        if (!UsuarioDAO::registrarUsuario($usuario)) {
            $error = 'El correo ya está registrado.';
            $view = 'view/usuario/registro.php';
            $navClass = 'estilo_negro';
            include 'view/main.php';
            return;
        }

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $_SESSION['usuario'] = [
            'id'     => $usuario->getId_usuario(),
            'nombre' => $usuario->getNombre(),
            'email'  => $usuario->getEmail(),
            'rol'    => 'cliente'
        ];

        header('Location: index.php');
        exit;
    }

    /**
     * Cierra la sesión del usuario actual.
     */
    public function logout(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        session_destroy();
        header('Location: index.php');
        exit;
    }

    /**
     * Muestra la página de cuenta del usuario autenticado.
     */
    public function cuenta(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['usuario'])) {
            header('Location: index.php?controller=Usuario&action=login');
            exit;
        }

        $view = 'view/usuario/cuenta.php';
        $navClass = 'estilo_negro';
        include 'view/main.php';
    }
}

