<?php
    header("Content-Type: application/json");
    
    require_once './../controller/ConsumoAPIController.php';

    $controlador = new ConsumoAPIController();
    $controlador->manejarRequest();
?>
