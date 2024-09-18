<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
$method = $_SERVER["REQUEST_METHOD"];
if ($method == "OPTIONS") {
    die();
}

require_once '../models/ninios.model.php';
error_reporting(0);

$ninios = new NiniosModel();

switch ($_GET['op']) {
    case 'todos':
        $datos = array();
        $datos = $ninios->todos();
        while ($row = mysqli_fetch_assoc($datos)) {
            $todos[] = $row;
        }
        echo json_encode($todos);
        break;

    case 'uno':
        if (!isset($_POST['idNinio'])) {
            echo json_encode(["error" => "Missing 'idNinio' parameter."]);
        }

        $idNinio = $_POST['idNinio'];
        $datos = array();
        $datos = $ninios->uno($idNinio);
        $res = mysqli_fetch_assoc($datos);
        echo json_encode($res);
        break;

    case 'insertar':
        if (!isset($_POST['nombre']) || !isset($_POST['apellido']) || !isset($_POST['fecha_nacimiento']) || !isset($_POST['alergias'])) {
            echo json_encode(["error" => "Missing required parameters."]);
        }

        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $fecha_nacimiento = $_POST['fecha_nacimiento'];
        $alergias = $_POST['alergias'];
        $datos = array();
        $datos = $ninios->insertar($nombre, $apellido, $fecha_nacimiento, $alergias);
        echo json_encode($datos);
        break;

    case 'actualizar':
        if (!isset($_POST['idNinio']) || !isset($_POST['nombre']) || !isset($_POST['apellido']) || !isset($_POST['fecha_nacimiento']) || !isset($_POST['alergias'])) {
            echo json_encode(["error" => "Missing required parameters."]);
        }

        $idNinio = $_POST['idNinio'];
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $fecha_nacimiento = $_POST['fecha_nacimiento'];
        $alergias = $_POST['alergias'];
        $datos = array();
        $datos = $ninios->actualizar($idNinio, $nombre, $apellido, $fecha_nacimiento, $alergias);
        echo json_encode($datos);
        break;

    case 'eliminar':
        if (!isset($_POST['idNinio'])) {
            echo json_encode(["error" => "Missing 'idNinio' parameter."]);
        }

        $idNinio = $_POST['idNinio'];
        $datos = array();
        $datos = $ninios->eliminar($idNinio);
        echo json_encode($datos);
        break;

    default:
        echo json_encode(["error:" => "Invalid operation."]);
}
