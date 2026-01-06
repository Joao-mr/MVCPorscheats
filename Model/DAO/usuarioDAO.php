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

    public static function obtenerTodos(): array
    {
        $con = DataBase::connect();
        $sql = "SELECT id_usuario, nombre, apellidos, email, rol, fecha_registro
                FROM usuario
                ORDER BY fecha_registro DESC";

        $stmt = $con->prepare($sql);
        $stmt->execute();

        $resultado = $stmt->get_result();
        $usuarios = $resultado->fetch_all(MYSQLI_ASSOC);

        $stmt->close();
        $con->close();

        return $usuarios;
    }

    public static function updateRol(int $idUsuario, string $rol): bool
    {
        $con = DataBase::connect();
        $sql = "UPDATE usuario SET rol = ? WHERE id_usuario = ?";

        $stmt = $con->prepare($sql);
        $stmt->bind_param("si", $rol, $idUsuario);
        $ok = $stmt->execute();

        $stmt->close();
        $con->close();

        return $ok;
    }

}
