<?php

require_once '../config/conexion.php';

class CuidadoresModel
{

    // idCuidador INT AUTO_INCREMENT PRIMARY KEY,
    // Nombre VARCHAR(50) NOT NULL,
    // Especialidad VARCHAR(50) NOT NULL,
    // Telefono VARCHAR(20),
    // Email VARCHAR(100) UNIQUE

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
        $cadena = "SELECT * FROM cuidadores WHERE idCuidador = $idCuidador";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }

    public function insertar($Nombre, $Especialidad, $Telefono, $Email)
    {
        try {
            $con = new ClaseConexion();
            $con = $con->ProcedimientoConectar();
            $cadena = "INSERT INTO cuidadores (Nombre, Especialidad, Telefono, Email) VALUES ('$Nombre', '$Especialidad', '$Telefono', '$Email')";
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

    public function actualizar($idCuidador, $Nombre, $Especialidad, $Telefono, $Email)
    {
        try {
            $con = new ClaseConexion();
            $con = $con->ProcedimientoConectar();
            $cadena = "UPDATE cuidadores SET Nombre='$Nombre', Especialidad='$Especialidad', Telefono='$Telefono', Email='$Email' WHERE idCuidador=$idCuidador";
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
            $cadena = "DELETE FROM cuidadores WHERE idCuidador=$idCuidador";
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
