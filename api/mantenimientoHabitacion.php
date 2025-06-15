<?php

header("Content-Type: application/json");
require_once './../controller/MantenimientoHabitacionAPIController.php';

$controlador = new MantenimientoHabitacionAPIController();
$controlador->manejarRequest();

?>
