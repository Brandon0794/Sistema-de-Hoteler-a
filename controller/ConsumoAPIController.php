<?php

require_once __DIR__ . '/../accessData/ConsumoDAO.php';
require_once __DIR__ . '/../model/ConsumoH.php';

class ConsumoApiController {

    private $dao;

    public function __construct() {
        $this->dao = new ConsumoDAO();
    }

    public function manejarRequest() {
        $metodo = $_SERVER['REQUEST_METHOD'];

        switch ($metodo) {
            case 'GET':
                // Obtener todos los consumos
                $consumos = $this->dao->obtenerDatos();
                echo json_encode($consumos);
                break;

            case 'POST':
                // Insertar nuevo consumo
                $datos = json_decode(file_get_contents("php://input"), true);

                if (!isset($datos['idReservacion'], $datos['idServicio'], $datos['cantidad'], $datos['fecha'])) {
                    echo json_encode(["error" => "Datos incompletos para insertar"]);
                    return;
                }

                $nuevo = new ConsumoH(
                    null,
                    $datos['idReservacion'],
                    $datos['idServicio'],
                    $datos['cantidad'],
                    $datos['fecha']
                );

                $this->dao->insertar($nuevo);
                echo json_encode(["mensaje" => "Consumo insertado correctamente"]);
                break;

            case 'PUT':
                // Modificar consumo
                parse_str(file_get_contents("php://input"), $datos);

                if (!isset($datos['idConsumo'], $datos['idReservacion'], $datos['idServicio'], $datos['cantidad'], $datos['fecha'])) {
                    echo json_encode(["error" => "Datos incompletos para modificar"]);
                    return;
                }

                $modificado = new ConsumoH(
                    $datos['idConsumo'],
                    $datos['idReservacion'],
                    $datos['idServicio'],
                    $datos['cantidad'],
                    $datos['fecha']
                );

                $this->dao->modificar($modificado);
                echo json_encode(["mensaje" => "Consumo modificado correctamente"]);
                break;

            case 'DELETE':
                // Eliminar consumo
                parse_str(file_get_contents("php://input"), $datos);

                if (!isset($datos['idConsumo'])) {
                    echo json_encode(["error" => "Falta el idConsumo para eliminar"]);
                    return;
                }

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
