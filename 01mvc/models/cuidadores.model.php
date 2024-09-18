<?php

require_once '../config/conexion.php';

class CuidadoresModel
{

    // cuidador_id INT AUTO_INCREMENT PRIMARY KEY,
    // nombre VARCHAR(50) NOT NULL,
    // especialidad VARCHAR(50) NOT NULL,
    // telefono VARCHAR(20),
    // email VARCHAR(100) UNIQUE

    public function todos()
    {
        $con = new ClaseConexion();
        $con = $con->ProcedimientoConectar();
        $cadena = "SELECT * FROM cuidadores";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }

    public function uno($idCuidador)
    {
        $con = new ClaseConexion();
        $con = $con->ProcedimientoConectar();
        $cadena = "SELECT * FROM cuidadores WHERE cuidador_id = $idCuidador";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }

    public function insertar($nombre, $especialidad, $telefono, $email, $idNinio)
    {
        try {
            $con = new ClaseConexion();
            $con = $con->ProcedimientoConectar();
            $cadena = "INSERT INTO cuidadores (nombre, especialidad, telefono, email) VALUES ('$nombre', '$especialidad', '$telefono', '$email')";
            if (mysqli_query($con, $cadena)) {
                $ninioId = $con->insert_id;

                $asignacion = "INSERT INTO asignaciones (ninio_id, cuidador_id, fecha_asignacion) VALUES ($idNinio, $ninioId, CURDATE())";
                if (mysqli_query($con, $asignacion)) {
                    return $ninioId;
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

    public function actualizar($idCuidador, $nombre, $especialidad, $telefono, $email, $idNinio)
    {
        try {
            $con = new ClaseConexion();
            $con = $con->ProcedimientoConectar();
            $cadena = "UPDATE cuidadores SET nombre='$nombre', especialidad='$especialidad', telefono='$telefono', email='$email' WHERE cuidador_id=$idCuidador";
            if (mysqli_query($con, $cadena)) {
                return $con->insert_id;
            } else {
                return $idCuidador;
            }
        } catch (Exception $e) {
            return $e->getMessage();
        } finally {
            $con->close();
        }
    }

    public function eliminar($idCuidador)
    {
        try {
            $con = new ClaseConexion();
            $con = $con->ProcedimientoConectar();
            $cadena = "DELETE FROM cuidadores WHERE cuidador_id=$idCuidador";
            if (mysqli_query($con, $cadena)) {
                return $idCuidador;
            } else {
                return false;
            }
        } catch (Exception $e) {
            return $e->getMessage();
        } finally {
            $con->close();
        }
    }
}
