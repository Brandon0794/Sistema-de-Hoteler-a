<?php
// Archivo: controller/PaqueteAPIController.php

require_once __DIR__.'/../accessData/PaqueteDAO.php';
require_once __DIR__.'/../model/PaqueteH.php';

class PaqueteAPIController {

    private $dao;

    public function __construct() {
        $this->dao = new PaqueteDAO();
    }

    public function manejarRequest() {
        $metodo = $_SERVER['REQUEST_METHOD'];

        switch ($metodo) {
            case 'GET':
                // Obtener todos los paquetes
                $paquetes = $this->dao->obtenerDatos();
                echo json_encode($paquetes);
                break;

            case 'POST':
                // Insertar nuevo paquete
                $datos = json_decode(file_get_contents("php://input"), true);

                $paquete = new PaqueteH(
                    null,
                    $datos['nombre'],
                    $datos['descripcion'],
                    $datos['precio']
                );

                $this->dao->insertar($paquete);
                echo json_encode(["mensaje" => "Paquete insertado correctamente"]);
                break;

            case 'PUT':
                // Actualizar paquete
                $datos = json_decode(file_get_contents("php://input"), true);


                // Validar que existan todos los datos requeridos
                if (!isset($datos['idPaquete']) || !isset($datos['nombre']) || !isset($datos['descripcion']) || !isset($datos['precio'])) {
                    echo json_encode(["error" => "Faltan datos para modificar"]);
                    return;
                }

                $paquete = new PaqueteH(
                    $datos['idPaquete'],
                    $datos['nombre'],
                    $datos['descripcion'],
                    $datos['precio']
                );

                $this->dao->modificar($paquete);
                echo json_encode(["mensaje" => "Paquete modificado correctamente"]);
                break;

            case 'DELETE':
                // Eliminar paquete
                $datos = json_decode(file_get_contents("php://input"), true);

                $idPaquete = $datos['idPaquete'];

                $this->dao->eliminar($idPaquete);
                echo json_encode(["mensaje" => "Paquete eliminado correctamente"]);
                break;

            default:
                http_response_code(405);
                echo json_encode(["error" => "Metodo no permitido"]);
                break;
        }
    }
}

?>
