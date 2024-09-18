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
        if (!isset($_POST['idCuidador'])) {
            echo json_encode(["error:" => "Missing 'idCuidador' parameter."]);
        }
        $idCuidador = $_POST['idCuidador'];
        $datos = array();
        $datos = $cuidadores->uno($idCuidador);
        $res = mysqli_fetch_assoc($datos);
        echo json_encode($res);
        break;

    case 'insertar':
        if (!isset($_POST['nombre'], $_POST['especialidad'], $_POST['telefono'], $_POST['email'])) {
            echo json_encode(["error:" => "Missing required parameters."]);
            break;
        }

        $nombre = $_POST['nombre'];
        $especialidad = $_POST['especialidad'];
        $telefono = $_POST['telefono'];
        $email = $_POST['email'];
        $datos = array();
        $datos = $cuidadores->insertar($nombre, $especialidad, $telefono, $email);
        echo json_encode($datos);
        break;

    case 'actualizar':
        if (!isset($_POST['idCuidador'], $_POST['nombre'], $_POST['especialidad'], $_POST['telefono'], $_POST['email'], $_POST['idNinio'])) {
            echo json_encode(["error:" => "Missing required parameters."]);
            break;
        }
        $idCuidador = $_POST['idCuidador'];
        $nombre = $_POST['nombre'];
        $especialidad = $_POST['especialidad'];
        $telefono = $_POST['telefono'];
        $email = $_POST['email'];
        $idNinio = $_POST['idNinio'];
        $datos = array();
        $datos = $cuidadores->actualizar($idCuidador, $nombre, $especialidad, $telefono, $email, $idNinio);
        echo json_encode($datos);
        break;

    case 'eliminar':
        if (!isset($_POST['idCuidador'])) {
            echo json_encode(["error:" => "Missing 'idCuidador' parameter."]);
            break;
        }
        $idCuidador = $_POST['idCuidador'];
        $datos = array();
        $datos = $cuidadores->eliminar($idCuidador);
        echo json_encode($datos);
        break;

    default:
        echo json_encode(["error:" => "Invalid operation."]);
}
