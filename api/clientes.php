<?php

    header("Content-Type: application/json");
    
    require_once './../controller/ClienteAPIController.php';
    //require_once '../../controller/ClienteAPICOntroller.php';


    $controlador = new ClientesApicontroller();
    $controlador->manejarRequest();


?>