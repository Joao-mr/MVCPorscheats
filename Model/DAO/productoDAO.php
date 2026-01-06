<?php

require_once __DIR__ . '/../Producto.php';
require_once __DIR__ . '/../../database/database.php';


class ProductoDAO{
    public static function getProductoByID($id)
    {
        $con = DataBase::connect();
        $stmt = $con->prepare("SELECT * FROM producto WHERE id_producto = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        $stmt->close();
        $con->close();

        return $row ? self::mapRowToProducto($row) : null;
    }

    public static function getProductos(): array
    {
        $con = DataBase::connect();
        $stmt = $con->prepare("SELECT * FROM producto ORDER BY id_producto DESC");
        $stmt->execute();

        $result = $stmt->get_result();
        $rows = $result->fetch_all(MYSQLI_ASSOC);

        $stmt->close();
        $con->close();

        return array_map([self::class, 'mapRowToProducto'], $rows);
    }

    private static function mapRowToProducto(array $row): Producto
    {
        $producto = new Producto();

        if (method_exists($producto, 'setId_producto')) {
            $producto->setId_producto((int) ($row['id_producto'] ?? 0));
        }
        if (method_exists($producto, 'setNombre')) {
            $producto->setNombre($row['nombre'] ?? '');
        }
        if (method_exists($producto, 'setDescripcion')) {
            $producto->setDescripcion($row['descripcion'] ?? '');
        }
        if (method_exists($producto, 'setCaracteristica')) {
            $producto->setCaracteristica($row['caracteristica'] ?? '');
        }
        if (method_exists($producto, 'setPrecio_unidad')) {
            $producto->setPrecio_unidad((float) ($row['precio_unidad'] ?? 0));
        }
        if (method_exists($producto, 'setCategoria')) {
            $producto->setCategoria($row['categoria'] ?? '');
        }
        if (method_exists($producto, 'setImagen') && array_key_exists('imagen', $row)) {
            $producto->setImagen($row['imagen']);
        }

        return $producto;
    }

    public static function create(array $data): bool
    {
        $con = DataBase::connect();
        $sql = "INSERT INTO producto (nombre, descripcion, caracteristica, precio_unidad, categoria)
                VALUES (?, ?, ?, ?, ?)";

        $stmt = $con->prepare($sql);
        $nombre        = $data['nombre_producto'] ?? $data['nombre'] ?? '';
        $descripcion   = $data['descripcion'] ?? '';
        $caracteristica = $data['caracteristica'] ?? '';
        $precio        = $data['precio_unidad'] ?? $data['precio_producto'] ?? $data['precio'] ?? 0;
        $categoria     = $data['categoria'] ?? '';

        $stmt->bind_param("sssds", $nombre, $descripcion, $caracteristica, $precio, $categoria);
        $ok = $stmt->execute();

        $stmt->close();
        $con->close();

        return $ok;
    }

    public static function update(array $data): bool
    {
        $con = DataBase::connect();
        $sql = "UPDATE producto
                SET nombre = ?, descripcion = ?, caracteristica = ?, precio_unidad = ?, categoria = ?
                WHERE id_producto = ?";

        $stmt = $con->prepare($sql);
        $nombre        = $data['nombre_producto'] ?? $data['nombre'] ?? '';
        $descripcion   = $data['descripcion'] ?? '';
        $caracteristica = $data['caracteristica'] ?? '';
        $precio        = $data['precio_unidad'] ?? $data['precio_producto'] ?? $data['precio'] ?? 0;
        $categoria     = $data['categoria'] ?? '';
        $id            = (int) ($data['id'] ?? $data['id_producto'] ?? 0);

        $stmt->bind_param("sssdsi", $nombre, $descripcion, $caracteristica, $precio, $categoria, $id);
        $ok = $stmt->execute();

        $stmt->close();
        $con->close();

        return $ok;
    }

    public static function delete(int $id): bool
    {
        $con = DataBase::connect();
        $stmt = $con->prepare("DELETE FROM producto WHERE id_producto = ?");
        $stmt->bind_param("i", $id);
        $ok = $stmt->execute();

        $stmt->close();
        $con->close();

        return $ok;
    }

}

?>