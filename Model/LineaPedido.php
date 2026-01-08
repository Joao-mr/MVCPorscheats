<?php

class LineaPedido{
    private $id_linea;
    private $id_pedido;
    private $id_producto;
    private $cantidad;
    private $precio_unidad;
    private $porcentaje_descuento;
    private $precio_final_unidad;
    private $subtotal;

    public function getId_linea() {
        return $this->id_linea;
    }

    public function setId_linea($id_linea) {
        $this->id_linea = $id_linea;
    }

    public function getId_pedido() {
        return $this->id_pedido;
    }

    public function setId_pedido($id_pedido) {
        $this->id_pedido = $id_pedido;
    }

    public function getId_producto() {
        return $this->id_producto;
    }

    public function setId_producto($id_producto) {
        $this->id_producto = $id_producto;
    }

    public function getCantidad() {
        return $this->cantidad;
    }

    public function setCantidad($cantidad) {
        $this->cantidad = $cantidad;
    }

    public function getPrecio_unidad() {
        return $this->precio_unidad;
    }

    public function setPrecio_unidad($precio_unidad) {
        $this->precio_unidad = $precio_unidad;
    }

    public function getPorcentaje_descuento() {
        return $this->porcentaje_descuento;
    }

    public function setPorcentaje_descuento($porcentaje_descuento) {
        $this->porcentaje_descuento = $porcentaje_descuento;
    }

    public function getPrecio_final_unidad() {
        return $this->precio_final_unidad;
    }
    
    public function setPrecio_final_unidad($precio_final_unidad) {
        $this->precio_final_unidad = $precio_final_unidad;
    }

    public function getSubtotal() {
        return $this->subtotal;
    }

    public function setSubtotal($subtotal) {
        $this->subtotal = $subtotal;
    }
}

?>