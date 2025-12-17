<?php

class LogAcciones{
    private $id_log;
    private $id_usuario;
    private $accion;
    private $detalles;
    private $fecha;


    public function getId_log() {
        return $this->id_log;
    }

    public function setId_log($id_log) {
        $this->id_log = $id_log;
    }

    public function getId_usuario() {
        return $this->id_usuario;
    }

    public function setId_usuario($id_usuario) {
        $this->id_usuario = $id_usuario;
    }

    public function getAccion() {
        return $this->accion;
    }

    public function setAccion($accion) {
        $this->accion = $accion;
    }

    public function getDetalles() {
        return $this->detalles;
    }

    public function setDetalles($detalles) {
        $this->detalles = $detalles;
    }

    public function getFecha() {
        return $this->fecha;
    }

    public function setFecha($fecha) {
        $this->fecha = $fecha;
    }
}

?>