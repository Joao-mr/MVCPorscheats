<?php

class Oferta{
    private $id_oferta;
    private $nombre;
    private $descripcion;
    private $tipo_descuento;
    private $valor_descuento;
    private $cantidad_minima;
    private $activa;
    private $fecha_inicio;
    private $fecha_fin;


    public function getId_oferta() {
        return $this->id_oferta;
    }

    public function setId_oferta($id_oferta) {
        $this->id_oferta = $id_oferta;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    public function getTipo_descuento() {
        return $this->tipo_descuento;
    }

    public function setTipo_descuento($tipo_descuento) {
        $this->tipo_descuento = $tipo_descuento;
    }

    public function getValor_descuento() {
        return $this->valor_descuento;
    }

    public function setValor_descuento($valor_descuento) {
        $this->valor_descuento = $valor_descuento;
    }

    public function getCantidad_minima() {
        return $this->cantidad_minima;
    }

    public function setCantidad_minima($cantidad_minima) {
        $this->cantidad_minima = $cantidad_minima;
    }

    public function getActiva() {
        return $this->activa;
    }

    public function setActiva($activa) {
        $this->activa = $activa;
    }

    public function getFecha_inicio() {
        return $this->fecha_inicio;
    }

    public function setFecha_inicio($fecha_inicio) {
        $this->fecha_inicio = $fecha_inicio;
    }

    public function getFecha_fin() {
        return $this->fecha_fin;
    }

    public function setFecha_fin($fecha_fin) {
        $this->fecha_fin = $fecha_fin;
    }
}

?>