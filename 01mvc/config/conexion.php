<?php

class ClaseConexion
{
    public $conexion;
    protected $db;

    //Desconetar estas líneas si se desea utilizar en una base local
    //Conexión a la base de datos local

    private $db_host = "localhost";
    private $db_user = "root";
    private $db_password = "";
    private $db_name = "ioasyste_eva2";


    //Conexión a la base de datos remota NO USAR BASE VACIA
    //Descomentar estas líneas si se desea utilizar en una base remota
    
    // private $db_host = "www.ioasystem.com";
    // private $db_user = "ioasyste_iaproject";
    // private $db_password = "d,!4{bTrbYzz";
    // private $db_name = "ioasyste_eva2";
    

    public function ProcedimientoConectar()
    {
        $this->conexion = mysqli_connect($this->db_host, $this->db_user, $this->db_password, $this->db_name);
        mysqli_query($this->conexion, "SET NAMES 'utf8'");

        if ($this->conexion->connect_error) {
            die("No se pudo conectar al servidor: " . $this->conexion->connect_error);
        }

        $this->db = $this->conexion;
        if (!$this->db)
            die("No se pudo conectar a la base de datos" . $this->conexion->connect_error);

        return $this->conexion;
    }
}
