<?php
require_once __DIR__ . '/../Usuario.php';
require_once __DIR__ . '/../../database/database.php';

class UsuarioDAO {

    public static function registrarUsuario($usuario) {
        $con = DataBase::connect();
        $sql = "INSERT INTO usuario (nombre, apellidos, telefono, direccion, email, contrasena, rol, fecha_registro)
                VALUES (?, ?, ?, ?, ?, ?, 'usuario', NOW())";

        $stmt = $con->prepare($sql);
        $stmt->bind_param(
            "ssssss",
            $usuario->getNombre(),
            $usuario->getApellido(),
            $usuario->getTelefono(),
            $usuario->getDireccion(),
            $usuario->getEmail(),
            $usuario->getContrasena()
        );

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
