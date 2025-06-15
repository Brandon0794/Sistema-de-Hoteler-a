<?php
// === ServicioExtraApiController.php ===
require_once __DIR__.'/../accessData/ServicioExtraDAO.php';
require_once __DIR__.'/../model/ServicioExtraH.php';

class ServicioExtraAPIController {

    private $dao;

    public function __construct() {
        $this->dao = new ServicioExtraDAO();
    }

    public function manejarRequest() {
        $metodo = $_SERVER['REQUEST_METHOD'];

        switch ($metodo) {
            case 'GET':
                // Obtener todos los servicios extra
                $data = $this->dao->obtenerDatos();
                echo json_encode($data);
                break;

            case 'POST':
                // Insertar nuevo servicio extra
                $datos = json_decode(file_get_contents("php://input"), true);

                $objeto = new ServicioExtraH(
                    null,
                    $datos['nombre'],
                    $datos['descripcion']
                );

                $this->dao->insertar($objeto);
                echo json_encode(["mensaje" => "Servicio extra insertado"]);
                break;

            case 'PUT':
                // Actualizar servicio extra
                $datos = json_decode(file_get_contents("php://input"), true);


                // Validar que existan los campos requeridos
                if (!isset($datos['idServicio']) || !isset($datos['nombre']) || !isset($datos['descripcion'])) {
                    echo json_encode(["error" => "Faltan datos para modificar"]);
                    return;
                }

                $objeto = new ServicioExtraH(
                    $datos['idServicio'],
                    $datos['nombre'],
                    $datos['descripcion']
                );

                $this->dao->modificar($objeto);
                echo json_encode(["mensaje" => "Servicio extra modificado"]);
                break;

            case 'DELETE':
                // Eliminar servicio extra
                $datos = json_decode(file_get_contents("php://input"), true);

                $this->dao->eliminar($datos['idServicio']);
                echo json_encode(["mensaje" => "Servicio extra eliminado"]);
                break;

            default:
                http_response_code(405);
                echo json_encode(["error" => "Metodo no permitido"]);
                break;
        }
    }
}
?>
