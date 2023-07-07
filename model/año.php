<?php
class Año_Model
{
    private $db;
    private $año;
    public function __construct()
    {
        $this->db=conectar::conexion();
        $this->año=array();
    }
 
    //Mostrar las categorias en la vista
    public function mostrar_años()
    {
        $consulta="SELECT  * FROM año";
        $resultado=$this->db->query($consulta);
        while ($row = $resultado->fetch_assoc()) {
            $this->año[] = $row;
        }
        return $this->año;
    }
    //Insertar Categorias
    public function agregar_año($nombre,$descripcion)
    {
        $insertar="INSERT INTO año(nombre,descripcion) VALUES('$nombre','$descripcion')";
        $this->db->query($insertar);
    }

}