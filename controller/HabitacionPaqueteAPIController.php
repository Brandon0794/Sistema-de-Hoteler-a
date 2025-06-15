<?php

require_once __DIR__ . '/../accessData/HabitacionPaqueteDAO.php';
require_once __DIR__ . '/../model/HabitacionPaqueteH.php';

class HabitacionPaqueteAPIController {

    private $dao;

    public function __construct() {
        $this->dao = new HabitacionPaqueteDAO();
    }

    public function manejarRequest() {
        $metodo = $_SERVER['REQUEST_METHOD'];

        switch ($metodo) {
            case 'GET':
                echo json_encode($this->dao->obtenerDatos());
                break;

            case 'POST':
                $datos = json_decode(file_get_contents("php://input"), true);

                $objeto = new HabitacionPaqueteH(
                    $datos['idHabitacion'],
                    $datos['idPaquete']
                );

                $this->dao->insertar($objeto);
                echo json_encode(["mensaje" => "Registro insertado correctamente"]);
                break;

            case 'PUT':
                // Validacion simple para evitar errores si faltan datos
                $datos = json_decode(file_get_contents("php://input"), true);


                if (!isset($datos['idHabitacionAnterior']) || !isset($datos['idPaqueteAnterior']) ||
                    !isset($datos['idHabitacion']) || !isset($datos['idPaquete'])) {
                    echo json_encode(["error" => "Faltan datos para modificar"]);
                    return;
                }

                $objeto = new HabitacionPaqueteH(
                    $datos['idHabitacion'],
                    $datos['idPaquete']
                );

                $this->dao->modificar($objeto, $datos['idHabitacionAnterior'], $datos['idPaqueteAnterior']);
                echo json_encode(["mensaje" => "Registro modificado correctamente"]);
                break;

            case 'DELETE':
                $datos = json_decode(file_get_contents("php://input"), true);


                if (!isset($datos['idHabitacion']) || !isset($datos['idPaquete'])) {
                    echo json_encode(["error" => "Faltan datos para eliminar"]);
                    return;
                }

                $this->dao->eliminar($datos['idHabitacion'], $datos['idPaquete']);
                echo json_encode(["mensaje" => "Registro eliminado correctamente"]);
                break;

            default:
                http_response_code(405);
                echo json_encode(["error" => "Metodo no permitido"]);
                break;
        }
    }
}
?>
