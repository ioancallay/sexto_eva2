<?php

require_once '../config/conexion.php';

class ReportesModel
{

    public function todos()
    {
        $con = new ClaseConexion();
        $conexion = $con->ProcedimientoConectar();
        $sql = "SELECT a.asignacion_id, a.Fecha_asignacion, a.Motivo, CONCAT(n.Apellido, ' ',n.Nombre) as NombreNinio, n.Fecha_nacimiento, n.Alergias, c.Nombre as NombreCuidador, c.Especialidad, c.Telefono, c.Email 
                FROM asignaciones a
                JOIN cuidadores c ON a.idCuidador = c.idCuidador
                JOIN ninios n ON a.idNinio = n.idNinio";
        $resultado = $conexion->query($sql);
        return $resultado;
    }
}
