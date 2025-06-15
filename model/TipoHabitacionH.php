<?php
class TipoHabitacionH {
    public $idTipo;
    public $nombre;
    public $descripcion;

    public function __construct($idTipo, $nombre, $descripcion) {
        $this->idTipo = $idTipo;
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
    }
}


?>