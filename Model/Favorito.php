<?php

class Favoritos{
    private $id_favorito;
    private $id_producto;
    private $fecha_guardado;

    public function getId_favorito() {
        return $this->id_favorito;
    }

    public function setId_favorito($id_favorito) {
        $this->id_favorito = $id_favorito;
    }

    public function getFecha_guardado() {
        return $this->fecha_guardado;
    }

    public function setFecha_guardado($fecha_guardado) {
        $this->fecha_guardado = $fecha_guardado;
    }

    public function getId_producto() {
        return $this->id_producto;
    }

    public function setId_producto($id_producto) {
        $this->id_producto = $id_producto;
    }
}

?>