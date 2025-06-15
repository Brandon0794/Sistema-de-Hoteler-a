<?php

// Encabezado para indicar que la respuesta es JSON
header("Content-Type: application/json");

// Incluir el controlador API correspondiente
require_once './../controller/PaqueteApiController.php';

// Crear instancia del controlador y manejar la solicitud
$controlador = new PaqueteApiController();
$controlador->manejarRequest();

?>
