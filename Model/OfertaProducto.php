<?php

class OfertaProducto{
    private $id_oferta;
    private $id_producto;
    private $porcentaje_descuento;
    private $precio_promocional;
    private $fecha_asignacion;

    public function getId_oferta() {
        return $this->id_oferta;
    }

    public function setId_oferta($id_oferta) {
        $this->id_oferta = $id_oferta;
    }

    public function getId_producto() {
        return $this->id_producto;
    }

    public function setId_producto($id_producto) {
        $this->id_producto = $id_producto;
    }

    public function getPorcentaje_descuento() {
        return $this->porcentaje_descuento;
    }

    public function setPorcentaje_descuento($porcentaje_descuento) {
        $this->porcentaje_descuento = $porcentaje_descuento;
    }

    public function getPrecio_promocional() {
        return $this->precio_promocional;
    }

    public function setPrecio_promocional($precio_promocional) {
        $this->precio_promocional = $precio_promocional;
    }

    public function getFecha_asignacion() {
        return $this->fecha_asignacion;
    }

    public function setFecha_asignacion($fecha_asignacion) {
        $this->fecha_asignacion = $fecha_asignacion;
    }

}

?>