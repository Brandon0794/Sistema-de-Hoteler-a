<?php
header("Access-Control-Allow-Origin: http://localhost:5173");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Content-Type: application/json");
require_once './../controller/DetalleReservacionAPIController.php';


// Incluir el controlador API correspondiente
require_once './../controller/PaqueteApiController.php';

// Crear instancia del controlador y manejar la solicitud
$controlador = new PaqueteApiController();
$controlador->manejarRequest();

?>
