<?php
class PagoH {
    public $idPago;
    public $idReservacion;
    public $monto;
    public $metodoPago;
    public $fechaPago;

    public function __construct($idPago, $idReservacion, $monto, $metodoPago, $fechaPago) {
        $this->idPago = $idPago;
        $this->idReservacion = $idReservacion;
        $this->monto = $monto;
        $this->metodoPago = $metodoPago;
        $this->fechaPago = $fechaPago;
    }
}

?>