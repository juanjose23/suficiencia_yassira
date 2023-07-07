<?php
class Marca_Model
{
    private $db;
    private $categoria;
    public function __construct()
    {
        $this->db=conectar::conexion();
        $this->categoria=array();
    }
 
    //Mostrar las categorias en la vista
    public function mostrar_marca()
    {
        $consulta="SELECT * FROM marca_automovil";
        $resultado=$this->db->query($consulta);
        while ($row = $resultado->fetch_assoc()) {
            $this->categoria[] = $row;
        }
        return $this->categoria;
    }
    //Insertar Categorias
    public function agregar_marca($siglas,$descripcion,$estado)
    {
        $insertar="INSERT INTO marca_automovil(descripcion,siglas,estado) VALUES('$descripcion','$siglas','$estado')";
        $this->db->query($insertar);
    }

}