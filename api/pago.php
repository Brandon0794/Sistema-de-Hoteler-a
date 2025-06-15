<?php

header("Content-Type: application/json");
require_once './../controller/PagoAPIController.php';

$controlador = new PagoAPIController();
$controlador->manejarRequest();

?>
