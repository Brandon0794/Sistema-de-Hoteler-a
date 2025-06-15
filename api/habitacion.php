<?php

header("Content-Type: application/json");

require_once './../controller/HabitacionAPIController.php';

$controlador = new HabitacionAPIController();
$controlador->manejarRequest();
