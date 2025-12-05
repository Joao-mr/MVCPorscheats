    <?php

    class Producto{
        private $id_producto;
        private $nombre;
        private $descripcion;
        private $precio_unidad;
        private $categoria;
        private $caracteristica;
        private $disponibilidad;
        private $imagen;
        

        public function getId_producto() {
            return $this->id_producto;
        }

        public function setId_producto($id_producto) {
            $this->id_producto = $id_producto;
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

        public function getPrecio_unidad() {
            return $this->precio_unidad;
        }

        public function setPrecio_unidad($precio_unidad) {
            $this->precio_unidad = $precio_unidad;
        }

        public function getCategoria() {
            return $this->categoria;
        }

        public function setCategoria($categoria) {
            $this->categoria = $categoria;
        }

        public function getCaracteristica() {
            return $this->caracteristica;
        }

        public function setCaracteristica($caracteristica) {
            $this->caracteristica = $caracteristica;
        }
        
        public function getDisponibilidad() {
            return $this->disponibilidad;
        }

        public function setDisponibilidad($disponibilidad) {
            $this->disponibilidad = $disponibilidad;
        }

        public function getImagen() {
            return $this->imagen;
        }

        public function setImagen($imagen) {
            $this->imagen = $imagen;
        }
    }

    ?>