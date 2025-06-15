<?php
class HabitacionH {
    public $idHabitacion;
    public $numero;
    public $idTipo;
    public $precio;

    public function __construct($idHabitacion, $numero, $idTipo, $precio) {
        $this->idHabitacion = $idHabitacion;
        $this->numero = $numero;
        $this->idTipo = $idTipo;
        $this->precio = $precio;
    }
}

?>