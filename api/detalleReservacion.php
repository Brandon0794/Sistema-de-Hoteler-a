<?php
header("Content-Type: application/json");
require_once './../controller/DetalleReservacionAPIController.php';

$api = new DetalleReservacionAPIController();
$api->manejarRequest();
