<?php
// === TipoHabitacionAPIController.php ===
require_once __DIR__.'/../accessData/TipoHabitacionDAO.php';
require_once __DIR__.'/../model/TipoHabitacionH.php';

class TipoHabitacionAPIController {

    private $dao;

    public function __construct() {
        $this->dao = new TipoHabitacionDAO();
    }

    public function manejarRequest() {
        $metodo = $_SERVER['REQUEST_METHOD'];

        switch ($metodo) {
            case 'GET':
                // Obtener todos los registros
                $data = $this->dao->obtenerDatos();
                echo json_encode($data);
                break;

            case 'POST':
                // Insertar nuevo registro
                $datos = json_decode(file_get_contents("php://input"), true);

                $objeto = new TipoHabitacionH(
                    null,
                    $datos['nombre'],
                    $datos['descripcion']
                );

                $this->dao->insertar($objeto);
                echo json_encode(["mensaje" => "Tipo habitacion insertado"]);
                break;

            case 'PUT':
                // Actualizar registro existente
                parse_str(file_get_contents("php://input"), $datos);

                // Validar campos requeridos
                if (!isset($datos['idTipo']) || !isset($datos['nombre']) || !isset($datos['descripcion'])) {
                    echo json_encode(["error" => "Faltan datos para modificar"]);
                    return;
                }

                $objeto = new TipoHabitacionH(
                    $datos['idTipo'],
                    $datos['nombre'],
                    $datos['descripcion']
                );

                $this->dao->modificar($objeto);
                echo json_encode(["mensaje" => "Tipo habitacion modificado"]);
                break;

            case 'DELETE':
                // Eliminar registro
                parse_str(file_get_contents("php://input"), $datos);
                $this->dao->eliminar($datos['idTipo']);
                echo json_encode(["mensaje" => "Tipo habitacion eliminado"]);
                break;

            default:
                http_response_code(405);
                echo json_encode(["error" => "Metodo no permitido"]);
                break;
        }
    }
}
?>
