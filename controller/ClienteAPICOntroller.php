<?php

require_once __DIR__.'/../accessData/ClientesDAO.php';
require_once __DIR__.'/../model/ClienteH.php';

class ClientesApiController{


    private $dao;

    public function __construct(){
        $this->dao = new ClientesDAO();
    }

    public function manejarRequest(){
        $metodo = $_SERVER['REQUEST_METHOD'];

        //POST, GET, PUT DELETE
        switch ($metodo) 
        {

            case 'GET':
                // Obtener todos
                $clientes = $this->dao->obtenerDatos();
                echo json_encode($clientes);
                break;

            case 'POST':
                // Insertar
                $datos = json_decode(file_get_contents("php://input"), true);

                $nombre = $datos['nombre'];
                $correo = $datos['correo'];

                $cliente = new ClienteH(null, $nombre, $correo);
                $this->dao->insertar($cliente);

                echo json_encode(["mensaje" => "Cliente insertado correctamente"]);
                break;

           case 'PUT':
    // Extraer datos como si fuera formulario: idCliente=1&nombre=...&correo=...
    parse_str(file_get_contents("php://input"), $datos);

    // Validación previa
    if (!isset($datos['idCliente']) || !isset($datos['nombre']) || !isset($datos['correo'])) {
        echo json_encode(["error" => "Faltan datos para modificar"]);
        return;
    }

    $idCliente = $datos['idCliente'];
    $nombre = $datos['nombre'];
    $correo = $datos['correo'];

    $cliente = new ClienteH($idCliente, $nombre, $correo);
    $this->dao->modificar($cliente);

    echo json_encode(["mensaje" => "Cliente modificado correctamente"]);
    break;


            case 'DELETE':
                // Eliminar
                parse_str(file_get_contents("php://input"), $datos);
                $idCliente = $datos['idCliente'];

                $this->dao->eliminar($idCliente);

                echo json_encode(["mensaje" => "Cliente eliminado correctamente"]);
                break;

            default:
                http_response_code(405);
                echo json_encode(["error" => "Método no permitido"]);
                break;
        }
        
    }


}

?>