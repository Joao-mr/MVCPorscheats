<?php
include_once 'model/DAO/UsuarioDAO.php';

class UsuarioController {

    public function login() {
        $view = "view/usuario/login.php";
        $navClass = "estilo_negro";
        include "view/main.php";
    }

    public function procesarLogin() {

        $email = $_POST['email'];
        $password = $_POST['password'];

        $usuario = UsuarioDAO::login($email);

        if ($usuario && password_verify($password, $usuario->getContrasena())) {
            session_start();
            $_SESSION['usuario'] = [
                'id'     => $usuario->getId_usuario(),
                'nombre' => $usuario->getNombre(),
                'email'  => $usuario->getEmail()
            ];
            header("Location: index.php");
            exit;
        } else {
            echo "Credenciales incorrectas";
        }
    }

    public function registro() {
        $view = "view/usuario/registro.php";
        $navClass = "estilo_negro";
        include "view/main.php";
    }

    public function procesarRegistro() {
        $usuario = new Usuario();
        $usuario->setNombre($_POST['nombre']);
        $usuario->setApellido($_POST['apellidos'] ?? '');
        $usuario->setTelefono($_POST['telefono'] ?? '');
        $usuario->setDireccion($_POST['direccion'] ?? '');
        $usuario->setEmail($_POST['email']);
        $usuario->setContrasena(password_hash($_POST['contrasena'], PASSWORD_BCRYPT));

        if (!UsuarioDAO::registrarUsuario($usuario)) {
            $error    = "El correo ya está registrado.";
            $view     = 'view/usuario/registro.php';
            $navClass = 'estilo_negro';
            include 'view/main.php';
            return;
        }

        $_SESSION['usuario'] = [
            'id'     => $usuario->getId_usuario(),
            'nombre' => $usuario->getNombre(),
            'email'  => $usuario->getEmail()
        ];
        header("Location: index.php");
        exit;
    }

    public function logout() {
        session_start();
        session_destroy();
        header("Location: index.php");
    }

    public function cuenta() {
    session_start();
    if (!isset($_SESSION['usuario'])) {
        header("Location: index.php?controller=Usuario&action=login");
        exit;
    }

    $view = "view/usuario/cuenta.php";
    $navClass = "estilo_negro";
    include "view/main.php";
}
}

