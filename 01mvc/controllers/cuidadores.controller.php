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
        if (!isset($_POST['Nombre'], $_POST['Especialidad'], $_POST['Telefono'], $_POST['Email'])) {
            echo json_encode(["error:" => "Missing required parameters."]);
            break;
        }

        $Nombre = $_POST['Nombre'];
        $Especialidad = $_POST['Especialidad'];
        $Telefono = $_POST['Telefono'];
        $Email = $_POST['Email'];
        $datos = array();
        $datos = $cuidadores->insertar($Nombre, $Especialidad, $Telefono, $Email);
        echo json_encode($datos);
        break;

    case 'actualizar':
        if (!isset($_POST['idCuidador'], $_POST['Nombre'], $_POST['Especialidad'], $_POST['Telefono'], $_POST['Email'])) {
            echo json_encode(["error:" => "Missing required parameters."]);
            break;
        }
        $idCuidador = $_POST['idCuidador'];
        $Nombre = $_POST['Nombre'];
        $Especialidad = $_POST['Especialidad'];
        $Telefono = $_POST['Telefono'];
        $Email = $_POST['Email'];
        $datos = array();
        $datos = $cuidadores->actualizar($idCuidador, $Nombre, $Especialidad, $Telefono, $Email);
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
