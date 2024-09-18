<?php


require_once '../config/conexion.php';

class NiniosModel
{

    public function todos()
    {
        $con = new ClaseConexion();
        $con = $con->ProcedimientoConectar();
        $cadena = "SELECT * FROM `Ninios`";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }

    public function uno($idNinio)
    {
        $con = new ClaseConexion();
        $con = $con->ProcedimientoConectar();
        $cadena = "SELECT * FROM `Ninios` WHERE `idNinio` = $idNinio";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }

    public function insertar($nombre, $apellido, $fecha_nacimiento, $alergias)
    {
        try {
            $con = new ClaseConexion();
            $con = $con->ProcedimientoConectar();
            $cadena = "INSERT INTO `Ninios` (`nombre`, `apellido`, `fecha_nacimiento`, `alergias`) VALUES ('$nombre', '$apellido', '$fecha_nacimiento', '$alergias')";
            if (mysqli_query($con, $cadena)) {
                return $con->insert_id;
            } else {
                return $con->error;
            }
        } catch (Exception $e) {
            return $e->getMessage();
        } finally {
            $con->close();
        }
    }

    public function actualizar($idNinio, $nombre, $apellido, $fecha_nacimiento, $alergias)
    {
        try {
            $con = new ClaseConexion();
            $con = $con->ProcedimientoConectar();
            $cadena = "UPDATE `Ninios` SET `nombre` = '$nombre', `apellido` = '$apellido', `fecha_nacimiento` = '$fecha_nacimiento', `alergias` = '$alergias' WHERE `idNinio` = $idNinio";
            if (mysqli_query($con, $cadena)) {
                return $idNinio;
            } else {
                return $con->error;
            }
        } catch (Exception $e) {
            return $e->getMessage();
        } finally {
            $con->close();
        }
    }

    public function eliminar($idNinio)
    {
        try {
            $con = new ClaseConexion();
            $con = $con->ProcedimientoConectar();
            $cadena = "DELETE FROM `Ninios` WHERE `idNinio` = $idNinio";
            if (mysqli_query($con, $cadena)) {
                return $idNinio;
            } else {
                return $con->error;
            }
        } catch (Exception $e) {
            return $e->getMessage();
        } finally {
            $con->close();
        }
    }
}
