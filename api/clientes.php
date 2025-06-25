<?php
// Permitir solicitudes desde cualquier origen (CORS)
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

// Manejar solicitudes preflight (CORS - OPTIONS)
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

// Establecer tipo de contenido JSON
header("Content-Type: application/json");

// Cargar el controlador y ejecutar la lógica correspondiente
require_once __DIR__ . '/../controller/ClienteAPIController.php';

$controlador = new ClientesApicontroller();
$controlador->manejarRequest();
?>
