<?php
class ReservacionH {
    public $idReservacion;
    public $idCliente;
    public $fechaInicio;
    public $fechaFin;
    public $estado;

    public function __construct($idReservacion, $idCliente, $fechaInicio, $fechaFin, $estado) {
        $this->idReservacion = $idReservacion;
        $this->idCliente = $idCliente;
        $this->fechaInicio = $fechaInicio;
        $this->fechaFin = $fechaFin;
        $this->estado = $estado;
    }
}

?>