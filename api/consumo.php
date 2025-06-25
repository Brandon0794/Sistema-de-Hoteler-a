<?php
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type");
    header("Content-Type: application/json");
    
    require_once './../controller/ConsumoAPIController.php';

    $controlador = new ConsumoAPIController();
    $controlador->manejarRequest();
?>
