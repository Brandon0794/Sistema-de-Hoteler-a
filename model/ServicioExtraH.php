<?php
class ServicioExtraH {
    public $idServicio;
    public $nombre;
    public $descripcion;

    public function __construct($idServicio, $nombre, $descripcion) {
        $this->idServicio = $idServicio;
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
    }
}


?>