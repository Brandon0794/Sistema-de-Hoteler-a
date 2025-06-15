<?php
// === UsuarioAPIController.php ===
require_once __DIR__.'/../accessData/UsuarioDAO.php';
require_once __DIR__.'/../model/UsuarioH.php';

class UsuarioAPIController {

    private $dao;

    public function __construct() {
        $this->dao = new UsuarioDAO();
    }

    public function manejarRequest() {
        $metodo = $_SERVER['REQUEST_METHOD'];

        switch ($metodo) {
            case 'GET':
                // Obtener todos los usuarios
                $data = $this->dao->obtenerDatos();
                echo json_encode($data);
                break;

            case 'POST':
                // Insertar nuevo usuario
                $datos = json_decode(file_get_contents("php://input"), true);

                $objeto = new UsuarioH(
                    null,
                    $datos['nombreUsuario'],
                    $datos['claveHash'],
                    $datos['rol'],
                    $datos['estado']
                );

                $this->dao->insertar($objeto);
                echo json_encode(["mensaje" => "Usuario insertado"]);
                break;

            case 'PUT':
                // Actualizar usuario existente
                $datos = json_decode(file_get_contents("php://input"), true);


                // Validar campos requeridos
                if (!isset($datos['idUsuario']) || !isset($datos['nombreUsuario']) || !isset($datos['claveHash']) || !isset($datos['rol']) || !isset($datos['estado'])) {
                    echo json_encode(["error" => "Faltan datos para modificar"]);
                    return;
                }

                $objeto = new UsuarioH(
                    $datos['idUsuario'],
                    $datos['nombreUsuario'],
                    $datos['claveHash'],
                    $datos['rol'],
                    $datos['estado']
                );

                $this->dao->modificar($objeto);
                echo json_encode(["mensaje" => "Usuario modificado"]);
                break;

            case 'DELETE':
                // Eliminar usuario
                parse_str(file_get_contents("php://input"), $datos);
                $this->dao->eliminar($datos['idUsuario']);
                echo json_encode(["mensaje" => "Usuario eliminado"]);
                break;

            default:
                http_response_code(405);
                echo json_encode(["error" => "Metodo no permitido"]);
                break;
        }
    }
}
?>
