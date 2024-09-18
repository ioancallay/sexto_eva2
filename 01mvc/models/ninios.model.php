<?php


require_once '../config/conexion.php';

class NiniosModel
{

    public function todos()
    {
        $con = new ClaseConexion();
        $con = $con->ProcedimientoConectar();
        $cadena = "SELECT * FROM `ninios`";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }

    public function uno($idNinio)
    {
        $con = new ClaseConexion();
        $con = $con->ProcedimientoConectar();
        $cadena = "SELECT * FROM `ninios` WHERE `idNinio` = $idNinio";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }


    // ninio_id INT AUTO_INCREMENT PRIMARY KEY,
    // nombre VARCHAR(50) NOT NULL,
    // apellido VARCHAR(50) NOT NULL,
    // fecha_nacimiento DATE NOT NULL,
    // alergias TEXT

    public function insertar($nombre, $apellido, $fecha_nacimiento, $alergias)
    {
        try {
            $con = new ClaseConexion();
            $con = $con->ProcedimientoConectar();
            $cadena = "INSERT INTO `ninios` (`nombre`, `apellido`, `fecha_nacimiento`, `alergias`) VALUES ('$nombre', '$apellido', '$fecha_nacimiento', '$alergias')";
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
            $cadena = "UPDATE `ninios` SET `nombre` = '$nombre', `apellido` = '$apellido', `fecha_nacimiento` = '$fecha_nacimiento', `alergias` = '$alergias' WHERE `idNinio` = $idNinio";
            if (mysqli_query($con, $cadena)) {
                return true;
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
            $cadena = "DELETE FROM `ninios` WHERE `idNinio` = $idNinio";
            if (mysqli_query($con, $cadena)) {
                return true;
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
