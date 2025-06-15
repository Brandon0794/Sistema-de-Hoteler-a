<?php
class HabitacionPaqueteH {
    public $idHabitacion;
    public $idPaquete;

    public function __construct($idHabitacion, $idPaquete) {
        $this->idHabitacion = $idHabitacion;
        $this->idPaquete = $idPaquete;
    }
}

?>