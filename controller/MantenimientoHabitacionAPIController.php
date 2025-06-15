<?php

require_once __DIR__ . '/../accessData/MantenimientoHabitacionDAO.php';
require_once __DIR__ . '/../model/MantenimientoHabitacionH.php';

class MantenimientoHabitacionAPIController {

    private $dao;

    public function __construct() {
        $this->dao = new MantenimientoHabitacionDAO();
    }

    public function manejarRequest() {
        $metodo = $_SERVER['REQUEST_METHOD'];

        switch ($metodo) {
            case 'GET':
                echo json_encode($this->dao->obtenerDatos());
                break;

            case 'POST':
                $datos = json_decode(file_get_contents("php://input"), true);

                $objeto = new MantenimientoHabitacionH(
                    null,
                    $datos['idHabitacion'],
                    $datos['descripcion'],
                    $datos['fecha']
                );

                $this->dao->insertar($objeto);
                echo json_encode(["mensaje" => "Mantenimiento insertado correctamente"]);
                break;

            case 'PUT':
                parse_str(file_get_contents("php://input"), $datos);

                // Validar que los datos requeridos esten presentes
                if (!isset($datos['idMantenimiento']) || !isset($datos['idHabitacion']) || !isset($datos['descripcion']) || !isset($datos['fecha'])) {
                    echo json_encode(["error" => "Faltan datos para modificar"]);
                    return;
                }

                $objeto = new MantenimientoHabitacionH(
                    $datos['idMantenimiento'],
                    $datos['idHabitacion'],
                    $datos['descripcion'],
                    $datos['fecha']
                );

                $this->dao->modificar($objeto);
                echo json_encode(["mensaje" => "Mantenimiento modificado correctamente"]);
                break;

            case 'DELETE':
                parse_str(file_get_contents("php://input"), $datos);

                // Validar que se haya enviado el ID
                if (!isset($datos['idMantenimiento'])) {
                    echo json_encode(["error" => "Falta el ID para eliminar"]);
                    return;
                }

                $this->dao->eliminar($datos['idMantenimiento']);
                echo json_encode(["mensaje" => "Mantenimiento eliminado correctamente"]);
                break;

            default:
                http_response_code(405);
                echo json_encode(["error" => "Metodo no permitido"]);
                break;
        }
    }
}
?>
