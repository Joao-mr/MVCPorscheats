<?php
require_once __DIR__ . '/../Usuario.php';
require_once __DIR__ . '/../../database/database.php';

class UsuarioDAO {

    public static function registrarUsuario($usuario) {
        $con = DataBase::connect();

        $email = $usuario->getEmail();

        $check = $con->prepare("SELECT 1 FROM usuario WHERE email = ?");
        $check->bind_param("s", $email);
        $check->execute();
        if ($check->get_result()->num_rows > 0) {
            $con->close();
            return false;
        }

        $nombre     = $usuario->getNombre();
        $apellido   = $usuario->getApellido();
        $telefono   = $usuario->getTelefono();
        $direccion  = $usuario->getDireccion();
        $contrasena = $usuario->getContrasena();

        $stmt = $con->prepare("INSERT INTO usuario (nombre, apellidos, telefono, direccion, email, contrasena, rol, fecha_registro)
                               VALUES (?, ?, ?, ?, ?, ?, 'cliente', NOW())");
        $stmt->bind_param("ssssss", $nombre, $apellido, $telefono, $direccion, $email, $contrasena);
        $stmt->execute();
        $con->close();
        return true;
    }

    public static function login($email) {
        $con = DataBase::connect();
        $sql = "SELECT * FROM usuario WHERE email = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();

        $result = $stmt->get_result();
        $usuario = $result->fetch_object('Usuario');

        $con->close();
        return $usuario;
    }

}
