<?php

class Pedido{
    private $id_pedido;
    private $id_usuario;
    private $id_oferta;
    private $fecha_pedido;
    private $metodo_pago;
    private $direccion_entrega;
    private $estado;
    private $importe_total;

    public function getId_pedido() {
        return $this->id_pedido;
    }

    public function setId_pedido($id_pedido) {
        $this->id_pedido = $id_pedido;
    }

    public function getId_usuario() {
        return $this->id_usuario;
    }

    public function setId_usuario($id_usuario) {
        $this->id_usuario = $id_usuario;
    }

    public function getId_oferta() {
        return $this->id_oferta;
    }

    public function setId_oferta($id_oferta) {
        $this->id_oferta = $id_oferta;
    }

    public function getFecha_pedido() {
        return $this->fecha_pedido;
    }

    public function setFecha_pedido($fecha_pedido) {
        $this->fecha_pedido = $fecha_pedido;
    }

    public function getMetodo_pago() {
        return $this->metodo_pago;
    }

    public function setMetodo_pago($metodo_pago) {
        $this->metodo_pago = $metodo_pago;
    }

    public function getDireccion_entrega() {
        return $this->direccion_entrega;
    }

    public function setDireccion_entrega($direccion_entrega) {
        $this->direccion_entrega = $direccion_entrega;
    }

    public function getEstado() {
        return $this->estado;
    }

    public function setEstado($estado) {
        $this->estado = $estado;
    }

    public function getImporte_total() {
        return $this->importe_total;
    }

    public function setImporte_total($importe_total) {
        $this->importe_total = $importe_total;
    }

}

?>