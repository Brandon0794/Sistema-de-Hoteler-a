<?php

require_once __DIR__ . '/../accessData/HabitacionDAO.php';
require_once __DIR__ . '/../model/HabitacionH.php';

class HabitacionAPIController {

    private $dao;

    public function __construct() {
        $this->dao = new HabitacionDAO();
    }

    public function manejarRequest() {
        $metodo = $_SERVER['REQUEST_METHOD'];

        switch ($metodo) {
            case 'GET':
                // Obtener todos los registros
                echo json_encode($this->dao->obtenerDatos());
                break;

            case 'POST':
                $datos = json_decode(file_get_contents("php://input"), true);

                // Validacion: se comprueba que todos los datos obligatorios vienen en la solicitud
                if (!isset($datos['numero']) || !isset($datos['idTipo']) || !isset($datos['precio'])) {
                    echo json_encode(["error" => "Faltan datos para insertar"]);
                    return;
                }

                $habitacion = new HabitacionH(
                    null,
                    $datos['numero'],
                    $datos['idTipo'],
                    $datos['precio']
                );

                $this->dao->insertar($habitacion);
                echo json_encode(["mensaje" => "Habitacion insertada correctamente"]);
                break;

            case 'PUT':
                $datos = json_decode(file_get_contents("php://input"), true);

                // Validacion: se asegura que los campos requeridos existen antes de procesar
                if (!isset($datos['idHabitacion']) || !isset($datos['numero']) || !isset($datos['idTipo']) || !isset($datos['precio'])) {
                    echo json_encode(["error" => "Faltan datos para modificar"]);
                    return;
                }

                $habitacion = new HabitacionH(
                    $datos['idHabitacion'],
                    $datos['numero'],
                    $datos['idTipo'],
                    $datos['precio']
                );

                $this->dao->modificar($habitacion);
                echo json_encode(["mensaje" => "Habitacion modificada correctamente"]);
                break;

            case 'DELETE':
                $datos = json_decode(file_get_contents("php://input"), true);


                // Validacion: se verifica que se haya recibido el id para eliminar
                if (!isset($datos['idHabitacion'])) {
                    echo json_encode(["error" => "Falta el id para eliminar"]);
                    return;
                }

                $this->dao->eliminar($datos['idHabitacion']);
                echo json_encode(["mensaje" => "Habitacion eliminada correctamente"]);
                break;

            default:
                http_response_code(405);
                echo json_encode(["error" => "Metodo no permitido"]);
                break;
        }
    }
}
