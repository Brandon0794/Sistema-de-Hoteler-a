<?php

require_once __DIR__ . '/../accessData/DetalleReservacionDAO.php';
require_once __DIR__ . '/../model/DetalleReservacionH.php';

class DetalleReservacionAPIController {

    private $dao;

    public function __construct() {
        $this->dao = new DetalleReservacionDAO();
    }

    public function manejarRequest() {
        $metodo = $_SERVER['REQUEST_METHOD'];

        switch ($metodo) {

            case 'GET':
                // Obtener todos los detalles
                echo json_encode($this->dao->obtenerDatos());
                break;

            case 'POST':
                // Insertar nuevo detalle
                $datos = json_decode(file_get_contents("php://input"), true);

                if (!isset($datos['idReservacion'], $datos['idHabitacion'])) {
                    echo json_encode(["error" => "Faltan datos para insertar"]);
                    return;
                }

                $objeto = new DetalleReservacionH(
                    null,
                    $datos['idReservacion'],
                    $datos['idHabitacion']
                );

                $this->dao->insertar($objeto);
                echo json_encode(["mensaje" => "Detalle insertado correctamente"]);
                break;

            case 'PUT':
                // Modificar detalle existente
                $datos = json_decode(file_get_contents("php://input"), true);

                if (!isset($datos['idDetalle'], $datos['idReservacion'], $datos['idHabitacion'])) {
                    echo json_encode(["error" => "Faltan datos para modificar"]);
                    return;
                }

                $objeto = new DetalleReservacionH(
                    $datos['idDetalle'],
                    $datos['idReservacion'],
                    $datos['idHabitacion']
                );

                $this->dao->modificar($objeto);
                echo json_encode(["mensaje" => "Detalle modificado correctamente"]);
                break;

            case 'DELETE':
                // Eliminar detalle
                parse_str(file_get_contents("php://input"), $datos);

                if (!isset($datos['idDetalle'])) {
                    echo json_encode(["error" => "Falta idDetalle para eliminar"]);
                    return;
                }

                $this->dao->eliminar($datos['idDetalle']);
                echo json_encode(["mensaje" => "Detalle eliminado correctamente"]);
                break;

            default:
                http_response_code(405);
                echo json_encode(["error" => "Método no permitido"]);
                break;
        }
    }
}
