<?php

header("Content-Type: application/json");

require_once './../controller/HabitacionPaqueteAPIController.php';

$controlador = new HabitacionPaqueteAPIController();
$controlador->manejarRequest();

?>
