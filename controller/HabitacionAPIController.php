<?php
require_once __DIR__ . '/../utils/validaciones.php';
require_once __DIR__ . '/../accessData/HabitacionDAO.php';
require_once __DIR__ . '/../model/HabitacionH.php';

class HabitacionAPIController
{

    private $dao;

    public function __construct()
    {
        $this->dao = new HabitacionDAO();
    }

    public function manejarRequest()
    {
        $metodo = $_SERVER['REQUEST_METHOD'];

        switch ($metodo) {
            case 'GET':
                // Obtener todos los registros
                echo json_encode($this->dao->obtenerDatos());
                break;

            case 'POST':
                // se obtiene el cuerpo del request en formato json
                $datos = json_decode(file_get_contents("php://input"), true);

                // se validan los campos requeridos antes de insertar
                $validacion = validarCampos($datos, ['numero', 'idTipo', 'precio']);
                if ($validacion !== true) {
                    echo json_encode(["error" => $validacion]);
                    return;
                }

                // se crea el objeto habitacion sin id porque es autoincremental
                $habitacion = new HabitacionH(
                    null,
                    $datos['numero'],
                    $datos['idTipo'],
                    $datos['precio']
                );

                $this->dao->insertar($habitacion);
                echo json_encode(["mensaje" => "habitacion insertada correctamente"]);
                break;


            case 'PUT':
                // se obtiene el cuerpo como si fuera un formulario codificado
                parse_str(file_get_contents("php://input"), $datos);

                // se validan los campos requeridos para modificar
                $validacion = validarCampos($datos, ['idHabitacion', 'numero', 'idTipo', 'precio']);
                if ($validacion !== true) {
                    echo json_encode(["error" => $validacion]);
                    return;
                }

                // se crea el objeto habitacion con los datos recibidos
                $habitacion = new HabitacionH(
                    $datos['idHabitacion'],
                    $datos['numero'],
                    $datos['idTipo'],
                    $datos['precio']
                );

                $this->dao->modificar($habitacion);
                echo json_encode(["mensaje" => "habitacion modificada correctamente"]);
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
