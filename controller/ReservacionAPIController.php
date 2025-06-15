<?php
// === ReservacionApiController.php ===
require_once __DIR__.'/../accessData/ReservacionDAO.php';
require_once __DIR__.'/../model/ReservacionH.php';

class ReservacionAPIController {

    private $dao;

    public function __construct() {
        $this->dao = new ReservacionDAO();
    }

    public function manejarRequest() {
        $metodo = $_SERVER['REQUEST_METHOD'];

        switch ($metodo) {
            case 'GET':
                // Obtener todas las reservaciones
                $data = $this->dao->obtenerDatos();
                echo json_encode($data);
                break;

            case 'POST':
                // Insertar nueva reservacion
                $datos = json_decode(file_get_contents("php://input"), true);

                $objeto = new ReservacionH(
                    null,
                    $datos['idCliente'],
                    $datos['fechaInicio'],
                    $datos['fechaFin'],
                    $datos['estado']
                );

                $this->dao->insertar($objeto);
                echo json_encode(["mensaje" => "Reservacion insertada"]);
                break;

            case 'PUT':
                // Actualizar reservacion
                $datos = json_decode(file_get_contents("php://input"), true);

                // Validar que existan los campos requeridos
                if (!isset($datos['idReservacion']) || !isset($datos['idCliente']) || !isset($datos['fechaInicio']) || !isset($datos['fechaFin']) || !isset($datos['estado'])) {
                    echo json_encode(["error" => "Faltan datos para modificar"]);
                    return;
                }

                $objeto = new ReservacionH(
                    $datos['idReservacion'],
                    $datos['idCliente'],
                    $datos['fechaInicio'],
                    $datos['fechaFin'],
                    $datos['estado']
                );

                $this->dao->modificar($objeto);
                echo json_encode(["mensaje" => "Reservacion modificada"]);
                break;

            case 'DELETE':
                // Eliminar reservacion
            $datos = json_decode(file_get_contents("php://input"), true);
    if (isset($datos['idReservacion'])) {
        $this->dao->eliminar($datos['idReservacion']);
        echo json_encode(["mensaje" => "Reservacion eliminada"]);
    } else {
        echo json_encode(["error" => "Falta el idReservacion"]);
    }
    break;
            default:
                http_response_code(405);
                echo json_encode(["error" => "Metodo no permitido"]);
                break;
        }
    }
}

?>
