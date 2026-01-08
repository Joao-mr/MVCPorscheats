<?php
require_once __DIR__ . '/../Usuario.php';
require_once __DIR__ . '/../../database/database.php';

/**
 * DAO de usuarios: registro, login y administración básica.
 */
class UsuarioDAO
{
    /**
     * Registra a un nuevo usuario. Devuelve false si el email ya existe.
     */
    public static function registrarUsuario($usuario): bool
    {
        $con = DataBase::connect();
        $email = $usuario->getEmail();

        // Verificación rápida para evitar duplicados por email.
        $check = $con->prepare('SELECT 1 FROM usuario WHERE email = ?');
        $check->bind_param('s', $email);
        $check->execute();
        $existe = $check->get_result()->num_rows > 0;
        $check->close();

        if ($existe) {
            $con->close();
            return false;
        }

        $nombre = $usuario->getNombre();
        $apellido = $usuario->getApellido();
        $telefono = $usuario->getTelefono();
        $direccion = $usuario->getDireccion();
        $contrasena = $usuario->getContrasena();

        $stmt = $con->prepare(
            "INSERT INTO usuario (nombre, apellidos, telefono, direccion, email, contrasena, rol, fecha_registro)
             VALUES (?, ?, ?, ?, ?, ?, 'cliente', NOW())"
        );
        $stmt->bind_param('ssssss', $nombre, $apellido, $telefono, $direccion, $email, $contrasena);
        $stmt->execute();

        $stmt->close();
        $con->close();

        return true;
    }

    /**
     * Recupera un usuario por email para el login.
     */
    public static function login($email)
    {
        $con = DataBase::connect();
        $sql = 'SELECT * FROM usuario WHERE email = ?';
        $stmt = $con->prepare($sql);
        $stmt->bind_param('s', $email);
        $stmt->execute();

        $result = $stmt->get_result();
        $usuario = $result->fetch_object('Usuario');

        $stmt->close();
        $con->close();

        return $usuario;
    }

    /**
     * Devuelve todos los usuarios ordenados por fecha de registro (desc).
     */
    public static function obtenerTodos(): array
    {
        $con = DataBase::connect();
        $sql = 'SELECT id_usuario, nombre, apellidos, email, rol, fecha_registro
                FROM usuario
                ORDER BY fecha_registro DESC';

        $stmt = $con->prepare($sql);
        $stmt->execute();

        $resultado = $stmt->get_result();
        $usuarios = $resultado->fetch_all(MYSQLI_ASSOC);

        $stmt->close();
        $con->close();

        return $usuarios;
    }

    /**
     * Actualiza el rol de un usuario concreto.
     */
    public static function updateRol(int $idUsuario, string $rol): bool
    {
        $con = DataBase::connect();
        $sql = 'UPDATE usuario SET rol = ? WHERE id_usuario = ?';

        $stmt = $con->prepare($sql);
        $stmt->bind_param('si', $rol, $idUsuario);
        $ok = $stmt->execute();

        $stmt->close();
        $con->close();

        return $ok;
    }
}
