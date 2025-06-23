<?php
require_once __DIR__ . '/../utils/validaciones.php';
require_once __DIR__ . '/../accessData/DetalleReservacionDAO.php';
require_once __DIR__ . '/../model/DetalleReservacionH.php';

class DetalleReservacionAPIController
{

    private $dao;

    public function __construct()
    {
        $this->dao = new DetalleReservacionDAO();
    }

    public function manejarRequest()
    {
        $metodo = $_SERVER['REQUEST_METHOD'];

        switch ($metodo) {

            case 'GET':
                // Obtener todos los detalles
                echo json_encode($this->dao->obtenerDatos());
                break;

            case 'POST':
                // se obtiene el cuerpo del request en formato json
                $datos = json_decode(file_get_contents("php://input"), true);

                // se validan los campos requeridos antes de insertar
                $validacion = validarCampos($datos, ['idReservacion', 'idHabitacion']);
                if ($validacion !== true) {
                    // si falta algun campo, se responde con un mensaje de error
                    echo json_encode(["error" => $validacion]);
                    return;
                }

                // se crea el objeto detalle con id null porque es autoincremental
                $detalle = new DetalleReservacionH(
                    null,
                    $datos['idReservacion'],
                    $datos['idHabitacion']
                );

                // se llama al dao para insertar el detalle
                $this->dao->insertar($detalle);

                // se devuelve mensaje de exito
                echo json_encode(["mensaje" => "detalle insertado correctamente"]);
                break;


            case 'PUT':
                // se obtiene el cuerpo como si fuera formulario codificado
                parse_str(file_get_contents("php://input"), $datos);

                // se validan los campos requeridos para modificar
                $validacion = validarCampos($datos, ['idDetalle', 'idReservacion', 'idHabitacion']);
                if ($validacion !== true) {
                    echo json_encode(["error" => $validacion]);
                    return;
                }

                // se crea el objeto detalle con los datos recibidos
                $detalle = new DetalleReservacionH(
                    $datos['idDetalle'],
                    $datos['idReservacion'],
                    $datos['idHabitacion']
                );

                // se llama al dao para realizar la modificacion
                $this->dao->modificar($detalle);

                // se devuelve mensaje de exito
                echo json_encode(["mensaje" => "detalle modificado correctamente"]);
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
