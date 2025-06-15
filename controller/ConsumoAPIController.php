<?php

require_once __DIR__ . '/../accessData/ConsumoDAO.php';
require_once __DIR__ . '/../model/ConsumoH.php';

class ConsumoAPIController {

    private $dao;

    public function __construct() {
        $this->dao = new ConsumoDAO();
    }

    public function manejarRequest() {
        $metodo = $_SERVER['REQUEST_METHOD'];

        switch ($metodo) {
            case 'GET':
                echo json_encode($this->dao->obtenerDatos());
                break;

            case 'POST':
                $datos = json_decode(file_get_contents("php://input"), true);

                $objeto = new ConsumoH(
                    null,
                    $datos['idReservacion'],
                    $datos['idServicio'],
                    $datos['cantidad'],
                    $datos['fecha']
                );

                $this->dao->insertar($objeto);
                echo json_encode(["mensaje" => "Consumo insertado correctamente"]);
                break;

            case 'PUT':
                $datos = json_decode(file_get_contents("php://input"), true);

                $objeto = new ConsumoH(
                    $datos['idConsumo'],
                    $datos['idReservacion'],
                    $datos['idServicio'],
                    $datos['cantidad'],
                    $datos['fecha']
                );

                $this->dao->modificar($objeto);
                echo json_encode(["mensaje" => "Consumo modificado correctamente"]);
                break;

            case 'DELETE':
                parse_str(file_get_contents("php://input"), $datos);

                $this->dao->eliminar($datos['idConsumo']);
                echo json_encode(["mensaje" => "Consumo eliminado correctamente"]);
                break;

            default:
                http_response_code(405);
                echo json_encode(["error" => "Método no permitido"]);
                break;
        }
    }
}
?>
