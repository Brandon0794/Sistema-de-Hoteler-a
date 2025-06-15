<?php
class PaqueteH {
    public $idPaquete;
    public $nombre;
    public $descripcion;
    public $precio;

    public function __construct($idPaquete, $nombre, $descripcion, $precio) {
        $this->idPaquete = $idPaquete;
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->precio = $precio;
    }
}

?>