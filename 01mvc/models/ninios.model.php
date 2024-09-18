<?php


require_once '../config/conexion.php';

class NiniosModel
{

    public function todos()
    {
        $con = new ClaseConexion();
        $con = $con->ProcedimientoConectar();
        $cadena = "SELECT n.idNinio, n.Nombre, n.Apellido, n.Fecha_nacimiento, c.Nombre as NombreCuidador, c.idCuidador FROM ninios n JOIN cuidadores c ON n.idCuidador = c.idCuidador";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }

    public function uno($idNinio)
    {
        $con = new ClaseConexion();
        $con = $con->ProcedimientoConectar();
        $cadena = "SELECT * FROM `Ninios` WHERE `idNinio` = $idNinio";
        // $cadena = "SELECT n.idNinio, n.Nombre, n.Apellido, n.Fecha_nacimiento, c.Nombre as Cuidador, c.idCuidador FROM ninios n JOIN cuidadores c ON n.idCuidador = c.idCuidador WHERE idNinio = $idNinio";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }

    public function insertar($Nombre, $Apellido, $Fecha_nacimiento, $alergias, $idCuidador)
    {
        try {
            $con = new ClaseConexion();
            $con = $con->ProcedimientoConectar();
            $cadena = "INSERT INTO `Ninios` (`Nombre`, `Apellido`, `Fecha_nacimiento`, `alergias`, `idCuidador`) VALUES ('$Nombre', '$Apellido', '$Fecha_nacimiento', '$alergias', '$idCuidador')";
            if (mysqli_query($con, $cadena)) {
                $idNinio = $con->insert_id;

                $asignacion = "INSERT INTO Asignaciones (idNinio, idCuidador, fecha_asignacion) VALUES ($idNinio, $idCuidador, CURDATE())";
                if (mysqli_query($con, $asignacion)) {
                    return $idNinio;
                } else {
                    return $con->error;
                }
            } else {
                return $con->error;
            }
        } catch (Exception $e) {
            return $e->getMessage();
        } finally {
            $con->close();
        }
    }

    public function actualizar($idNinio, $Nombre, $Apellido, $Fecha_nacimiento, $alergias, $idCuidador)
    {
        try {
            $con = new ClaseConexion();
            $con = $con->ProcedimientoConectar();
            $cadena = "UPDATE `Ninios` SET `Nombre` = '$Nombre', `Apellido` = '$Apellido', `Fecha_nacimiento` = '$Fecha_nacimiento', `alergias` = '$alergias', `idCuidador` = '$idCuidador' WHERE `idNinio` = $idNinio";
            if (mysqli_query($con, $cadena)) {
                // $cadenaCuidador = "SELECT idCuidador FROM `Ninios` WHERE `idNinio` = $idNinio";
                // $res = mysqli_query($con, $cadenaCuidador);
                // $cuidador = mysqli_fetch_array($res);
                // if ($cuidador['idCuidador'] != $idCuidador) {
                //     $asignacion = "INSERT INTO Asignaciones (idNinio, idCuidador, fecha_asignacion) VALUES ($idNinio, $idCuidador, CURDATE())";
                //     mysqli_query($con, $asignacion);
                //     $cuidador['idCuidador'] = $idCuidador;
                // } else {
                //     echo "No se ha modificado el cuidador";
                // }
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
