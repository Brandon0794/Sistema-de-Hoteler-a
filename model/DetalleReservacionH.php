<?php
class DetalleReservacionH {
    public $idDetalle;
    public $idReservacion;
    public $idHabitacion;

    public function __construct($idDetalle, $idReservacion, $idHabitacion) {
        $this->idDetalle = $idDetalle;
        $this->idReservacion = $idReservacion;
        $this->idHabitacion = $idHabitacion;
    }
}

?>