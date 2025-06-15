<?php

require_once __DIR__ . '/../accessData/PagoDAO.php';
require_once __DIR__ . '/../model/PagoH.php';

class PagoAPIController {

    private $dao;

    public function __construct() {
        $this->dao = new PagoDAO();
    }

    public function manejarRequest() {
        $metodo = $_SERVER['REQUEST_METHOD'];

        switch ($metodo) {
            case 'GET':
                echo json_encode($this->dao->obtenerDatos());
                break;

            case 'POST':
                $datos = json_decode(file_get_contents("php://input"), true);

                $pago = new PagoH(
                    null,
                    $datos['idReservacion'],
                    $datos['monto'],
                    $datos['metodoPago'],
                    $datos['fechaPago']
                );

                $this->dao->insertar($pago);
                echo json_encode(["mensaje" => "Pago insertado correctamente"]);
                break;

            case 'PUT':
                $datos = json_decode(file_get_contents("php://input"), true);


                // Validar que los datos requeridos esten presentes
                if (!isset($datos['idPago']) || !isset($datos['idReservacion']) || !isset($datos['monto']) || !isset($datos['metodoPago']) || !isset($datos['fechaPago'])) {
                    echo json_encode(["error" => "Faltan datos para modificar"]);
                    return;
                }

                $pago = new PagoH(
                    $datos['idPago'],
                    $datos['idReservacion'],
                    $datos['monto'],
                    $datos['metodoPago'],
                    $datos['fechaPago']
                );

                $this->dao->modificar($pago);
                echo json_encode(["mensaje" => "Pago modificado correctamente"]);
                break;

            case 'DELETE':
                parse_str(file_get_contents("php://input"), $datos);

                // Validar que se haya enviado el ID
                if (!isset($datos['idPago'])) {
                    echo json_encode(["error" => "Falta el ID para eliminar"]);
                    return;
                }

                $this->dao->eliminar($datos['idPago']);
                echo json_encode(["mensaje" => "Pago eliminado correctamente"]);
                break;

            default:
                http_response_code(405);
                echo json_encode(["error" => "Metodo no permitido"]);
                break;
        }
    }
}

?>
