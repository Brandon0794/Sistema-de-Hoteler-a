<?php

header("Content-Type: application/json");

require_once './../controller/ClienteAPIController.php';

$controlador = new ClientesApiController();

// Simula una inserción directa, usando el cuerpo del request
$datos = json_decode(file_get_contents("php://input"), true);

$idCliente = $datos['idCliente'];
$nombre = $datos['nombre'];
$correo = $datos['correo'];

$controlador->insertarCliente($idCliente, $nombre, $correo);

echo json_encode(["mensaje" => "Cliente insertado"]);

?>
