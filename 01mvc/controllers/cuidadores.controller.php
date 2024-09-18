<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
$method = $_SERVER["REQUEST_METHOD"];
if ($method == "OPTIONS") {
    die();
}

require_once '../models/cuidadores.model.php';
error_reporting(0);

$cuidadores = new CuidadoresModel();

switch ($_GET['op']) {
    case 'todos':
        $datos = array();
        $datos = $cuidadores->todos();
        while ($row = mysqli_fetch_assoc($datos)) {
            $todos[] = $row;
        }
        echo json_encode($todos);
        break;

    case 'uno':
        if (!isset($_POST['cuidador_id'])) {
            echo json_encode(["error:" => "Missing 'cuidador_id' parameter."]);
        }
        $cuidador_id = $_POST['cuidador_id'];
        $datos = array();
        $datos = $cuidadores->uno($cuidador_id);
        $res = mysqli_fetch_assoc($datos);
        echo json_encode($res);
        break;

    case 'insertar':
        if (!isset($_POST['nombre'], $_POST['especialidad'], $_POST['telefono'], $_POST['email'], $_POST['idNinio'])) {
            echo json_encode(["error:" => "Missing required parameters."]);
            break;
        }

        $nombre = $_POST['nombre'];
        $especialidad = $_POST['especialidad'];
        $telefono = $_POST['telefono'];
        $email = $_POST['email'];
        $idNinio = $_POST['idNinio'];
        $datos = array();
        $datos = $cuidadores->insertar($nombre, $especialidad, $telefono, $email, $idNinio);
        echo json_encode($datos);
        break;

    case 'actualizar':
        if (!isset($_POST['cuidador_id'], $_POST['nombre'], $_POST['especialidad'], $_POST['telefono'], $_POST['email'], $_POST['idNinio'])) {
            echo json_encode(["error:" => "Missing required parameters."]);
            break;
        }
        $cuidador_id = $_POST['cuidador_id'];
        $nombre = $_POST['nombre'];
        $especialidad = $_POST['especialidad'];
        $telefono = $_POST['telefono'];
        $email = $_POST['email'];
        $idNinio = $_POST['idNinio'];
        $datos = array();
        $datos = $cuidadores->actualizar($cuidador_id, $nombre, $especialidad, $telefono, $email, $idNinio);
        echo json_encode($datos);
        break;

    case 'eliminar':
        if (!isset($_POST['cuidador_id'])) {
            echo json_encode(["error:" => "Missing 'cuidador_id' parameter."]);
            break;
        }
        $cuidador_id = $_POST['cuidador_id'];
        $datos = array();
        $datos = $cuidadores->eliminar($cuidador_id);
        echo json_encode($datos);
        break;

    default:
        echo json_encode(["error:" => "Invalid operation."]);
}
